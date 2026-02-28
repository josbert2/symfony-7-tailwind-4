<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\PaqueteRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Paquete
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idMarket;

    #[ORM\Column(type: 'integer')]
    private $monto = 0;

    #[ORM\Column(type: 'integer')]
    private $despacho = 0;

    #[ORM\Column(type: 'integer')]
    private $bultos = 0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaMaxima;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estadoSeller;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idSeller;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idRetiroSeller;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $trackingNumber;

    #[ORM\Column(type: 'text', nullable: true)]
    private $pdf;

    #[ORM\Column(type: 'text', nullable: true)]
    private $zpl;

    #[ORM\Column(type: 'text', nullable: true)]
    private $manifiestoPdf;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $etiqueta;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $impresion;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $manifiesto;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $retiro;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $entregas;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $listoRetiro;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $entrega;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $cancelacion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razonCancelacion;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $bonificacionPuntos;

    #[ORM\Column(type: 'boolean')]
    private $fulfillment = false;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Item', inversedBy: 'paquete')]
    protected $item;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Paquete', inversedBy: 'paquetes')]
    protected $paquete;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Envio', inversedBy: 'paquetes')]
    protected $envio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Bodega', inversedBy: 'paquetes')]
    protected $bodega;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Sucursal', inversedBy: 'paquetes')]
    protected $sucursal;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Carrier', inversedBy: 'paquetes')]
    protected $carrier;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'paquetes')]
    protected $proveedor;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Proveedor', inversedBy: 'paquetesMulti')]
    protected $proveedores;

    #[ORM\OneToMany(targetEntity: 'App\Entity\PaqueteEstado', mappedBy: 'paquete')]
    protected $estados;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Paquete', mappedBy: 'paquete')]
    protected $paquetes;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razon;

    #[ORM\OneToOne(mappedBy: 'paqueteAsociado', targetEntity: Indemnizacion::class)]
    private $indemnizacion;

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;
        $paqueteEstado = $this->getPaqueteEstado();
        $paqueteEstado->setEstado($estado);
        $this->addEstado($paqueteEstado);

        return $this;
    }

    public function setEstadoSeller(?string $estadoSeller): self
    {
        $this->estadoSeller = $estadoSeller;
        $paqueteEstado = $this->getPaqueteEstado();
        $paqueteEstado->setEstado($estadoSeller);
        $this->addEstado($paqueteEstado);

        return $this;
    }

    public function __construct()
    {
        $this->estados = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
        $this->proveedores = new ArrayCollection();
    }

    public function getCodigo()
    {
        $codigo = 'PKG' . sprintf("%08d", $this->getId());
        if ($this->getFulfillment()) {
            $codigo[3] = 'F';
        }

        return $codigo;
    }

    public function getCliente()
    {
        return $this->getItem()->getTransaccion()->getCliente();
    }

    public function getDireccion()
    {
        $envio = $this->getEnvio();
        $direccion = $envio->getDireccion();
        if (!$direccion) {
            $direccion = $this->getSucursal() ? $this->getSucursal()->getDireccion() : '';
        }

        return $direccion;
    }

    public function getPeso()
    {
        $peso = 0;
        foreach ($this->getItems() as $item) {
            $ficha = $item->getActividad()->getFicha();
            $peso += $ficha->getPeso() ?: '1';
        }

        return $peso;
    }

    public function getVolumen()
    {
        $volumen = 0;
        foreach ($this->getItems() as $item) {
            $ficha = $item->getActividad()->getFicha();
            $alto = $ficha->getAlto() ?: '100';
            $ancho = $ficha->getAncho() ?: '100';
            $largo = $ficha->getLargo() ?: '100';
            $volumen += $alto * $ancho * $largo / 1000000;
        }

        return $volumen;
    }

    public function getTotal($original = false)
    {
        $total = 0;
        foreach ($this->getItems() as $item) {
            $total += $item->getPrecioCantidad($original);
        }

        return $total;
    }

    public function getDescripcion()
    {
        $descripcion = '';
        $firsItem = true;
        $items = $this->getItems();
        foreach ($items as $item) {
            if ($firsItem) {
                $firsItem = false;
            } else {
                $descripcion .= ' | ';
            }

//            $tipoPrecio = $item->getTipoPrecio();
//            $actividad = $item->getActividad();
//            $descripcion .= $actividad->getNombre();
//            if($actividad->getNombre() != $tipoPrecio){
//                $descripcion .= ' - '.$tipoPrecio;
//            }

            if (count($items) > 0 && $item->getPaquete()) {
//                $descripcion .= ' ('.$item->getPaquete()->getCodigo().')';
                $descripcion .= $item->getPaquete()->getCodigo();
            }
        }

        return $descripcion;
    }

