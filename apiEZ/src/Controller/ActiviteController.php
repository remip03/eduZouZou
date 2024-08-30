<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class ActiviteController extends AbstractController
{
    /**
     * Cette méthode permet de récupérer l'ensemble des activites
     */
    // Définition d'une route pour récupérer toutes les activites. La méthode HTTP autorisée est GET.
    #[Route('/api/activites', name: 'app_activite', methods:['GET'])]
    #[OA\Response(
        response: 200,
        description: "Retourne la liste des activites",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Activite::class, groups: ["getRessources"]))
        )
    )]
    #[OA\Tag(name: "Activites")]
    public function getAllActivites(ActiviteRepository $activiteRepository, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse{
        // Identifiant de cache pour cette activite
        $idCache = "getAllActivites";

        // Récupération des données depuis le cache ou exécution de la requête si le cache est vide
        $jsonActiviteList = $cache->get($idCache, function(ItemInterface $item) use ($activiteRepository, $serializer){
            $item->tag("activitesCache");
            $activiteList = $activiteRepository->findAll();
            $context = SerializationContext::create()->setGroups(['getRessources']);
            return $serializer->serialize($activiteList, 'json', $context);
        });

        // Retourne la liste des activites en JSON
        return new JsonResponse($jsonActiviteList, Response::HTTP_OK, [], true);

    }

    /**
     * Cette méthode permet de récupérer une activite spécifique par son ID
     */
    // Définition d'une route pour récupérer les détails d'une activite spécifique par son ID. La méthode HTTP autorisée est GET.
    #[Route('/api/activites/{id}', name: 'detailActivite', methods: ['GET'])]
    #[OA\Tag(name: "Activites")]
    public function getActiviteDetail(Activite $activite, SerializerInterface $serializer): JsonResponse{
        // Contexte de sérialisation pour le groupe 'getActivites'
        $context = SerializationContext::create()->setGroups(['getRessources']);

        // Sérialisation de la activite en JSON
        $jsonActivite = $serializer->serialize($activite, 'json', $context);

        // Retourne les détails de la activite en JSON
        return new JsonResponse($jsonActivite, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de supprimer une activite en fonction de son id
     */
    // Définition d'une route pour supprimer une activite spécifique par son ID. La méthode HTTP autorisée est DELETE.
    #[Route('/api/activites/{id}', name: 'deleteActivite', methods: ['DELETE'])]
    #[IsGranted('ROLE_PROF, ROLE_ADMIN, ROLE_SUPERADMIN', message: 'Vous n\avez pas les droits suffisants pour supprimer une activité.')]
    #[OA\Tag(name: "Activites")]
    public function deleteActivite(Activite $activite, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse{
        // Invalide le cache associé aux activites
        $cachePool->invalidateTags(["activitesCache"]);

        // Suppression de la activite de la base de données
        $em->remove($activite);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthode permet de créer une nouvelle activite
     */
    // Définition d'une route pour créer une nouvelle activite. La méthode HTTP autorisée est POST.
    #[Route('/api/activites', name: 'createActivite', methods: ['POST'])]
    #[OA\Post(
        path: "/api/activites",
        summary: "crée une nouvelle activite",
        tags: ["Activites"],
        requestBody: new OA\RequestBody(
            description: "les informations d'une activite à créer",
            required: true,
            content : new OA\JsonContent(
                ref: new Model(type: Activite::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Une nouvelle activite a été créée",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "typeR", type: "string"),
                        new OA\Property(property: "nameR", type: "string"),
                        new OA\Property(property: "descritpionR", type: "string"),
                        new OA\Property(property: "matiereR", type: "string"),
                        new OA\Property(property: "typeAct", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            )
        ]
    )]
    #[IsGranted('ROLE_PROF, ROLE_ADMIN, ROLE_SUPERADMIN', message: 'Vous n\avez pas les droits suffisants pour créer une activité.')]
    #[OA\Tag(name: "Activites")]
    public function createActivite(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse{

        // Invalide le cache associé aux activites
        $cachePool->invalidateTags(["activitesCache"]);

        
        // Désérialisation du contenu de la requête pour créer une instance de Activite
        $data = json_decode($request->getContent(), true);

        // Désérialisation des données en objetActivite
        $activite = $serializer->deserialize(json_encode($data), Activite::class, 'json');

        // Validation des données
        $errors = $validator->validate($activite);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance de la nouvelle activite en base de données
        $em->persist($activite);
        $em->flush();

        // Sérialisation de la activite créée pour la réponse
        $context = SerializationContext::create()->setGroups(['getRessources']);
        $jsonActivite = $serializer->serialize($activite, 'json', $context);

        // Génération de l'URL de la nouvelle activite
        $location = $urlGenerator->generate('detailActivite', ['id' => $activite->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retourne la activite créée avec l'URL de la nouvelle activite
        return new JsonResponse($jsonActivite, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    /**
     * Cette méthode permet de mettre à jour une activite
     */
    // Définition d'une route pour mettre à jour une activite spécifique par son ID. La méthode HTTP autorisée est PUT.
    #[Route('/api/activites/{id}', name: 'updateActivite', methods: ['PUT'])]
    #[OA\Put(
        path: "/api/activites/{id}",
        summary: "Met à jour une activite existante",
        tags: ["Activites"],
        requestBody: new OA\RequestBody(
            description: "Les informations de la activite à mettre à jour",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Activite::class, groups: ["update"])
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "L'identifiant de la activite à mettre à jour",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "Activite mise à jour avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "typeR", type: "string"),
                        new OA\Property(property: "nameR", type: "string"),
                        new OA\Property(property: "descritpionR", type: "string"),
                        new OA\Property(property: "matiereR", type: "string"),
                        new OA\Property(property: "typeAct", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            ),
            new OA\Response(
                response: 404,
                description: "Activite non trouvée"
            )
        ]
    )]
    #[IsGranted('ROLE_PROF, ROLE_ADMIN, ROLE_SUPERADMIN', message: 'Vous n\avez pas les droits suffisants pour modifier une activité.')]
    #[OA\Tag(name: "Activites")]
    public function updateActivite(Request $request, SerializerInterface $serializer, Activite $currentActivite, EntityManagerInterface $em, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse{
        
        // Désérialisation du contenu de la requête pour créer une instance de Activite
        $data = json_decode($request->getContent(), true);

        // Désérialisation des nouvelles données en objet Activite
        $newActivite = $serializer->deserialize(json_encode($data), Activite::class, 'json');

        // Mise à jour des propriétés de l'objet Classe existant
        $currentActivite->setTypeR($newActivite->getTypeR());
        $currentActivite->setNameR($newActivite->getNameR());
        $currentActivite->setDescriptionR($newActivite->getDescriptionR());
        $currentActivite->setMatiereR($newActivite->getMatiereR());
        $currentActivite->setTypeAct($newActivite->getTypeAct());

        // Validation des données mises à jour
        $errors = $validator->validate($currentActivite);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance des modifications en base de données
        $em->persist($currentActivite);
        $em->flush();

        // Invalide le cache associé aux activites
        $cachePool->invalidateTags(["activitesCache"]);

        // Retourne une réponse indiquant que la mise à jour a été effectuée avec succès
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

}