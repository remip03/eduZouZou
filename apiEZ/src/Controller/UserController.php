<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use OpenApi\Attributes as OA;


class UserController extends AbstractController
{
    #[Route('/api/users/{id}', name: 'detailUser', methods: ['GET'])]
    #[OA\Tag(name: "Users")]
    public function getUserDetails(User $user, SerializerInterface $serializer): JsonResponse
    {
        $context = SerializationContext::create()->setGroups(['getUsers']);
        // Sérialisation de l'utilisateur spécifié en JSON.
        $jsonUser = $serializer->serialize($user, 'json', $context);
        // Retour d'une réponse JSON avec les détails de l'utilisateur.
        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }

    #[Route('/api/users/{id}', name: 'deleteUser', methods: ['DELETE'])]  
    #[OA\Tag(name: "Users")] 
    public function deleteUser(User $user, EntityManagerInterface $em, TagAwareCacheInterface $cachePool): JsonResponse
    {
        // Invalide le cache associé aux users
        $cachePool->invalidateTags(["userCache"]);

        // Suppression de l'utilsateur de la base de données
        $em->remove($user);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