//      * @return Item[]
     
    public function getItems()
    {
        $items = [];
        if ($this->getPaquetes()->count() > 0) {
            foreach ($this->getPaquetes() as $paquete) {
                $items[] = $paquete->getItem();
            }
        } else {
            $items[] = $this->item;
        }

        return $items;
    }

    public function getItem(): ?Item
    {
        $item = $this->item;
        if (!$item) {
            $items = $this->getItems();
            $item = array_pop($items);
        }
        return $item;
    }

    public function getEnvio(): ?Envio
    {
        $envio = $this->envio;
        if (!$envio && $this->getPaquetes()->first()) {
            $envio = $this->getPaquetes()->first()->getEnvio();
        }

        return $envio;
    }

    public function getEstado($hijo = false): ?string
    {
        if ($this->getPaquete() && !$hijo) {
            $estado = 'Asociado a padre';
        } else {
            $estado = $this->estado;
        }

        return $estado;
    }

    public function getEtiqueta(): ?\DateTimeInterface
    {
        return $this->getPaquete() ? $this->getPaquete()->getEtiqueta() : $this->etiqueta;
    }

    public function getEntrega(): ?\DateTimeInterface
    {
        return $this->getPaquete() ? $this->getPaquete()->getEntrega() : $this->entrega;
    }

    public function getListoRetiro(): ?\DateTimeInterface
    {
        return $this->getPaquete() ? $this->getPaquete()->getListoRetiro() : $this->listoRetiro;
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

    public function getDespacho(): ?int
    {
        return $this->despacho;
    }

    public function setDespacho(int $despacho): self
    {
        $this->despacho = $despacho;

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

    public function getEstadoFull(): ?string
    {
        $estado = $this->getEstado();
        if ($estado == 'Confirmado') {
            if ($this->getManifiesto()) {
                $lEstado = 'Retiro';
            } elseif ($this->getImpresion()) {
                $lEstado = 'Manifiesto';
            } elseif ($this->getEtiqueta()) {
                $lEstado = 'Imprimir';
            } else {
                $lEstado = 'Generar etiquetas';
            }

            $estado .= ' - ' . $lEstado;
        }

        return $estado;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

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

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function setEnvio(?Envio $envio): self
    {
        $this->envio = $envio;

        return $this;
    }

//      * @return Collection|PaqueteEstado[]

    public function getEstados(): Collection
    {
        return $this->estados;
    }

    public function addEstado(PaqueteEstado $estado): self
    {
        if (!$this->estados->contains($estado)) {
            $this->estados[] = $estado;
            $estado->setPaquete($this);
        }

        return $this;
    }

    public function removeEstado(PaqueteEstado $estado): self
    {
        if ($this->estados->contains($estado)) {
            $this->estados->removeElement($estado);
            // set the owning side to null (unless already changed)
            if ($estado->getPaquete() === $this) {
                $estado->setPaquete(NULL);
            }
        }

        return $this;
    }

    public function getRazonCancelacion(): ?string
    {
        return $this->razonCancelacion;
    }

    public function setRazonCancelacion(?string $razonCancelacion): self
    {
        $this->razonCancelacion = $razonCancelacion;

        return $this;
    }

    public function setEtiqueta(?\DateTimeInterface $etiqueta): self
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    public function getImpresion(): ?\DateTimeInterface
    {
        return $this->impresion;
    }

    public function setImpresion(?\DateTimeInterface $impresion): self
    {
        $this->impresion = $impresion;

        return $this;
    }

    public function getManifiesto(): ?\DateTimeInterface
    {
        return $this->manifiesto;
    }

    public function setManifiesto(?\DateTimeInterface $manifiesto): self
    {
        $this->manifiesto = $manifiesto;

        return $this;
    }

    public function getRetiro(): ?\DateTimeInterface
    {
        return $this->retiro;
    }

    public function setRetiro(?\DateTimeInterface $retiro): self
    {
        $this->retiro = $retiro;

        return $this;
    }

    public function setEntrega(?\DateTimeInterface $entrega): self
    {
        $this->entrega = $entrega;

        return $this;
    }

    public function getCancelacion(): ?\DateTimeInterface
    {
        return $this->cancelacion;
    }

    public function setCancelacion(?\DateTimeInterface $cancelacion): self
    {
        $this->cancelacion = $cancelacion;

        return $this;
    }

    public function getBultos(): ?int
    {
        return $this->bultos;
    }

    public function setBultos(int $bultos): self
    {
        $this->bultos = $bultos;

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

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(?Carrier $carrier): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getEstadoSeller(): ?string
    {
        return $this->estadoSeller;
    }

    public function getIdSeller(): ?string
    {
        return $this->idSeller;
    }

    public function setIdSeller(?string $idSeller): self
    {
        $this->idSeller = $idSeller;

        return $this;
    }

    public function getZpl(): ?string
    {
        return $this->zpl;
    }

    public function setZpl(?string $zpl): self
    {
        $this->zpl = $zpl;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): self
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    public function getIdRetiroSeller(): ?string
    {
        return $this->idRetiroSeller;
    }

    public function setIdRetiroSeller(?string $idRetiroSeller): self
    {
        $this->idRetiroSeller = $idRetiroSeller;

        return $this;
    }

    public function getEntregas(): ?\DateTimeInterface
    {
        return $this->entregas;
    }

    public function setEntregas(?\DateTimeInterface $entregas): self
    {
        $this->entregas = $entregas;

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

    public function setListoRetiro(?\DateTimeInterface $listoRetiro): self
    {
        $this->listoRetiro = $listoRetiro;

        return $this;
    }

    public function getPaquete(): ?self
    {
        return $this->paquete;
    }

    public function setPaquete(?self $paquete): self
    {
        $this->paquete = $paquete;

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
            $paquete->setPaquete($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getPaquete() === $this) {
                $paquete->setPaquete(NULL);
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

    public function getIdMarket(): ?string
    {
        return $this->idMarket;
    }

    public function setIdMarket(?string $idMarket): self
    {
        $this->idMarket = $idMarket;

        return $this;
    }

    public function getBonificacionPuntos(): ?\DateTimeInterface
    {
        return $this->bonificacionPuntos;
    }

    public function setBonificacionPuntos(?\DateTimeInterface $bonificacionPuntos): self
    {
        $this->bonificacionPuntos = $bonificacionPuntos;

        return $this;
    }

    public function getManifiestoPdf(): ?string
    {
        return $this->manifiestoPdf;
    }

    public function setManifiestoPdf(?string $manifiestoPdf): self
    {
        $this->manifiestoPdf = $manifiestoPdf;

        return $this;
    }

    public function getFulfillment(): ?bool
    {
        return $this->fulfillment;
    }

    public function setFulfillment(bool $fulfillment): self
    {
        $this->fulfillment = $fulfillment;

        return $this;
    }

//      * @return Collection|Proveedor[]

    public function getProveedores(): Collection
    {
        return $this->proveedores;
    }

    public function addProveedore(Proveedor $proveedore): self
    {
        if (!$this->proveedores->contains($proveedore)) {
            $this->proveedores[] = $proveedore;
        }

        return $this;
    }

    public function removeProveedore(Proveedor $proveedore): self
    {
        $this->proveedores->removeElement($proveedore);

        return $this;
    }

    public function getRazon(): ?string
    {
        return $this->razon;
    }

    public function setRazon(?string $razon): self
    {
        $this->razon = $razon;
        $paqueteEstado = $this->getPaqueteEstado();
        $paqueteEstado->setRazon($razon);

        return $this;
    }

    public function getPaqueteEstado()
    {
        if(!isset($this->paqueteEstado)){
            $this->paqueteEstado = new PaqueteEstado();
        }
        return $this->paqueteEstado;
    }

    public function getIndemnizacion(): ?Indemnizacion
    {
        return $this->indemnizacion;
    }

    public function setIndemnizacion(?Indemnizacion $indemnizacion): self
    {
        // unset the owning side of the relation if necessary
        if ($indemnizacion === null && $this->indemnizacion !== null) {
            $this->indemnizacion->setPaqueteAsociado(null);
        }

        // set the owning side of the relation if necessary
        if ($indemnizacion !== null && $indemnizacion->getPaqueteAsociado() !== $this) {
            $indemnizacion->setPaqueteAsociado($this);
        }

        $this->indemnizacion = $indemnizacion;

        return $this;
    }
}
