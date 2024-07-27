<?php

namespace App\Controller;



use App\Entity\Ecole;
use App\Repository\EcoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class EcoleController extends AbstractController
{
    //définition du chemin d'accès par une route méthode HTTP 'GET'
    #[Route('/api/ecoles', name: 'ecolesList', methods: ['GET'])]

    //fonction pour récupération de la liste des écoles
    public function getEcolesList(EcoleRepository $ecoleRepository, SerializerInterface $serializer,TagAwareCacheInterface $cache): JsonResponse
    {
//identifiant du cache
  $idCache = "getEcolesList";

// récupération data du cache
  $jsonecoleList = $cache->get($idCache, function (ItemInterface $item) use ($ecoleRepository, $serializer){
    $item->tag("ecolesCache");

    return $serializer->serialize($ecoleRepository->findAll(), 'json',['groups' => 'getEcoles']);

//requête pour affichage de la liste de toutes les écoles
    $ecoleList = $ecoleRepository->findAll();
        $context [] = SerializationContext::create()->setGroups(['getEcoles']);

        return $serializer->serialize($ecoleList, 'json', $context);
});

 // Retour la liste des classes en JSON
 return new JsonResponse($jsonClasseList, Response::HTTP_OK, [], true);
    }


    //définition du chemin d'accès par une route méthode HTTP 'GET'
    #[Route('/api/ecoles/{id}', name: 'detailEcole', methods: ['GET'])]
    //fonction pour récupération d'une école via son Id
    public function getDetailEcole(SerializerInterface $serializer, Ecole $ecole): JsonResponse
    {


        //sérialisation pour le groupe 'getEcoles'
        $jsonEcole = $serializer->serialize($ecole, 'json', ['groups' => 'getEcoles']);
        // Retourne les détails de la école en JSON
        return new JsonResponse($jsonEcole, Response::HTTP_OK, ['accept' => 'json'], true);
    }
 //définition du chemin d'accès par une route méthode HTTP 'DELETE'
     #[Route('/api/ecoles/{id}', name: 'deleteEcole', methods: ['DELETE'])]
    // #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits suffisants pour supprimer une école')]
    // fonction pour supprimer une ecole via selection de Id
    public function deleteEcole(Ecole $ecole, EntityManagerInterface $em,TagAwareCacheInterface $cachePool): JsonResponse
    {

         // Invalide le cache associé aux écoles
         $cachePool->invalidateTags(["classesCache"]);

         // Suppression de l'école de la base de données
        $em->remove($ecole);
        $em->flush();

        // Retourne une réponse indiquant que le contenu n'existe plus
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
//définition du chemin d'accès par une route méthode HTTP 'POST'
    #[Route('/api/ecoles', name: 'createEcole', methods: ['POST'])]
    // #[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits suffisants pour créer une école')]
      // fonction pour créer une ecole
    public function createBook(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, UserRepository $userRepository, ValidatorInterface $validator,TagAwareCacheInterface $cachePool): JsonResponse
    {

        // Invalide le cache associé aux écoles
        $cachePool->invalidateTags(["ecolesCache"]);

        // Désérialisation du contenu de la requête pour créer une instance de Ecole.
        $ecole = $serializer->deserialize($request->getContent(), Ecole::class, 'json');

        // Récupération des données envoyées avec la requête.
        $content = $request->toArray();
        // Récupération de l'ID de l'admin, avec une valeur par défaut si non spécifié.
        // $idAdmin = $content['idAdmin'] ?? -1;
        // // Association de l'admin à 'école.
        // $user = $userRepository->find($idAdmin);
        // if (!$user) {
        //     return new JsonResponse(['error' => 'admin not found'], JsonResponse::HTTP_BAD_REQUEST);
        // }
        // $ecole->setUser($user);

        // Vérification des erreurs
        $errors = $validator->validate($ecole);
        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }



        // Persistance de l'école dans la base de données.
        $em->persist($ecole);
        $em->flush();

        // Sérialisation pour le groupe 'getEcoles'
        $jsonEcole = $serializer->serialize($ecole, 'json', ['groups'
        => 'getEcoles']);

        // Génération de l'URL vers les détails de l'école créée.
        $location = $urlGenerator->generate('detailEcole', ['id' => $ecole->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retour d'une réponse JSON avec l'URL de l'école créée.
        return new JsonResponse($jsonEcole, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    #[Route("/api/ecoles/{id}", name: "updateEcole", methods: ["PUT"])]
    // #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits suffisants pour modifier un livre')]

    public function updateEcole(Request $request, SerializerInterface $serializer, Ecole $currentEcole, EntityManagerInterface $em, EcoleRepository $EcoleRepository, ValidatorInterface $validator,TagAwareCacheInterface $cachePool): JsonResponse
    {

        // Invalidate le cache associé aux écoles
        $cachePool->invalidateTags(["ecolesCache"]);

        // Désérialisation du contenu de la requête pour mettre à jour l'école.

        $updateEcole = $serializer->deserialize($request->getContent(), Ecole::class, 'json');

        // modification des données verification des erreurs
        $currentEcole->setNameEc($updateEcole->getNameEc());
        $currentEcole->setAdresseEc($updateEcole->getAdresseEc());
        $currentEcole->setTelEc($updateEcole->getTelEc());
        $currentEcole->setMailEc($updateEcole->getMailEc());


        $errors = $validator->validate($currentEcole);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST, [], true);
        }

        $em->persist($currentEcole);
        $em->flush();

        $jsonEcole = $serializer->serialize($currentEcole, 'json', ['groups' => 'getEcoles']);
        return new JsonResponse($jsonEcole, Response::HTTP_OK, [], true);
    }
}
