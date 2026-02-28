<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\TransaccionDetalleRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class TransaccionDetalle
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $monto = 0;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;
    
    #[ORM\Column(type: 'integer')]
    private $total = 0;
    
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaPago;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Transbank', inversedBy: 'transaccion')]
    protected $transbank;
    
    #[ORM\OneToOne(targetEntity: 'App\Entity\Dte', inversedBy: 'transaccionDetalle')]
    protected $dte;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Transaccion', inversedBy: 'detalles')]
    protected $transaccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'transaccionDetalles')]
    protected $proveedor;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'transaccionDetalles')]
    protected $market;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\TransaccionDetalleEstado', mappedBy: 'transaccionDetalle')]
    protected $estados;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\Item', mappedBy: 'transaccionDetalle')]
    protected $items;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $tipo = null;

    public function __construct()
    {
        $this->estados = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;
        $transaccionDEtalleEstado = new TransaccionDetalleEstado();
        $transaccionDEtalleEstado->setEstado($estado);
        $this->addEstado($transaccionDEtalleEstado);

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(int $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->fechaPago;
    }

    public function setFechaPago(?\DateTimeInterface $fechaPago): self
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
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

    public function getTransbank(): ?Transbank
    {
        return $this->transbank;
    }

    public function setTransbank(?Transbank $transbank): self
    {
        $this->transbank = $transbank;

        return $this;
    }

    public function getDte(): ?Dte
    {
        return $this->dte;
    }

    public function setDte(?Dte $dte): self
    {
        $this->dte = $dte;

        return $this;
    }

//      * @return Collection|TransaccionDetalleEstado[]
     
    public function getEstados(): Collection
    {
        return $this->estados;
    }

    public function addEstado(TransaccionDetalleEstado $estado): self
    {
        if (!$this->estados->contains($estado)) {
            $this->estados[] = $estado;
            $estado->setTransaccionDetalle($this);
        }

        return $this;
    }

    public function removeEstado(TransaccionDetalleEstado $estado): self
    {
        if ($this->estados->removeElement($estado)) {
            // set the owning side to null (unless already changed)
            if ($estado->getTransaccionDetalle() === $this) {
                $estado->setTransaccionDetalle(null);
            }
        }

        return $this;
    }

//      * @return Collection|Item[]

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setTransaccionDetalle($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getTransaccionDetalle() === $this) {
                $item->setTransaccionDetalle(null);
            }
        }

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

    public function getTransaccion(): ?Transaccion
    {
        return $this->transaccion;
    }

    public function setTransaccion(?Transaccion $transaccion): self
    {
        $this->transaccion = $transaccion;

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

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

}
