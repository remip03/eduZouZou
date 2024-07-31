<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\Annotation\Groups;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

class RegisterController extends AbstractController
{
    #[Route('/api/register', name: 'register', methods: ['POST'])]
    #[OA\Post(
        path: "/api/register",
        summary: "Inscription d'un nouvel utilisateur",
        tags: ["Inscription"],
        requestBody: new OA\RequestBody(
            description: "Les informations de l'utilisateur à inscrire",
            required: true,
            content: new OA\JsonContent(
                ref: new Model(type: User::class, groups: ["create"])
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Utilisateur créé avec succès",
                content: new OA\JsonContent(
                    type: "object",
                    properties: [
                        new OA\Property(property: "email", type: "string"),
                        new OA\Property(property: "password", type: "string"),
                        new OA\Property(property: "roles", type: "array", items: new OA\Items(type: "string")),
                        new OA\Property(property: "first_name", type: "string"),
                        new OA\Property(property: "last_name", type: "string"),
                        new OA\Property(property: "tel", type: "string"),
                        new OA\Property(property: "adresse", type: "string")
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: "Erreur de validation",
            )
        ]
    )]
    #[Groups(["getUsers"])]
    public function register(Request $request, EntityManagerInterface $manager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data['email']) || empty($data['password'])) {
            return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
        }
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setTel($data['tel']);
        $user->setAdresse($data['adresse']);

        
        


        $manager->persist($user);
        $manager->flush();
        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'tel' => $user->getTel(),
            'adresse' => $user->getAdresse(),
        ], Response::HTTP_CREATED);
    }
}