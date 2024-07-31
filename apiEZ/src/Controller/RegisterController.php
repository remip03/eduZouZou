<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Entity\Messagerie;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\SerializerInterface as SerializerSerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterController extends AbstractController
{
    // Définition de la route pour l'inscription d'un nouvel utilisateur
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
    public function register(Request $request, EntityManagerInterface $manager, SerializerSerializerInterface $serializer, ValidatorInterface $validator): Response
    {
        // Décoder le contenu JSON de la requête
        $data = json_decode($request->getContent(), true);

        // Récupérer l'école à partir de l'ID fourni dans la requête
        $ecoleId = $data['ecole_id'] ?? null;
        if (!$ecoleId) {
            return new JsonResponse(['message' => 'L\'id de l\'Ecole est requis'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Chercher l'école dans la base de données
        $ecole = $manager->getRepository(Ecole::class)->find($ecoleId);
        if (!$ecole) {
            return new JsonResponse(['message' => 'L\ecole n\'a pas été trouvée'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Créer un nouvel utilisateur et définir ses propriétés
        $user = new User();
        $user->setEmail($data['email']);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setTel($data['tel']);
        $user->setAdresse($data['adresse']);
        $user->setEcole($ecole);

        // Créer une nouvelle instance de Messagerie et l'associer à l'utilisateur
        $messagerie = new Messagerie();
        $manager->persist($messagerie);
        $user->setMessagerie($messagerie);

        // Valider l'utilisateur
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        // Persister l'utilisateur dans la base de données
        $manager->persist($user);
        $manager->flush();

        // Retourner une réponse de succès
        return new JsonResponse(['message' => 'Utilisateur enregistré avec succès'], JsonResponse::HTTP_CREATED);
    }
}
