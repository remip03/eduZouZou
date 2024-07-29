<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Repository\ClasseRepository;
use App\Repository\EnfantRepository;
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

class EnfantController extends AbstractController
{
    /**
     * Cette méthode permet de récupérer l'ensemble des enfants
     */
    // Définition d'une route pour récupérer tous les enfants. La méthode HTTP autorisée est GET.
    #[Route('/api/enfants', name: 'enfant', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: "Retourne la liste des enfants",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(ref: new Model(type: Enfant::class, groups: ["getClasses"]))
        )
    )]
    #[OA\Tag(name: "Enfants")]
    public function getAllEnfants(EnfantRepository $enfantRepository, SerializerInterface $serializer, TagAwareCacheInterface $cache): JsonResponse
    {
        // Identifiant de cache pour cette requête
        $idCache = "getAllEnfants";

        // Récupération des données depuis le cache ou exécution de la requête si le cache est vide
        $jsonEnfantList = $cache->get($idCache, function (ItemInterface $item) use ($enfantRepository, $serializer) {
            $item->tag("enfantsCache");
            $classeList = $enfantRepository->findAll();
            $context = SerializationContext::create()->setGroups(['getClasses']);
            return $serializer->serialize($classeList, 'json', $context);
        });

        // Retourne la liste des enfants en JSON
        return new JsonResponse($jsonEnfantList, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode permet de récupérer un enfant spécifique par son ID
     */
    // Définition d'une route pour récupérer les détails d'un enfant spécifique par son ID. La méthode HTTP autorisée est GET.
    #[Route('/api/enfants/{id}', name: 'detailEnfant', methods: ['GET'])]
    #[OA\Tag(name: "Enfants")]
    public function getEnfantDetail(Enfant $enfant, SerializerInterface $serializer): JsonResponse
    {
        // Contexte de sérialisation pour le groupe 'getClasses'
        $context = SerializationContext::create()->setGroups(['getClasses']);

        // Sérialisation de l'enfant en JSON
        $jsonEnfant = $serializer->serialize($enfant, 'json', $context);

        // Retourne les détails de l'enfant en JSON
        return new JsonResponse($jsonEnfant, Response::HTTP_OK, [], true);
    }

    /**
     * Cette méthode supprimer un enfant en fonction de son id
     */
    // Définition d'une route pour supprimer un enfant spécifique par son ID. La méthode HTTP autorisée est DELETE.
    #[Route('/api/enfants/{id}', name: 'deleteEnfant', methods: ['DELETE'])]
    #[OA\Tag(name: "Enfants")]
    public function deleteEnfant(Enfant $enfant, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse
    {
        // Invalide le cache associé aux enfants
        $cachePool->invalidateTags(["enfantsCache"]);

        // Suppression de l'enfant de la base de données
        $em->remove($enfant);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Cette méthodde permet de créer un nouvel enfant
     */
    // Définition d'une route pour créer une nouvel enfant. La méthode HTTP autorisée est POST.
    #[Route('/api/enfants', name: 'createEnfant', methods: ['POST'])]
    #[OA\Post(
        path: "/api/enfants",
        summary: "Créé une nouvel enfant",
        tags: ["Enfants"],
        requestBody: new OA\RequestBody(
            description: "Les informations d'un enfant à créer",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Enfant::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Enfant créé avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer"),
                        new OA\Property(property: "classeId", type: "integer"),
                        new OA\Property(property: "lastNameE", type: "string"),
                        new OA\Property(property: "firstNameE", type: "string"),
                        new OA\Property(property: "birthDateE", type: "string", format: "date"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation",
            )
        ]
    )]
    #[OA\Tag(name: "Enfants")]
    public function createEnfant(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, ValidatorInterface $validator, TagAwareCacheInterface $cachePool, ClasseRepository $classeRepository): JsonResponse
    {
        // Invalide le cache associé aux enfants
        $cachePool->invalidateTags(["enfantsCache"]);

        // Désérialisation du contenu de la requête pour créer une instance d'Enfant
        $data = json_decode($request->getContent(), true);

        // Conversion de la date au format ISO 8601 si nécessaire
        if (isset($data['birthDateE'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['birthDateE']);
            if ($date) {
                $data['birthDateE'] = $date->format(\DateTime::ATOM);
            }
        }

        // Désérialisation des données en objet Enfant
        $enfant = $serializer->deserialize(json_encode($data), Enfant::class, 'json');

        // Récupération des données envoyées avec la requête
        $content = $request->toArray();
        // Récupération de l'ID de la classe avec une valeur par défaut si non spécifié
        $classeId = $content['classeId'] ?? -1;
        // Association de la classe à l'enfant
        $classe = $classeRepository->find($classeId);
        if (!$classe) {
            return new JsonResponse(['error' => 'Classe not found'], Response::HTTP_BAD_REQUEST);
        }
        $enfant->setClasse($classe);

        // Vérification des erreurs
        $errors = $validator->validate($enfant);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persistance du nouvel enfant en base de données
        $em->persist($enfant);
        $em->flush();

        // Sérialisation de l'enfant créé pour la réponse
        $context = SerializationContext::create()->setGroups(['getClasses']);
        $jsonEnfant = $serializer->serialize($enfant, 'json', $context);

        // Génération de l'URL de la nouvelle ressource
        $location = $urlGenerator->generate('detailEnfant', ['id' => $enfant->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retourne l'enfant créé avec l'URL de la nouvelle ressource
        return new JsonResponse($jsonEnfant, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    /**
     * Cette méthode permet de mettre à jour un enfant
     */
    // Définition d'une route pour mettre à jour un enfant spécifique par son ID. La méthode HTTP autorisée est PUT.
    #[Route('/api/enfants/{id}', name: 'updateEnfant', methods: ['PUT'])]
    #[OA\Put(
        path: "/api/enfants/{id}",
        summary: "Met à jour un enfant existant",
        tags: ["Enfants"],
        requestBody: new OA\RequestBody(
            description: "Les informations de l'enfant à mettre à jour",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: Enfant::class, groups: ["update"])
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                description: "L'identifiant de l'enfant à mettre à jour",
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
                        new OA\Property(property: "classeId", type: "integer"),
                        new OA\Property(property: "lastNameE", type: "string"),
                        new OA\Property(property: "firstNameE", type: "string"),
                        new OA\Property(property: "birthDateE", type: "string", format: "date"),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation"
            ),
            new OA\Response(
                response: 404,
                description: "Enfant non trouvé"
            )
        ]
    )]
    #[OA\Tag(name: "Enfants")]
    public function updateEnfant(Request $request, SerializerInterface $serializer, Enfant $currentEnfant, EntityManagerInterface $em, ValidatorInterface $validator, TagAwareCacheInterface $cachePool, ClasseRepository $classeRepository): JsonResponse
    {
        // Désérialisation du contenu de la requête pour créer une instance d'Enfant
        $data = json_decode($request->getContent(), true);

        // Conversion de la date au format ISO 8601 si nécessaire
        if (isset($data['birthDateE'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['birthDateE']);
            if ($date) {
                $data['birthDateE'] = $date->format(\DateTime::ATOM);
            }
        }

        // Désérialisation des nouvelles données en objet Enfant
        $newEnfant = $serializer->deserialize(json_encode($data), Enfant::class, 'json');

        // Mise à jour des propriétés de l'objet Enfant existant
        $currentEnfant->setLastNameE($newEnfant->getLastNameE());
        $currentEnfant->setFirstNameE($newEnfant->getFirstNameE());
        $currentEnfant->setBirthDateE($newEnfant->getBirthDateE());

        // On vérifie les erreurs
        $errors = $validator->validate($currentEnfant);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $content = $request->toArray();
        $classeId = $content['classeId'] ?? -1;

        $currentEnfant->setClasse($classeRepository->find($classeId));

        // Persistance des modifications en base de données
        $em->persist($currentEnfant);
        $em->flush();

        // Invalide le cache associé aux enfants
        $cachePool->invalidateTags(["enfantsCache"]);

        // Retourne une réponse indiquant que la mise à jour a été effectuée avec succès
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}