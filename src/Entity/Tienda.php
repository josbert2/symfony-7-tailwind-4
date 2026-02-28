<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\TiendaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Tienda
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'integer')]
    private $cobroVariable = 0;
    
    #[ORM\Column(type: 'integer')]
    private $cobroFijo = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroEntrada = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $periodoFacturacion;

    #[ORM\Column(type: 'boolean')]
    private $marketPropio = false;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'tiendas')]
    protected $proveedor;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'tiendas')]
    protected $market;
    
    #[ORM\ManyToOne(targetEntity: 'Plan', inversedBy: 'proveedores')]
    protected $plan;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCobroVariable(): ?int
    {
        return $this->cobroVariable;
    }

    public function setCobroVariable(int $cobroVariable): self
    {
        $this->cobroVariable = $cobroVariable;

        return $this;
    }

    public function getCobroFijo(): ?int
    {
        return $this->cobroFijo;
    }

    public function setCobroFijo(int $cobroFijo): self
    {
        $this->cobroFijo = $cobroFijo;

        return $this;
    }

    public function getCobroEntrada(): ?int
    {
        return $this->cobroEntrada;
    }

    public function setCobroEntrada(int $cobroEntrada): self
    {
        $this->cobroEntrada = $cobroEntrada;

        return $this;
    }

    public function getPeriodoFacturacion(): ?string
    {
        return $this->periodoFacturacion;
    }

    public function setPeriodoFacturacion(?string $periodoFacturacion): self
    {
        $this->periodoFacturacion = $periodoFacturacion;

        return $this;
    }

    public function getMarketPropio(): ?bool
    {
        return $this->marketPropio;
    }

    public function setMarketPropio(bool $marketPropio): self
    {
        $this->marketPropio = $marketPropio;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        $this->market = $market;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

}
