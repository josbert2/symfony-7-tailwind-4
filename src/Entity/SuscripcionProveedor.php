<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity]
    #[ORM\Table(name: 'suscripcion_proveedor')]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class SuscripcionProveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'suscripciones')]
    #[ORM\JoinColumn(nullable: false)]
    private $proveedor;

    #[ORM\ManyToOne(targetEntity: 'Cliente')]
    #[ORM\JoinColumn(nullable: false)]

    private $cliente;

    #[ORM\ManyToOne(targetEntity: 'Plan')]
    #[ORM\JoinColumn(nullable: false)]
    private $plan;

    #[ORM\Column(type: 'integer')]
    private $monto;

    #[ORM\Column(type: 'string', length: 20)]
    private $estado;

    #[ORM\Column(type: 'datetime')]
    private $inicioPeriodoActual;

    #[ORM\Column(type: 'datetime')]
    private $finPeriodoActual;

    #[ORM\Column(type: 'datetime')]
    private $proximoCobro;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $canceladaEn;

    #[ORM\Column(type: 'integer')]
    private $cantidadReintentos = 0;

    #[ORM\Column(type: 'integer')]
    private $maxReintentos = 3;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;

    public function getId()
    {
        return $this->id;
    }

    public function getProximoCobro()
    {
        return $this->proximoCobro;
    }

    public function setProximoCobro(\DateTime $proximoCobro)
    {
        $this->proximoCobro = $proximoCobro;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted(\DateTime $deleted)
    {
        $this->deleted = $deleted;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor(Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function getPlan()
    {
        return $this->plan;
    }

    public function setPlan(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getInicioPeriodoActual()
    {
        return $this->inicioPeriodoActual;
    }

    public function setInicioPeriodoActual(\DateTime $inicioPeriodoActual)
    {
        $this->inicioPeriodoActual = $inicioPeriodoActual;
    }

    public function getFinPeriodoActual()
    {
        return $this->finPeriodoActual;
    }

    public function setFinPeriodoActual(\DateTime $finPeriodoActual)
    {
        $this->finPeriodoActual = $finPeriodoActual;
    }

    public function getCanceladaEn()
    {
        return $this->canceladaEn;
    }

    public function setCanceladaEn(\DateTime $canceladaEn)
    {
        $this->canceladaEn = $canceladaEn;
    }

    public function getCantidadReintentos()
    {
        return $this->cantidadReintentos;
    }

    public function setCantidadReintentos($cantidadReintentos)
    {
        $this->cantidadReintentos = $cantidadReintentos;
    }

    public function getMaxReintentos()
    {
        return $this->maxReintentos;
    }

    public function setMaxReintentos($maxReintentos)
    {
        $this->maxReintentos = $maxReintentos;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    
}
