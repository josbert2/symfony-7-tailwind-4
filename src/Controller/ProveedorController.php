<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class ProveedorController extends AbstractController
{
    #[Route('/proveedor', name: 'app_proveedor')]
    public function index(EntityManagerInterface $em): Response
    {
        ini_set('memory_limit', '-1');
        $conn = $em->getConnection();

        $sql = '
            SELECT * FROM usuario LIMIT 10
            ';

        $resultSet = $conn->executeQuery($sql);
        dump($resultSet->fetchAllAssociative());
        die();

        return $this->render('proveedor/index.html.twig', [
            'controller_name' => 'ProveedorController',
        ]);
    }
}
