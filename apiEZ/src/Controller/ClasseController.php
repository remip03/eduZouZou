<?php
// Déclaration de l'espace de noms pour ce contrôleur, permettant son utilisation dans l'application.
namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class ClasseController extends AbstractController
{
    /**
     * Cette méthode permet de récupérer l'ensemble des classes
     */
    // Définition d'une route pour récupérer toutes les classes. La méthode HTTP autorisée est GET.
    #[Route('/api/classes', name: 'classe', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: "Retourne la liste des classes",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Classe::class, groups: ["getClasses"]))
        )
    )]
    #[OA\Tag(name: "Classes")]
    public function getAllClasses(ClasseRepository $classeRepository, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse
    {
        // Identifiant de cache pour cette requête
        $idCache = "getAllClasses";

        // Récupération des données depuis le cache ou exécution de la requête si le cache est vide
        $jsonClasseList = $cache->get($idCache, function (ItemInterface $item) use ($classeRepository, $serializer) {
            $item->tag("classesCache");
            $classeList = $classeRepository->findAll();
            $context = SerializationContext::create()->setGroups(['getClasses']);
            return $serializer->serialize($classeList, 'json', $context);
        });

        // Retourne la liste des classes en JSON
        return new JsonResponse($jsonClasseList, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de récupérer une classe spécifique par son ID
     */
    // Définition d'une route pour récupérer les détails d'une classe spécifique par son ID. La méthode HTTP autorisée est GET.
    #[Route('/api/classes/{id}', name: 'detailClasse', methods: ['GET'])]
    #[OA\Tag(name: "Classes")]
    public function getClasseDetail(Classe $classe, SerializerInterface $serializer): JsonResponse
    {
        // Contexte de sérialisation pour le groupe 'getClasses'
        $context = SerializationContext::create()->setGroups(['getClasses']);

        // Sérialisation de la classe en JSON
        $jsonClasse = $serializer->serialize($classe, 'json', $context);

        // Retourne les détails de la classe en JSON
        return new JsonResponse($jsonClasse, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode supprimer une classe en fonction de son id
     */
    // Définition d'une route pour supprimer une classe spécifique par son ID. La méthode HTTP autorisée est DELETE.
    #[Route('/api/classes/{id}', name: 'deleteClasse', methods: ['DELETE'])]
    #[OA\Tag(name: "Classes")]
    public function deleteClasse(Classe $classe, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse
    {
        // Invalide le cache associé aux classes
        $cachePool->invalidateTags(["classesCache"]);

        // Suppression de la classe de la base de données
        $em->remove($classe);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthodde permet de créer une nouvelle classe
     */
    // Définition d'une route pour créer une nouvelle classe. La méthode HTTP autorisée est POST.
    #[Route('/api/classes', name: 'createClasse', methods: ['POST'])]
    #[OA\Post(
        path: "/api/classes",
        summary: "Crée une nouvelle classe",
        tags: ["Classes"],
        requestBody: new OA\RequestBody(
            description: "Les informations d'une classe à créer",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Classe::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Classe crée avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "nameCl", type: "string"),
                        new OA\Property(property: "niveauCl", type: "string"),
                        new OA\Property(property: "anneeCl", type: "string", format: "date"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation",
            )
        ]
    )]
    #[OA\Tag(name: "Classes")]
    public function createClasse(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse
    {
        // Invalide le cache associé aux classes
        $cachePool->invalidateTags(["classesCache"]);

        // Désérialisation du contenu de la requête pour créer une instance de Classe
        $data = json_decode($request->getContent(), true);

        // Conversion de la date au format ISO 8601 si nécessaire
        if (isset($data['anneeCl'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['anneeCl']);
            if ($date) {
                $data['anneeCl'] = $date->format(\DateTime::ATOM);
            }
        }

        // Désérialisation des données en objet Classe
        $classe = $serializer->deserialize(json_encode($data), Classe::class, 'json');

        // Validation des données
        $errors = $validator->validate($classe);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance de la nouvelle classe en base de données
        $em->persist($classe);
        $em->flush();

        // Sérialisation de la classe créée pour la réponse
        $context = SerializationContext::create()->setGroups(['getClasses']);
        $jsonClasse = $serializer->serialize($classe, 'json', $context);

        // Génération de l'URL de la nouvelle ressource
        $location = $urlGenerator->generate('detailClasse', ['id' => $classe->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retourne la classe créée avec l'URL de la nouvelle ressource
        return new JsonResponse($jsonClasse, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    /**
     * Cette méthode permet de mettre à jour une classe
     */
    // Définition d'une route pour mettre à jour une classe spécifique par son ID. La méthode HTTP autorisée est PUT.
    #[Route('/api/classes/{id}', name: 'updateClasse', methods: ['PUT'])]
    #[OA\Put(
        path: "/api/classes/{id}",
        summary: "Met à jour une classe existante",
        tags: ["Classes"],
        requestBody: new OA\RequestBody(
            description: "Les informations de la classe à mettre à jour",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Classe::class, groups: ["update"])
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "L'identifiant de la classe à mettre à jour",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "Classe mis à jour avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "nameCl", type: "string"),
                        new OA\Property(property: "niveauCl", type: "string"),
                        new OA\Property(property: "anneeCl", type: "string", format: "date"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            ),
            new OA\Response(
                response: 404,
                description: "Classe non trouvé"
            )
        ]
    )]
    #[OA\Tag(name: "Classes")]
    public function updateClasse(Request $request, SerializerInterface $serializer, Classe $currentClasse, EntityManagerInterface $em, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse
    {
        // Désérialisation du contenu de la requête pour créer une instance de Classe
        $data = json_decode($request->getContent(), true);

        // Conversion de la date au format ISO 8601 si nécessaire
        if (isset($data['anneeCl'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['anneeCl']);
            if ($date) {
                $data['anneeCl'] = $date->format(\DateTime::ATOM);
            }
        }

        // Désérialisation des nouvelles données en objet Classe
        $newClasse = $serializer->deserialize(json_encode($data), Classe::class, 'json');

        // Mise à jour des propriétés de l'objet Classe existant
        $currentClasse->setNameCl($newClasse->getNameCl());
        $currentClasse->setNiveauCl($newClasse->getNiveauCl());
        $currentClasse->setAnneeCl($newClasse->getAnneeCl());

        // Validation des données mises à jour
        $errors = $validator->validate($currentClasse);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance des modifications en base de données
        $em->persist($currentClasse);
        $em->flush();

        // Invalide le cache associé aux classes
        $cachePool->invalidateTags(["classesCache"]);

        // Retourne une réponse indiquant que la mise à jour a été effectuée avec succès
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}