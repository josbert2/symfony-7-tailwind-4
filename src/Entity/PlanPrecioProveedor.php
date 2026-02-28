<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity]
//  * @ORM\Table(
//  *     name="plan_precio_proveedor",
//  *     uniqueConstraints={
//  *         @ORM\UniqueConstraint(
//  *             name="uniq_proveedor_plan_activo",
//  *             columns={"proveedor_id", "plan_id", "activo"}
//  *         )
//  *     }
//  * )
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class PlanPrecioProveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'proveedor')]
    #[ORM\JoinColumn(nullable: false)]
    private $proveedor;

    #[ORM\ManyToOne(targetEntity: 'Plan')]
    #[ORM\JoinColumn(nullable: false)]
    private $plan;

    #[ORM\Column(type: 'integer')]
    private $monto;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\Column(type: 'datetime')]
    private $validoDesde;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $validoHasta;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getId()
    {
        return $this->id;
    }

    public function getProveedor()
    {
        return $this->Proveedor;
    }

    public function getPlan()
    {
        return $this->plan;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function getValidoDesde()
    {
        return $this->validoDesde;
    }

    public function getValidoHasta()
    {
        return $this->validoHasta;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted(\DateTimeInterface $deleted)
    {
        $this->deleted = $deleted;
    }

    public function setUpdated(\DateTimeInterface $updated)
    {
        $this->updated = $updated;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setValidoHasta(\DateTimeInterface $validoHasta)
    {
        $this->validoHasta = $validoHasta;
    }

    public function setValidoDesde(\DateTimeInterface $validoDesde)
    {
        $this->validoDesde = $validoDesde;
    }

    public function setActivo(bool $activo)
    {
        $this->activo = $activo;
    }

    public function setMonto(int $monto)
    {
        $this->monto = $monto;
    }

    public function setPlan(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function setProveedor(Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;
    }


}
