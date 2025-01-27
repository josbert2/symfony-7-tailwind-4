<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Usuario;
use App\Entity\Proveedor; 


class ProveedorController extends AbstractController
{
    #[Route('/proveedor', name: 'app_proveedor')]
    public function index(EntityManagerInterface $em): Response
    {
        ini_set('memory_limit', '2048M');
       // get all users 

       $users = $em->getRepository(Usuario::class)->findBy(['email' => 'test@entrekids.cl']);
       $f = $em->getRepository(Proveedor::class)->getAnyWayProveedor();
      

       return $this->render('proveedor/index.html.twig', [
           'controller_name' => 'ProveedorController',
       ]);
    }

    
    
}
