<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Repository\ClasseRepository;
use App\Repository\EcoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

// Déclaration de la classe EcoleController qui étend AbstractController de Symfony
class EcoleController extends AbstractController
{
    /**
     * Cette méthode permet de récupérer l'ensemble des écoles
     */
    // Définition d'une route pour obtenir toutes les écoles via une requête GET.
    #[Route('/api/ecoles', name: 'ecoles', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: "Retourne la liste des écoles",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Ecole::class, groups: ["getClasses"]))
        )
    )]
    #[OA\Tag(name: "Ecoles")]
    public function getAllEcoles(EcoleRepository $ecoleRepository, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse
    {
        // Identifiant de cache pour cette requête
        $idCache = "getAllEcoles";

        // Récupération des données depuis le cache ou exécution de la requête si le cache est vide
        $jsonEcoleList = $cache->get($idCache, function (ItemInterface $item) use ($ecoleRepository, $serializer) {
            $item->tag("ecolesCache");
            $ecoleList = $ecoleRepository->findAll();
            $context = SerializationContext::create()->setGroups(['getClasses']);
            return $serializer->serialize($ecoleList, 'json', $context);
        });

        // Retourne la liste des classes en JSON
        return new JsonResponse($jsonEcoleList, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de récupérer une école spécifique par son ID
     */
    // Définition d'une route pour récupérer les détails d'une école spécifique par son ID. La méthode HTTP autorisée est GET.
    #[Route('/api/ecoles/{id}', name: 'detailEcole', methods: ['GET'])]
    #[OA\Tag(name: "Ecoles")]
    public function getEcoleDetail(Ecole $ecole, SerializerInterface $serializer): JsonResponse
    {
        // Contexte de sérialisation pour le groupe 'getClasses'
        $context = SerializationContext::create()->setGroups(['getClasses']);
        // Sérialisation de l'école en JSON
        $jsonEcole = $serializer->serialize($ecole, 'json', $context);
        // Retour d'une réponse JSON avec les détails de l'école.
        return new JsonResponse($jsonEcole, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de supprimer une école en fonction de son id
     */
    // Définition d'une route pour supprimer une école spécifique via une requête DELETE
    #[Route('/api/ecoles/{id}', name: 'deleteEcole', methods: ['DELETE'])]
    #[OA\Tag(name: "Ecoles")]
    public function deleteEcole(Ecole $ecole, EntityManagerInterface $entityManager, ClasseRepository $classeRepository, TagAwareCacheInterface $cachePool): JsonResponse
    {
        $cachePool->invalidateTags(["ecolesCache"]);
        // Récupération des classes de l'école
        $classes = $classeRepository->findBy(['ecole' => $ecole]);
        // Suppression des classes de l'école
        foreach ($classes as $classe) {
            $entityManager->remove($classe);
        }
        // Suppression de l'école
        $entityManager->remove($ecole);
        // Application des changements dans la base de données
        $entityManager->flush();
        // Retour d'une réponse JSON indiquant que l'école a été supprimée
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthode permet de créer une nouvelle école
     */
    // Définition d'une route pour créer une nouvelle école via une requête POST
    #[Route('/api/ecoles', name: 'createEcole', methods: ['POST'])]
    #[OA\Post(
        path: "/api/ecoles",
        tags: ["Ecoles"],
        requestBody: new OA\RequestBody(
            description: "Créer une nouvelle école",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Ecole::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "École créée avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "nameEc", type: "string"),
                        new OA\Property(property: "adresseEc", type: "string"),
                        new OA\Property(property: "telEc", type: "string"),
                        new OA\Property(property: "mailEc", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Données invalides fournies"
            )
        ]
    )]
    #[OA\Tag(name: "Ecoles")]
    public function createEcole(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse
    {
        $cachePool->invalidateTags(["ecolesCaches"]);
        // Désérialisation du contenu de la requête pour créer une nouvelle instance d'Ecole.
        $ecole = $serializer->deserialize($request->getContent(), Ecole::class, 'json');
        // Vérification des erreurs
        $errors = $validator->validate($ecole);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
        // Enregistrement de l'école dans la base de données.
        $entityManager->persist($ecole);
        $entityManager->flush();
        // Sérialisation de l'école créé en JSON.
        $context = SerializationContext::create()->setGroups(['getClasses']);
        $jsonClasse = $serializer->serialize($ecole, 'json', $context);
        // Génération de l'URL vers les détails de l'école créé.
        $location = $urlGenerator->generate('detailEcole', ['id' => $ecole->getId(), UrlGeneratorInterface::ABSOLUTE_URL]);
        // Retour d'une réponse JSON avec l'école créée et l'URL de ses détails.
        return new JsonResponse($jsonClasse, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    /**
     * Cette méthode permet de mettre à jour une école
     */
    // Définition d'une route pour mettre à jour une école spécifique via une requête PUT.
    #[Route('/api/ecoles/{id}', name: 'updateEcole', methods: ['PUT'])]
    #[OA\Put(
        path: "/api/ecoles/{id}",
        summary: "Met à jour une école existante",
        tags: ["Ecoles"],
        requestBody: new OA\RequestBody(
            description: "Données de l'école à mettre à jour",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Ecole::class, groups: ["update"])
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "ID de l'école à mettre à jour",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "École mise à jour avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "nameEc", type: "string"),
                        new OA\Property(property: "adresseEc", type: "string"),
                        new OA\Property(property: "telEc", type: "string"),
                        new OA\Property(property: "mailEc", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Données invalides fournies"
            ),
            new OA\Response(
                response: 404,
                description: "École non trouvé"
            )
        ]
    )]
    #[OA\Tag(name: "Ecoles")]
    public function updateEcole(Request $request, SerializerInterface $serializer, Ecole $currentEcole, EntityManagerInterface $em, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse
    {
        $newEcole = $serializer->deserialize($request->getContent(), Ecole::class, 'json');
        $currentEcole->setNameEc($newEcole->getNameEc());
        $currentEcole->setAdresseEc($newEcole->getAdresseEc());
        $currentEcole->setTelEc($newEcole->getTelEc());
        $currentEcole->setMailEc($newEcole->getMailEc());

        $errors = $validator->validate($currentEcole);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
        $em->persist($currentEcole);
        $em->flush();
        $cachePool->invalidateTags(["ecolesCache"]);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
