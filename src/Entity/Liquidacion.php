<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


    #[ORM\Entity(repositoryClass: App\Repository\LiquidacionRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @ORM\HasLifecycleCallbacks

class Liquidacion
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fechaInicio;

    #[ORM\Column(type: 'date')]
    private $fechaFin;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaAprobado;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaPago;

    #[ORM\Column(type: 'integer')]
    private $venta = 0;

    #[ORM\Column(type: 'integer')]
    private $devoluciones = 0;

    #[ORM\Column(type: 'integer')]
    private $comisionOnline = 0;

    #[ORM\Column(type: 'integer')]
    private $comisionBoleteria = 0;

    #[ORM\Column(type: 'integer')]
    private $comisionCortesia = 0;

    #[ORM\Column(type: 'integer')]
    private $gastos = 0;

    #[ORM\Column(type: 'integer')]
    private $ivaDebito = 0;

    #[ORM\Column(type: 'integer')]
    private $subtotal = 0;

    #[ORM\Column(type: 'integer')]
    private $devolucionesAnterior = 0;

    #[ORM\Column(type: 'integer')]
    private $notaCreditoComision = 0;

    #[ORM\Column(type: 'integer')]
    private $ivaCreditoComision = 0;

    #[ORM\Column(type: 'integer')]
    private $total = 0;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\Column(type: 'text', nullable: true)]
    private $comentario;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'liquidaciones')]
    protected $proveedor;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ProveedorRut', inversedBy: 'liquidaciones')]
    protected $proveedorRut;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ProveedorMarket', inversedBy: 'liquidaciones')]
    protected $proveedorMarket;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Nomina', inversedBy: 'liquidaciones')]
    protected $nomina;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Entrada', mappedBy: 'liquidacion')]
    protected $entradas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Entrada', mappedBy: 'liquidacionOriginal')]
    protected $entradasOriginales;

    #[ORM\OneToMany(targetEntity: 'App\Entity\NominaLiquidacion', mappedBy: 'liquidacion')]
    protected $nominaLiquidaciones;

    #[ORM\OneToMany(targetEntity: 'App\Entity\NominaCuenta', mappedBy: 'liquidacion')]
    protected $nominaCuentas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\LiquidacionItem', mappedBy: 'liquidacion')]
    protected $liquidacionItems;

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
        $this->entradas = new ArrayCollection();
        $this->liquidacionItems = new ArrayCollection();
        $this->nominaLiquidaciones = new ArrayCollection();
        $this->nominaCuentas = new ArrayCollection();
        $this->entradasOriginales = new ArrayCollection();
    }

    public function getMontoItems()
    {
        $monto = 0;
        foreach ($this->getLiquidacionItems() as $item) {
            $monto += $item->getMonto();
        }

        return $monto;
    }

    public function getImpuestoItems()
    {
        $impuesto = 0;
        foreach ($this->getLiquidacionItems() as $item) {
            $impuesto += $item->getImpuesto();
        }

        return $impuesto;
    }

    public function getBrutoItems()
    {
        $bruto = 0;
        foreach ($this->getLiquidacionItems() as $item) {
            $bruto += $item->getBruto();
        }

        return $bruto;
    }

    public function calcularSubtotal()
    {
        $liquidacion = $this;
        return $liquidacion->getVenta() - $liquidacion->getComisionTotal() - $liquidacion->getGastos() - $liquidacion->getIvaDebito();
    }

    public function calcularTotal()
    {
        $liquidacion = $this;
        return $liquidacion->getSubtotal() - $liquidacion->getDevolucionesAnterior() + $liquidacion->getNotaCreditoComision() + $liquidacion->getIvaCreditoComision();
    }

    public function getComisionTotal()
    {
        return $this->getComisionOnline() + $this->getComisionBoleteria() + $this->getComisionCortesia();
    }

