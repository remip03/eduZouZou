<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Repository\EcoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;

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
   
    #[Route('/superadmin', name: 'app_superadmin', methods: ['GET'])]
    public function getEcolesList(EcoleRepository $ecoleRepository, SerializerInterface $serializer): JsonResponse
    {
        $ecolesList = $ecoleRepository->findAll();
        $jsonEcolesList = $serializer->serialize($ecolesList, 'json',);

        return new JsonResponse($jsonEcolesList, Response::HTTP_OK, [], true);
    }


}
