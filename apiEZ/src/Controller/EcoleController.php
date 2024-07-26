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
    #[Route('/api/ecoles', name: 'ecolesList', methods: ['GET'])]
    public function getEcolesList(EcoleRepository $ecoleRepository, SerializerInterface $serializer,TagAwareCacheInterface $cache): JsonResponse
    { 

  $idCache = "getEcolesList";

  $jsonecoleList = $cache->get($idCache, function (ItemInterface $item) use ($ecoleRepository, $serializer){
    $item->tag("ecolesCache");

    return $serializer->serialize($ecoleRepository->findAll(), 'json',['groups' => 'getEcoles']);  
  
      
    $ecoleList = $ecoleRepository->findAll();     
    
        $context [] = SerializationContext::create()->setGroups(['getEcoles']);

        return $serializer->serialize($ecoleList, 'json', $context);
});


        return new JsonResponse($jsonecoleList, Response::HTTP_OK, [], true);
    }

   
    #[Route('/api/ecoles/{id}', name:'detailEcole', methods: ['GET'])]
    public function getDetailEcole( SerializerInterface $serializer, Ecole $ecole): JsonResponse
    {
       
        $jsonEcole = $serializer->serialize($ecole ,'json');
        return new JsonResponse($jsonEcole, Response::HTTP_OK,[], true);
    
        $jsonEcole = $serializer->serialize($ecole ,'json',['groups' => 'getEcoles'] );
        return new JsonResponse($jsonEcole, Response::HTTP_OK,['accept' => 'json'], true);
    }

    #[Route ('/api/ecoles/{id}', name: 'deleteEcole', methods: ['DELETE'])]
    // #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits suffisants pour supprimer une école')]
        public function deleteBook(Ecole $ecole, EntityManagerInterface $em): JsonResponse
    {
      
        $em->remove($ecole);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/api/ecoles', name:'createEcole', methods: ['POST'])]
    // #[IsGranted('ROLE_ADMIN', message:'Vous n\'avez pas les droits suffisants pour créer une école')]
    public function createBook(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator, UserRepository $userRepository, ValidatorInterface $validator,TagAwareCacheInterface $cachePool): JsonResponse
    {
      
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

        $jsonEcole = $serializer->serialize($ecole, 'json', ['groups'
        => 'getEcoles']);

        // Génération de l'URL vers les détails du livre créé.
        $location = $urlGenerator->generate('detailEcole', ['id' => $ecole->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        // Retour d'une réponse JSON avec l'URL du livre créé.
        return new JsonResponse($jsonEcole, Response::HTTP_CREATED, ['Location' => $location], true);
    }

    #[Route("/api/ecoles/{id}", name:"updateEcole", methods: ["PUT"])]
    // #[IsGranted('ROLE_ADMIN', message: 'Vous n\'avez pas les droits suffisants pour modifier un livre')]

    public function updateEcole(Request $request, SerializerInterface $serializer, Ecole $currentEcole, EntityManagerInterface $em, EcoleRepository $EcoleRepository, ValidatorInterface $validator,TagAwareCacheInterface $cachePool): JsonResponse
    {

        $cachePool->invalidateTags(["ecolesCache"]);
  
        $updateEcole = $serializer->deserialize($request->getContent(), Ecole::class,'json');
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

