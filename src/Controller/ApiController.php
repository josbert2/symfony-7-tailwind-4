<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]

class ApiController extends AbstractController
{
    #[Route('/data', name: 'api_data', methods: ['GET'])]
    public function getData(): JsonResponse
    {
        return $this->json([
            'message' => '¡API funcionando correctamente!',
        ]);
    }


    #[Route('/public', name: 'api_public', methods: ['GET'])]
    public function getPublic(): JsonResponse
    {
        return $this->json([
            'message' => '¡Public data!',
        ]);
    }


    #[Route('/login', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request,
        UserAuthenticatorInterface $authenticator,
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse {
      

        return new JsonResponse(['error' => 'Método no implementado'], 501);
    }


}

