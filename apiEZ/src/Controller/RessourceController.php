<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Repository\RessourceRepository;
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

class RessourceController extends AbstractController
{
    /**
     * Cette méthode permet de récupérer l'ensemble des ressources
     */
    // Définition d'une route pour récupérer toutes les ressources. La méthode HTTP autorisée est GET.
    #[Route('/api/ressources', name: 'app_ressource', methods:['GET'])]
    #[OA\Response(
        response: 200,
        description: "Retourne la liste des ressources",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Ressource::class, groups: ["getRessources"]))
        )
    )]
    #[OA\Tag(name: "Ressources")]
    public function getAllRessources(RessourceRepository $ressourceRepository, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse{
        // Identifiant de cache pour cette requête
        $idCache = "getAllRessources";

        // Récupération des données depuis le cache ou exécution de la requête si le cache est vide
        $jsonRessourceList = $cache->get($idCache, function(ItemInterface $item) use ($ressourceRepository, $serializer){
            $item->tag("ressourcesCache");
            $ressourceList = $ressourceRepository->findAll();
            $context = SerializationContext::create()->setGroups(['getRessources']);
            return $serializer->serialize($ressourceList, 'json', $context);
        });

        // Retourne la liste des ressources en JSON
        return new JsonResponse($jsonRessourceList, Response::HTTP_OK, [], true);

    }

    /**
     * Cette méthode permet de récupérer une ressource spécifique par son ID
     */
    // Définition d'une route pour récupérer les détails d'une ressource spécifique par son ID. La méthode HTTP autorisée est GET.
    #[Route('/api/ressources/{id}', name: 'detailRessource', methods: ['GET'])]
    #[OA\Tag(name: "Ressources")]
    public function getRessourceDetail(Ressource $ressource, SerializerInterface $serializer): JsonResponse{
        // Contexte de sérialisation pour le groupe 'getRessources'
        $context = SerializationContext::create()->setGroups(['getRessources']);

        // Sérialisation de la ressource en JSON
        $jsonRessource = $serializer->serialize($ressource, 'json', $context);

        // Retourne les détails de la ressource en JSON
        return new JsonResponse($jsonRessource, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de supprimer une ressource en fonction de son id
     */
    // Définition d'une route pour supprimer une ressource spécifique par son ID. La méthode HTTP autorisée est DELETE.
    #[Route('/api/ressources/{id}', name: 'deleteRessource', methods: ['DELETE'])]
    #[OA\Tag(name: "Ressources")]
    #[IsGranted('ROLE_ADMIN, ROLE_SUPERADMIN', message: 'Vous n\avez pas les droits suffisants pour supprimer une ressource.')]
    public function deleteRessource(Ressource $ressource, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse{
        // Invalide le cache associé aux ressources
        $cachePool->invalidateTags(["ressourcesCache"]);

        // Suppression de la ressource de la base de données
        $em->remove($ressource);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthode permet de créer une nouvelle ressource
     */
    // Définition d'une route pour créer une nouvelle ressource. La méthode HTTP autorisée est POST.
    #[Route('/api/ressources', name: 'createRessource', methods: ['POST'])]
    #[OA\Post(
        path: "/api/ressources",
        summary: "crée une nouvelle ressource",
        tags: ["Ressources"],
        requestBody: new OA\RequestBody(
            description: "les informations d'une ressource à créer",
            required: true,
            content : new OA\JsonContent(
                ref: new Model(type: Ressource::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Une nouvelle ressource a été créée",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "typeR", type: "string"),
                        new OA\Property(property: "nameR", type: "string"),
                        new OA\Property(property: "descritpionR", type: "string"),
                        new OA\Property(property: "matiereR", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            )
        ]
    )]
    #[IsGranted('ROLE_PROF, ROLE_ADMIN, ROLE_SUPERADMIN', message: 'Vous n\avez pas les droits suffisants pour créer une ressource.')]
    #[OA\Tag(name: "Ressources")]
    public function createRessource(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse{

        // Invalide le cache associé aux ressources
        $cachePool->invalidateTags(["ressourcesCache"]);

        
        // Désérialisation du contenu de la requête pour créer une instance de Ressource
        $data = json_decode($request->getContent(), true);

        // Désérialisation des données en objet Ressource
        $ressource = $serializer->deserialize(json_encode($data), Ressource::class, 'json');

        // Validation des données
        $errors = $validator->validate($ressource);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance de la nouvelle ressource en base de données
        $em->persist($ressource);
        $em->flush();

        // Sérialisation de la ressource créée pour la réponse
        $context = SerializationContext::create()->setGroups(['getRessources']);
        $jsonRessource = $serializer->serialize($ressource, 'json', $context);

        // Génération de l'URL de la nouvelle ressource
        $location = $urlGenerator->generate('detailRessource', ['id' => $ressource->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retourne la ressource créée avec l'URL de la nouvelle ressource
        return new JsonResponse($jsonRessource, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    /**
     * Cette méthode permet de mettre à jour une ressource
     */
    // Définition d'une route pour mettre à jour une ressource spécifique par son ID. La méthode HTTP autorisée est PUT.
    #[Route('/api/ressources/{id}', name: 'updateRessource', methods: ['PUT'])]
    #[OA\Put(
        path: "/api/ressources/{id}",
        summary: "Met à jour une ressource existante",
        tags: ["Ressources"],
        requestBody: new OA\RequestBody(
            description: "Les informations de la ressource à mettre à jour",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Ressource::class, groups: ["update"])
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "L'identifiant de la ressource à mettre à jour",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "Ressource mise à jour avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "typeR", type: "string"),
                        new OA\Property(property: "nameR", type: "string"),
                        new OA\Property(property: "descritpionR", type: "string"),
                        new OA\Property(property: "matiereR", type: "string"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            ),
            new OA\Response(
                response: 404,
                description: "Ressource non trouvée"
            )
        ]
    )]
    #[IsGranted('ROLE_PROF, ROLE_ADMIN, ROLE_SUPERADMIN', message: 'Vous n\avez pas les droits suffisants pour modifier une ressource.')]
    #[OA\Tag(name: "Ressources")]
    public function updateRessource(Request $request, SerializerInterface $serializer, Ressource $currentRessource, EntityManagerInterface $em, ValidatorInterface $validator, TagAwareCacheInterface $cachePool): JsonResponse{
        
        // Désérialisation du contenu de la requête pour créer une instance de Ressource
        $data = json_decode($request->getContent(), true);

        // Désérialisation des nouvelles données en objet Ressource
        $newRessource = $serializer->deserialize(json_encode($data), Ressource::class, 'json');

        // Mise à jour des propriétés de l'objet Classe existant
        $currentRessource->setTypeR($newRessource->getTypeR());
        $currentRessource->setNameR($newRessource->getNameR());
        $currentRessource->setDescriptionR($newRessource->getDescriptionR());
        $currentRessource->setMatiereR($newRessource->getMatiereR());

        // Validation des données mises à jour
        $errors = $validator->validate($currentRessource);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance des modifications en base de données
        $em->persist($currentRessource);
        $em->flush();

        // Invalide le cache associé aux ressources
        $cachePool->invalidateTags(["ressourcesCache"]);

        // Retourne une réponse indiquant que la mise à jour a été effectuée avec succès
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }

}
