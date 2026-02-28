<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\EnvioRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Envio
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $despacho = 0;

    #[ORM\Column(type: 'boolean')]
    private $productos = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaMaxima;

    #[ORM\Column(type: 'integer')]
    private $monto = 0;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;

    #[ORM\Column(type: 'integer')]
    private $total = 0;

    #[ORM\Column(type: 'integer')]
    private $sla = 0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $entrega;

    #[ORM\OneToOne(targetEntity: 'Dte', inversedBy: 'envio')]
    protected $dte;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Transaccion', inversedBy: 'envios')]
    protected $transaccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Bodega', inversedBy: 'envios')]
    protected $bodega;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Direccion', inversedBy: 'envios')]
    protected $direccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Sucursal', inversedBy: 'envios')]
    protected $sucursal;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Carrier', inversedBy: 'envios')]
    protected $carrier;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Item', mappedBy: 'envio')]
    protected $items;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Paquete', mappedBy: 'envio')]
    protected $paquetes;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
    }

    public function getCodigo()
    {
        return 'ORD'.sprintf("%08d", $this->id);
    }

    public function getCliente()
    {
        return $this->getTransaccion()->getCliente();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDespacho(): ?int
    {
        return $this->despacho;
    }

    public function setDespacho(int $despacho): self
    {
        $this->despacho = $despacho;

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

    public function getTransaccion(): ?Transaccion
    {
        return $this->transaccion;
    }

    public function setTransaccion(?Transaccion $transaccion): self
    {
        $this->transaccion = $transaccion;

        return $this;
    }

    public function getBodega(): ?Bodega
    {
        return $this->bodega;
    }

    public function setBodega(?Bodega $bodega): self
    {
        $this->bodega = $bodega;

        return $this;
    }

    public function getDireccion(): ?Direccion
    {
        return $this->direccion;
    }

    public function setDireccion(?Direccion $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getSucursal(): ?Sucursal
    {
        return $this->sucursal;
    }

    public function setSucursal(?Sucursal $sucursal): self
    {
        $this->sucursal = $sucursal;

        return $this;
    }

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(?Carrier $carrier): self
    {
        $this->carrier = $carrier;

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
            $item->setEnvio($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getEnvio() === $this) {
                $item->setEnvio(null);
            }
        }

        return $this;
    }

//      * @return Collection|Paquete[]

    public function getPaquetes(): Collection
    {
        return $this->paquetes;
    }

    public function addPaquete(Paquete $paquete): self
    {
        if (!$this->paquetes->contains($paquete)) {
            $this->paquetes[] = $paquete;
            $paquete->setEnvio($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getEnvio() === $this) {
                $paquete->setEnvio(null);
            }
        }

        return $this;
    }

    public function getProductos(): ?bool
    {
        return $this->productos;
    }

    public function setProductos(bool $productos): self
    {
        $this->productos = $productos;

        return $this;
    }

    public function getFechaMaxima(): ?\DateTimeInterface
    {
        return $this->fechaMaxima;
    }

    public function setFechaMaxima(?\DateTimeInterface $fechaMaxima): self
    {
        $this->fechaMaxima = $fechaMaxima;

        return $this;
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

    public function getEntrega(): ?\DateTimeInterface
    {
        return $this->entrega;
    }

    public function setEntrega(?\DateTimeInterface $entrega): self
    {
        $this->entrega = $entrega;

        return $this;
    }

    public function getSla(): ?int
    {
        return $this->sla;
    }

    public function setSla(int $sla): self
    {
        $this->sla = $sla;

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

}
