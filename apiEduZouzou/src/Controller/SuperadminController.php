<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Repository\EcoleRepository;
use App\Repository\SuperAdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;

use JMS\Serializer\Serializer;


class SuperadminController extends AbstractController
{
    // #[Route('/superadmin', name: 'superadmin')]
    // public function index(): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/SuperadminController.php',
    //     ]);
    // }
   
    // #[Route('/superadmin', name: 'superadmin', methods: ['GET'])]
    // public function getSuperAdminList(SuperAdminRepository $superAdminRepository, SerializerInterface $serializer): JsonResponse
    // {
    //     $superAdminList = $superAdminRepository->findAll();
     
    //     $jsonSuperAdminList = $serializer->serialize($superAdminList, 'json',['groups' => 'getSA']);

    //     return new JsonResponse($jsonSuperAdminList, Response::HTTP_OK, [], true);
    // }

    #[Route('/superadmin', name: 'superadmin', methods: ['GET'])]
    public function getEcolesList(EcoleRepository $ecoleRepository, SerializerInterface $serializer): JsonResponse
    {
        $ecoleList = $ecoleRepository->findAll();
     
        $jsonecoleList = $serializer->serialize($ecoleList, 'json',['groups' => 'getEcoles']);

        return new JsonResponse($jsonecoleList, Response::HTTP_OK, [], true);
    }


}
