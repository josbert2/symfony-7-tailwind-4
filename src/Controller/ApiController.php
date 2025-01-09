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


    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login()
    {
        $user = $this->getUser();
        return new JsonResponse([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles()
        ]);
    }


}

