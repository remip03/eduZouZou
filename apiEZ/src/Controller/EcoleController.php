<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Repository\EcoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EcoleController extends AbstractController
{
    #[Route('/ecoles', name: 'ecolesList', methods: ['GET'])]
    public function getEcolesList(EcoleRepository $ecoleRepository, SerializerInterface $serializer): JsonResponse
    {
        $ecoleList = $ecoleRepository->findAll();
     
        $jsonecoleList = $serializer->serialize($ecoleList, 'json',['groups' => 'getEcoles']);

        return new JsonResponse($jsonecoleList, Response::HTTP_OK, [], true);
    }

   
    // #[Route('/ecoles/{id}', name:'detailEcole', methods: ['GET'])]
    // public function getDetailEcole( SerializerInterface $serializer, Ecole $ecole): JsonResponse
    // {
       
    //     $jsonAuthor = $serializer->serialize($ecole ,'json');
    //     return new JsonResponse($jsonAuthor, Response::HTTP_OK,[], true);
    
    //     $jsonEcole = $serializer->serialize($ecole ,'json',['groups' => 'getEcoles'] );
    //     return new JsonResponse($jsonEcole, Response::HTTP_OK,['accept' => 'json'], true);
    // }
}
