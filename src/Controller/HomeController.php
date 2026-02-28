<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Skipthedragon\InertiaBundle\Architecture\InertiaInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(InertiaInterface $inertia): Response
    {
        return $inertia->render('Home', [
            'message' => '🚀 Conectado correctamente al backend a través de InertiaJS',
        ]);
    }
}
