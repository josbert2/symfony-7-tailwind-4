<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\ActividadMarketRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="idx_activo", columns={"activo")
//  * )

class ActividadMarket
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $cobroVariable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $modeloVenta;

    #[ORM\Column(type: 'boolean')]
    private $comisionAsistente = false;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Actividad', inversedBy: 'actividadMarkets')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'actividadMarkets')]
    protected $market;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ProveedorRut', inversedBy: 'actividadMarkets')]
    protected $proveedorRut;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orden;

    #[ORM\Column(type: 'boolean')]
    private $destacado = false;

    #[ORM\Column(type: 'boolean')]
    private $nuevo = false;

    #[ORM\Column(type: 'boolean')]
    private $ocultar = false;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getProveedorMarket()
    {
        foreach($this->getActividad()->getProveedor()->getProveedorMarkets() as $proveedorMarket){
            if($proveedorMarket->getMarket() == $this->getMarket()){
                return $proveedorMarket;
            }
        }

        return NULL;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCobroVariable(): ?int
    {
        return $this->cobroVariable;
    }

    public function setCobroVariable(?int $cobroVariable): self
    {
        $this->cobroVariable = $cobroVariable;

        return $this;
    }

    public function getModeloVenta(): ?string
    {
        return $this->modeloVenta;
    }

    public function setModeloVenta(?string $modeloVenta): self
    {
        $this->modeloVenta = $modeloVenta;

        return $this;
    }

    public function getComisionAsistente(): ?bool
    {
        return $this->comisionAsistente;
    }

    public function setComisionAsistente(bool $comisionAsistente): self
    {
        $this->comisionAsistente = $comisionAsistente;

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

    public function getActividad(): ?Actividad
    {
        return $this->actividad;
    }

    public function setActividad(?Actividad $actividad): self
    {
        $this->actividad = $actividad;

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

    public function getProveedorRut(): ?ProveedorRut
    {
        return $this->proveedorRut;
    }

    public function setProveedorRut(?ProveedorRut $proveedorRut): self
    {
        $this->proveedorRut = $proveedorRut;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getDestacado(): ?bool
    {
        return $this->destacado;
    }

    public function setDestacado(bool $destacado): self
    {
        $this->destacado = $destacado;

        return $this;
    }

    public function getNuevo(): ?bool
    {
        return $this->nuevo;
    }

    public function setNuevo(bool $nuevo): self
    {
        $this->nuevo = $nuevo;

        return $this;
    }

    public function getOcultar(): ?bool
    {
        return $this->visible;
    }

    public function setOcultar(bool $ocultar): self
    {
        $this->visible = $ocultar;

        return $this;
    }

}
