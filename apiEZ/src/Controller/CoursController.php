<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class CoursController extends AbstractController
{
    /**
     * Cette méthode permet de récupérer l'ensemble des cours.
     */
    // Définition d'une route pour récupérer toutes les cours. La méthode HTTP autorisée est GET.
    #[Route('/api/cours', name: 'app_cours', methods:['GET'])]
    #[OA\Response(
        response: 200,
        description: "Retourne la liste des cours",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Cours::class, groups: ["getRessources"]))
        )
    )]
    #[OA\Tag(name: "Cours")]
    public function getAllCours(CoursRepository $coursRepository, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse{
        // Identifiant de cache pour ce cours
        $idCache = "getAllCours";

        // Récupération des données depuis le cache ou exécution de la requête si le cache est vide
        $jsonCoursList = $cache->get($idCache, function(ItemInterface $item) use ($coursRepository, $serializer){
            $item->tag("coursCache");
            $coursList = $coursRepository->findAll();
            $context = SerializationContext::create()->setGroups(['getRessources']);
            return $serializer->serialize($coursList, 'json', $context);
        });

        // Retourne la liste des cours en JSON
        return new JsonResponse($jsonCoursList, Response::HTTP_OK, [], true);

    }

    /**
     * Cette méthode permet de récupérer un cours spécifique par son ID
     */
    // Définition d'une route pour récupérer les détails d'un cours spécifique par son ID. La méthode HTTP autorisée est GET.
    #[Route('/api/cours/{id}', name: 'detailCour', methods: ['GET'])]
    #[OA\Tag(name: "Cours")]
    public function getCourDetail(Cours $cour, SerializerInterface $serializer): JsonResponse{
        // Contexte de sérialisation pour le groupe 'Cours'
        $context = SerializationContext::create()->setGroups(['getRessources']);

        // Sérialisation du cours en JSON
        $jsonCour = $serializer->serialize($cour, 'json', $context);

        // Retourne les détails du cours en JSON
        return new JsonResponse($jsonCour, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de supprimer un cours en fonction de son id
     */
    // Définition d'une route pour supprimer un cours spécifique par son ID. La méthode HTTP autorisée est DELETE.
    #[Route('/api/cours/{id}', name: 'deleteCours', methods: ['DELETE'])]
    #[OA\Tag(name: "Cours")]
    public function deleteCours(Cours $cours, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse{
        // Invalide le cache associé aux cours
        $cachePool->invalidateTags(["coursCache"]);

        // Suppression du cours de la base de données
        $em->remove($cours);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthode permet de créer un nouveau cours
     */
    // Définition d'une route pour créer un nouveau cours. La méthode HTTP autorisée est POST.
    #[Route('/api/cours', name: 'createCours', methods: ['POST'])]
    #[OA\Post(
        path: "/api/cours",
        summary: "crée un nouveau cours",
        tags: ["Cours"],
        requestBody: new OA\RequestBody(
            description: "les informations d'un cours à créer",
            required: true,
            content : new OA\JsonContent(
                ref: new Model(type: Cours::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Un nouveau cours a été créé",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "typeR", type: "string"),
                        new OA\Property(property: "nameR", type: "string"),
                        new OA\Property(property: "descritpionR", type: "string"),
                        new OA\Property(property: "matiereR", type: "string"),
                        new OA\Property(property: "docC", type: "string"),
                        new OA\Property(property: "videoC", type: "string"),
                        new OA\Property(property: "ressourceSupC", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            )
        ]
    )]
    #[OA\Tag(name: "Cours")]
    public function createCours(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse{

        // Invalide le cache associé aux Cours
        $cachePool->invalidateTags(["coursCache"]);

        
        // Désérialisation du contenu de la requête pour créer une instance de Cours
        $data = json_decode($request->getContent(), true);

        // Désérialisation des données en objet Cours
        $cours = $serializer->deserialize(json_encode($data), Cours::class, 'json');

        // Validation des données
        $errors = $validator->validate($cours);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance du nouveau cours en base de données
        $em->persist($cours);
        $em->flush();

        // Sérialisation du cours créé pour la réponse
        $context = SerializationContext::create()->setGroups(['getRessources']);
        $jsonCours = $serializer->serialize($cours, 'json', $context);

        // Génération de l'URL du nouveau cours
        $location = $urlGenerator->generate('detailCour', ['id' => $cours->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retourne le cours créé avec l'URL du nouveau cours
        return new JsonResponse($jsonCours, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    /**
     * Cette méthode permet de mettre à jour un cours
     */
    // Définition d'une route pour mettre à jour un cours spécifique par son ID. La méthode HTTP autorisée est PUT.
    #[Route('/api/cours/{id}', name: 'updateCours', methods: ['PUT'])]
    #[OA\Put(
        path: "/api/courss/{id}",
        summary: "Met à jour un cours existant",
        tags: ["Cours"],
        requestBody: new OA\RequestBody(
            description: "Les informations du cours à mettre à jour",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Cours::class, groups: ["update"])
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "L'identifiant du cours à mettre à jour",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "Cours mis à jour avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "typeR", type: "string"),
                        new OA\Property(property: "nameR", type: "string"),
                        new OA\Property(property: "descritpionR", type: "string"),
                        new OA\Property(property: "matiereR", type: "string"),
                        new OA\Property(property: "docC", type: "string"),
                        new OA\Property(property: "videoC", type: "string"),
                        new OA\Property(property: "ressourceSupC", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            ),
            new OA\Response(
                response: 404,
                description: "Cours non trouvé"
            )
        ]
    )]
    #[OA\Tag(name: "Cours")]
    public function updateCours(Request $request, SerializerInterface $serializer, Cours $currentCours, EntityManagerInterface $em, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse{
        
        // Désérialisation du contenu de la requête pour créer une instance de Cours
        $data = json_decode($request->getContent(), true);

        // Désérialisation des nouvelles données en objet Cours
        $newCours = $serializer->deserialize(json_encode($data), Cours::class, 'json');

        // Mise à jour des propriétés de l'objet Cours existant
        $currentCours->setTypeR($newCours->getTypeR());
        $currentCours->setNameR($newCours->getNameR());
        $currentCours->setDescriptionR($newCours->getDescriptionR());
        $currentCours->setMatiereR($newCours->getMatiereR());
        $currentCours->setDocC($newCours->getDocC());
        $currentCours->setVideoC($newCours->getVideoC());
        $currentCours->setRessourceSupC($newCours->getRessourceSupC());
        $currentCours->setImageFile($newCours->getImageFile());

        // Validation des données mises à jour
        $errors = $validator->validate($currentCours);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance des modifications en base de données
        $em->persist($currentCours);
        $em->flush();

        // Invalide le cache associé aux cours
        $cachePool->invalidateTags(["coursCache"]);

        // Retourne une réponse indiquant que la mise à jour a été effectuée avec succès
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

}