//      * @ORM\PrePersist
//      * @ORM\PreUpdate

    public function setData()
    {
//        $this->setTotal($this->getComisionOnline() + $this->getComisionBoleteria());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

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

    public function getVenta(): ?int
    {
        return $this->venta;
    }

    public function setVenta(int $venta): self
    {
        $this->venta = $venta;

        return $this;
    }

    public function getComisionOnline(): ?int
    {
        return $this->comisionOnline;
    }

    public function setComisionOnline(int $comisionOnline): self
    {
        $this->comisionOnline = $comisionOnline;

        return $this;
    }

    public function getComisionBoleteria(): ?int
    {
        return $this->comisionBoleteria;
    }

    public function setComisionBoleteria(int $comisionBoleteria): self
    {
        $this->comisionBoleteria = $comisionBoleteria;

        return $this;
    }

    public function getGastos(): ?int
    {
        return $this->gastos;
    }

    public function setGastos(int $gastos): self
    {
        $this->gastos = $gastos;

        return $this;
    }

    public function getDevoluciones(): ?int
    {
        return $this->devoluciones;
    }

    public function setDevoluciones(int $devoluciones): self
    {
        $this->devoluciones = $devoluciones;

        return $this;
    }

    public function getNotaCreditoComision(): ?int
    {
        return $this->notaCreditoComision;
    }

    public function setNotaCreditoComision(int $notaCreditoComision): self
    {
        $this->notaCreditoComision = $notaCreditoComision;

        return $this;
    }

    public function getIvaCreditoComision(): ?int
    {
        return $this->ivaCreditoComision;
    }

    public function setIvaCreditoComision(int $ivaCreditoComision): self
    {
        $this->ivaCreditoComision = $ivaCreditoComision;

        return $this;
    }

    public function getIvaDebito(): ?int
    {
        return $this->ivaDebito;
    }

    public function setIvaDebito(int $ivaDebito): self
    {
        $this->ivaDebito = $ivaDebito;

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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

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

    public function getNomina(): ?Nomina
    {
        return $this->nomina;
    }

    public function setNomina(?Nomina $nomina): self
    {
        $this->nomina = $nomina;

        return $this;
    }

//      * @return Collection|Entrada[]
     
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
            $entrada->setLiquidacion($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->removeElement($entrada)) {
            // set the owning side to null (unless already changed)
            if ($entrada->getLiquidacion() === $this) {
                $entrada->setLiquidacion(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|LiquidacionItem[]

    public function getLiquidacionItems(): Collection
    {
        return $this->liquidacionItems;
    }

    public function addLiquidacionItem(LiquidacionItem $liquidacionItem): self
    {
        if (!$this->liquidacionItems->contains($liquidacionItem)) {
            $this->liquidacionItems[] = $liquidacionItem;
            $liquidacionItem->setLiquidacion($this);
        }

        return $this;
    }

    public function removeLiquidacionItem(LiquidacionItem $liquidacionItem): self
    {
        if ($this->liquidacionItems->removeElement($liquidacionItem)) {
            // set the owning side to null (unless already changed)
            if ($liquidacionItem->getLiquidacion() === $this) {
                $liquidacionItem->setLiquidacion(NULL);
            }
        }

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

    public function getFechaAprobado(): ?\DateTimeInterface
    {
        return $this->fechaAprobado;
    }

    public function setFechaAprobado(?\DateTimeInterface $fechaAprobado): self
    {
        $this->fechaAprobado = $fechaAprobado;

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

//      * @return Collection|NominaLiquidacion[]

    public function getNominaLiquidaciones(): Collection
    {
        return $this->nominaLiquidaciones;
    }

    public function addNominaLiquidacione(NominaLiquidacion $nominaLiquidacione): self
    {
        if (!$this->nominaLiquidaciones->contains($nominaLiquidacione)) {
            $this->nominaLiquidaciones[] = $nominaLiquidacione;
            $nominaLiquidacione->setLiquidacion($this);
        }

        return $this;
    }

    public function removeNominaLiquidacione(NominaLiquidacion $nominaLiquidacione): self
    {
        if ($this->nominaLiquidaciones->removeElement($nominaLiquidacione)) {
            // set the owning side to null (unless already changed)
            if ($nominaLiquidacione->getLiquidacion() === $this) {
                $nominaLiquidacione->setLiquidacion(null);
            }
        }

        return $this;
    }

    public function getComisionCortesia(): ?int
    {
        return $this->comisionCortesia;
    }

    public function setComisionCortesia(int $comisionCortesia): self
    {
        $this->comisionCortesia = $comisionCortesia;

        return $this;
    }

    public function getSubtotal(): ?int
    {
        return $this->subtotal;
    }

    public function setSubtotal(int $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getDevolucionesAnterior(): ?int
    {
        return $this->devolucionesAnterior;
    }

    public function setDevolucionesAnterior(int $devolucionesAnterior): self
    {
        $this->devolucionesAnterior = $devolucionesAnterior;

        return $this;
    }

//      * @return Collection|NominaCuenta[]

    public function getNominaCuentas(): Collection
    {
        return $this->nominaCuentas;
    }

    public function addNominaCuenta(NominaCuenta $nominaCuenta): self
    {
        if (!$this->nominaCuentas->contains($nominaCuenta)) {
            $this->nominaCuentas[] = $nominaCuenta;
            $nominaCuenta->setLiquidacion($this);
        }

        return $this;
    }

    public function removeNominaCuenta(NominaCuenta $nominaCuenta): self
    {
        if ($this->nominaCuentas->removeElement($nominaCuenta)) {
            // set the owning side to null (unless already changed)
            if ($nominaCuenta->getLiquidacion() === $this) {
                $nominaCuenta->setLiquidacion(null);
            }
        }

        return $this;
    }

//      * @return Collection|Entrada[]

    public function getEntradasOriginales(): Collection
    {
        return $this->entradasOriginales;
    }

    public function addEntradasOriginale(Entrada $entradasOriginale): self
    {
        if (!$this->entradasOriginales->contains($entradasOriginale)) {
            $this->entradasOriginales[] = $entradasOriginale;
            $entradasOriginale->setLiquidacionOriginal($this);
        }

        return $this;
    }

    public function removeEntradasOriginale(Entrada $entradasOriginale): self
    {
        if ($this->entradasOriginales->removeElement($entradasOriginale)) {
            // set the owning side to null (unless already changed)
            if ($entradasOriginale->getLiquidacionOriginal() === $this) {
                $entradasOriginale->setLiquidacionOriginal(null);
            }
        }

        return $this;
    }

    public function getProveedorMarket(): ?ProveedorMarket
    {
        return $this->proveedorMarket;
    }

    public function setProveedorMarket(?ProveedorMarket $proveedorMarket): self
    {
        $this->proveedorMarket = $proveedorMarket;

        return $this;
    }

}
