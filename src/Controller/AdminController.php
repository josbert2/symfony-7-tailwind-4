<?php

namespace App\Controller;

use App\Service\AdminMockDataService;
use Rompetomp\InertiaBundle\Architecture\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    public function __construct(
        private readonly AdminMockDataService $mocks,
    ) {}

    #[Route('', name: 'admin_dashboard', methods: ['GET'])]
    public function dashboard(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Dashboard', [
            ...$this->mocks->sharedProps(),
            ...$this->mocks->dashboard(),
        ]);
    }

    #[Route('/proveedores', name: 'admin_proveedores', methods: ['GET'])]
    public function proveedores(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Proveedores', [
            ...$this->mocks->sharedProps(),
            ...$this->mocks->proveedores(),
        ]);
    }

    #[Route('/actividades', name: 'admin_actividades', methods: ['GET'])]
    public function actividades(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Actividades', [
            ...$this->mocks->sharedProps(),
            ...$this->mocks->actividades(),
        ]);
    }

    #[Route('/transacciones', name: 'admin_transacciones', methods: ['GET'])]
    public function transacciones(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Transacciones', [
            ...$this->mocks->sharedProps(),
            'transacciones' => $this->mocks->transacciones(),
        ]);
    }

    #[Route('/liquidaciones', name: 'admin_liquidaciones', methods: ['GET'])]
    public function liquidaciones(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Liquidaciones', [
            ...$this->mocks->sharedProps(),
            ...$this->mocks->liquidaciones(),
        ]);
    }

    #[Route('/dte', name: 'admin_dte', methods: ['GET'])]
    public function dte(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Dte', [
            ...$this->mocks->sharedProps(),
            ...$this->mocks->dte(),
        ]);
    }

    #[Route('/usuarios', name: 'admin_usuarios', methods: ['GET'])]
    public function usuarios(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Usuarios', [
            ...$this->mocks->sharedProps(),
            ...$this->mocks->usuarios(),
        ]);
    }

    #[Route('/reportes', name: 'admin_reportes', methods: ['GET'])]
    public function reportes(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Reportes', $this->mocks->sharedProps());
    }

    #[Route('/configuracion', name: 'admin_configuracion', methods: ['GET'])]
    public function configuracion(InertiaInterface $inertia): Response
    {
        return $inertia->render('Admin/Configuracion', $this->mocks->sharedProps());
    }
}
