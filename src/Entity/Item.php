<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Utils\RequestContext;

//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="session", columns={"session"),
//  *     @ORM\Index(name="deleted", columns={"deleted"),
//  *     @ORM\Index(name="idx_item_reserva_deleted", columns={"reserva", "deleted"),
//  *     @ORM\Index(name="idx_item_evento_market_deleted", columns={"evento_id", "market_id", "deleted"),
//  *     @ORM\Index(name="idx_item_market_deleted_id", columns={"market_id", "deleted", "id")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\ItemRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Item
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $precio = 0;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;

    #[ORM\Column(type: 'integer')]
    private $descuentoPromocion = 0;

    #[ORM\Column(type: 'integer')]
    private $ajuste = 0;

    #[ORM\Column(type: 'integer')]
    private $creditos = 0;

    #[ORM\Column(type: 'integer')]
    private $creditosCantidad = 0;

    #[ORM\Column(type: 'integer')]
    private $comision = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroFijo = 0;

    #[ORM\Column(type: 'integer')]
    private $costo = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoPrecio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $zona;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $butaca;

    #[ORM\Column(type: 'boolean')]
    private $boolNinos = true;

    #[ORM\Column(type: 'datetime')]
    private $fechaInicio;

    #[ORM\Column(type: 'datetime')]
    private $fechaTermino;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $duracion;

    #[ORM\Column(type: 'integer')]
    private $cantidad;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $personaRetiro;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $session;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $reserva;

    #[ORM\Column(type: 'integer')]
    private $renovaciones = 0;

    #[ORM\Column(type: 'boolean')]
    private $boleteria = false;

    #[ORM\Column(type: 'boolean')]
    private $cortesia = false;

    #[ORM\Column(type: 'boolean')]
    private $comisionAsistente = false;

    #[ORM\Column(type: 'boolean')]
    private $recaudacionPropia = false;

    #[ORM\Column(type: 'boolean')]
    private $boletaCron = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $emailResena;

    #[ORM\ManyToOne(targetEntity: 'Market', inversedBy: 'items')]
    protected $market;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Cliente', inversedBy: 'items')]
    protected $cliente;

    #[ORM\ManyToOne(targetEntity: 'ActividadEvento', inversedBy: 'items')]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    protected $evento;

    #[ORM\ManyToOne(targetEntity: 'ActividadEventoPrecio', inversedBy: 'items')]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    protected $eventoPrecio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Transaccion', inversedBy: 'items')]
    protected $transaccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\TransaccionDetalle', inversedBy: 'items')]
    protected $transaccionDetalle;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Envio', inversedBy: 'items')]
    protected $envio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Dte', inversedBy: 'items')]
    protected $dte;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ProveedorRut', inversedBy: 'items')]
    protected $proveedorRut;

    #[ORM\ManyToMany(targetEntity: 'Nino', inversedBy: 'items')]
    protected $ninos;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Paquete', mappedBy: 'item')]
    protected $paquete;

    #[ORM\OneToMany(targetEntity: 'Resena', mappedBy: 'item')]
    protected $resenas;

    #[ORM\OneToMany(targetEntity: 'Entrada', mappedBy: 'item')]
    protected $entradas;

    
    #[ORM\OneToMany(targetEntity: 'Asistente', mappedBy: 'item')]
//      * @ORM\OrderBy({"id" = "DESC")

    protected $asistentes;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(name: 'has_insurance', type: 'boolean', nullable: true)]
    private $hasInsurance = false;

    #[ORM\Column(name: 'has_easy_cancellation', type: 'boolean', nullable: true)]
    private $hasEasyCancellation = false;

    #[ORM\Column(name: 'money_back_insurance_amount', type: 'integer', nullable: true)]
    private $moneyBackInsuranceAmount = 0;

    #[ORM\Column(name: 'easy_cancellation_amount', type: 'integer', nullable: true)]
    private $easyCancellationAmount = 0;

    #[ORM\ManyToOne(targetEntity: 'Promocion', inversedBy: 'items')]
    protected $promocion;

    public function __construct()
    {
        $this->ninos = new ArrayCollection();
        $this->entradas = new ArrayCollection();
        $this->asistentes = new ArrayCollection();
        $this->resenas = new ArrayCollection();
    }

//      * Add entrada.

//      * @param \App\Entity\Entrada $entrada

//      * @return Item

    public function addEntrada(\App\Entity\Entrada $entrada)
    {
        $entrada->setItem($this);
        $this->entradas[] = $entrada;

        return $this;
    }

//      * Set cliente.

//      * @param \App\Entity\Cliente|null $cliente

//      * @return Item

    public function setCliente(\App\Entity\Cliente $cliente = NULL)
    {
        if ($cliente) {
            $cliente->setEmailCarroAbandonado(NULL);
            $cliente->setNotificacionCarroAbandonado(NULL);
        }

        $this->cliente = $cliente;

        return $this;
    }

    public function getPrecios()
    {
        $precios = [];
        $precioPromocion = $this->getPrecioPromocion();
        $precio = $this->getPrecio();
        if ($precioPromocion != $precio) {
            $precios['oldPrecio'] = $precio;
            $precio = $precioPromocion;
        }

        $precios['precio'] = $precio;

        return $precios;
    }

    public function getCargoServicio($neto = false)
    {
        if ($this->getComisionAsistente()) {
            if ($this->getDescuentoPromocion() > 0) {
                // $comision = $this->calcularComision($this->getPromocion()); maguilera
                $comision = $this->calcularComision();
            } else {
                $comision = $this->getComision();
            }
            $cargo = $comision + $this->getCobroFijo();
        } else {
            $cargo = 0;
        }

        if (!$neto) {
            $cargo *= RequestContext::getIva();
        }
        return $cargo;
    }

    public function getPrecioPublicacion()
    {
        $precioFinal = $this->getPrecio() - $this->getDescuento();

        return $precioFinal;
    }

    public function getPrecioFinal($cargo = true)
    {
        $precioFinal = $this->getPrecioPublicacion();
        if ($cargo) {
            $precioFinal += $this->getCargoServicio();
        }

        return $precioFinal;
    }

    public function getPrecioPagado($cargo = true)
    {
        $precioFinal = $this->getPrecioFinal($cargo) - $this->getDescuentoPromocion();
        return $precioFinal;
    }

    public function getValorBoleta()
    {
        $precioFinal = $this->getPrecioFinal() - $this->getCreditos();

        $promocion = $this->getTransaccion()->getPromocion();
        if (!$promocion || !$promocion->getAdmin() || true) {
            $precioFinal -= $this->getDescuentoPromocion();
        }

        return $precioFinal;
    }

    public function getValorVenta()
    {
        $precioFinal = $this->getPrecioFinal();

        $promocion = $this->getTransaccion()->getPromocion();
        if ($promocion && !$promocion->getAdmin()) {
            $precioFinal -= $this->getDescuentoPromocion();
        }

        return $precioFinal;
    }

    public function getPrecioCantidad($original = false, $cargo = true)
    {
        if ($original) {
            $precio = $original === 'logistico' ? $this->getPrecio() : $this->getPrecioFinal($cargo);
        } else {
            $precio = $this->getPrecioPagado($cargo);
        }

        return $precio * $this->cantidad;
    }

    public function getVentaCantidad()
    {
        return $this->getValorVenta() * $this->getCantidad();
    }

    public function getVentaLiquidacion()
    {
        $precioPublicacion = $this->getPrecioPublicacion();

        $promocion = $this->getTransaccion()->getPromocion();
        if ($promocion && !$promocion->getAdmin()) {
            $precioPublicacion -= $this->getDescuentoPromocion();
        }

        return $precioPublicacion;
    }

    public function getBoletaCantidad()
    {
        $precioFinal = $this->getPrecioFinal();

        $promocion = $this->getTransaccion()->getPromocion();
        if (!$promocion || !$promocion->getAdmin() || true) {
            $precioFinal -= $this->getDescuentoPromocion();
        }
        return $precioFinal * $this->getCantidad() - $this->getCreditosCantidad();
    }

    public function getActividad()
    {
        if ($this->getEvento()) {
            return $this->getEvento()->getActividad();
        }
    }


    public function getProveedor()
    {
        return $this->getActividad()->getProveedor();
    }

    public function setEventoPrecio(?ActividadEventoPrecio $eventoPrecio): self
    {
        $this->eventoPrecio = $eventoPrecio;

        return $this;
    }

    public function getProductos()
    {
        return $this->getEnvio() ? $this->getEnvio()->getProductos() : false;
    }

    public function getResena(): ?Resena
    {
        return $this->getResenas()->first() ?: NULL;
    }

    public function getFicha()
    {
        return $this->getActividad()->getFicha();
    }

    public function getPeso()
    {
        return $this->getFicha() ? $this->getFicha()->getPeso() : NULL;
    }

    public function getSla()
    {
        return $this->getFicha() ? $this->getFicha()->getSla() : NULL;
    }

    public function calcularComision($promocion = NULL)
    {
        $eventoPrecio = $this->getEventoPrecio();

        if (!$eventoPrecio) {
            throw new \RuntimeException("Error: Item ID {$this->getId()} no tiene EventoPrecio asociado.");
        }
        $tipoPrecio = $eventoPrecio->getTipoPrecio();

        $tipoServicios = NULL;
        if ($tipoPrecio) {
            $tipoServicios = $tipoPrecio->getTipoServicios();
        }

        if ($promocion && !$promocion->getAdmin()) {
            $dctoPromocion = $eventoPrecio->getDescuentoPromocion($promocion); // + $promocion->getDescuentoFijo(); maguilera
        } else {
            $dctoPromocion = 0;
        }

        $cobroVariable = NULL;
        $actividadMarket = $eventoPrecio->getActividadMarket();
        $proveedorMarket = $eventoPrecio->getProveedorMarket();

        if ($this->getBoleteria()) {
            $cobroVariable = $proveedorMarket->getCobroVariableEntradaBoleteria();
        }

       

        if (is_null($cobroVariable)) {
            if ($this->getCortesia()) {
                $cobroVariable = $proveedorMarket->getCobroVariableInvitacion();
            }
        }

        if (is_null($cobroVariable)) {
            if ($tipoPrecio) {
                $market = $this->getMarket();
                $actividadTipoPrecioMarket = $tipoPrecio->getActividadTipoPrecioMarket($market);
                if ($actividadTipoPrecioMarket) {
                    $cobroVariable = $actividadTipoPrecioMarket->getCobroVariable();
                }
            }
        } // maguilera revisar esto no se usa 

        if (is_null($cobroVariable)) {
            $cobroVariable = $actividadMarket ? $actividadMarket->getCobroVariable() : NULL;
        }

        if (is_null($cobroVariable)) {
            $cobroVariable = $proveedorMarket ? $proveedorMarket->getCobroVariable() : NULL;
        }

        if (is_null($cobroVariable)) {
            $cobroVariable = 0;
        }

        $precioFinal = $eventoPrecio->getPrecioFinal();
        $comision = ($precioFinal - $dctoPromocion) * $cobroVariable / 100;

        $comisiones = [];
        foreach ($this->getEntradas() as $entrada) {
            $codigoExterno = $entrada->getCodigoExterno();
            if (!$codigoExterno || $this->getComisionAsistente()) {
                break;
            }

            $costo = $codigoExterno->getCosto();
            if (!is_null($costo)) {
                $entradaComision = $eventoPrecio->getPrecioFinal() - $costo;
                if ($tipoServicios == 'Afecto') {
                    $entradaComision /= RequestContext::getIva();
                }
            } else {
                $entradaComision = $comision;
            }
            $entrada->setComision($entradaComision);
            $comisiones[] = $entradaComision;
        }

        if (!empty($comisiones)) {
            $comision = ceil(array_sum($comisiones) / count($comisiones));
        }

        return $comision;
    }

    public function calcularCobroFijo()
    {
        $eventoPrecio = $this->getEventoPrecio();
        $cobroFijo = 0;
        $proveedorMarket = $eventoPrecio->getProveedorMarket();

        if ($this->getBoleteria()) {
            $cobroFijo = $proveedorMarket->getCobroFijoEntradaBoleteria();
        }

        if (!$cobroFijo) {
            if ($this->getCortesia()) {
                $cobroFijo = $proveedorMarket->getCobroFijoInvitacion();
            }
        }

        if (!$cobroFijo) {
            $cobroFijo = $proveedorMarket->getCobroEntrada();
        }

        return $cobroFijo;
    }

    public function getCanalVenta()
    {
        return $this->getBoleteria() ? 'Venta Boletería' : ($this->getCortesia() ? 'Invitación' : 'Venta Online');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

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

    public function getDescuentoPromocion(): ?int
    {
        return $this->descuentoPromocion;
    }

    public function setDescuentoPromocion(int $descuentoPromocion): self
    {
        $this->descuentoPromocion = $descuentoPromocion;

        return $this;
    }

    public function setAjuste(int $ajuste): self
    {
        $this->ajuste = $ajuste;

        return $this;
    }

    public function getAjuste(): ?int
    {
        return $this->ajuste;
    }

    public function getComision(): ?int
    {
        return $this->comision;
    }

    public function setComision(int $comision): self
    {
        $this->comision = $comision;

        return $this;
    }

    public function getTipoPrecio(): ?string
    {
        return $this->tipoPrecio;
    }

    public function setTipoPrecio(?string $tipoPrecio): self
    {
        $this->tipoPrecio = $tipoPrecio;

        return $this;
    }

    public function getZona(): ?string
    {
        return $this->zona;
    }

    public function setZona(?string $zona): self
    {
        $this->zona = $zona;

        return $this;
    }

    public function getButaca(): ?string
    {
        return $this->butaca;
    }

    public function setButaca(?string $butaca): self
    {
        $this->butaca = $butaca;

        return $this;
    }

    public function getBoolNinos(): ?bool
    {
        return $this->boolNinos;
    }

    public function setBoolNinos(bool $boolNinos): self
    {
        $this->boolNinos = $boolNinos;

        return $this;
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

    public function getFechaTermino(): ?\DateTimeInterface
    {
        return $this->fechaTermino;
    }

    public function setFechaTermino(\DateTimeInterface $fechaTermino): self
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }

    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(?string $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }


    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPersonaRetiro(): ?string
    {
        return $this->personaRetiro;
    }

    public function setPersonaRetiro(?string $personaRetiro): self
    {
        $this->personaRetiro = $personaRetiro;

        return $this;
    }

    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(?string $session): self
    {
        $this->session = $session;

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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function getClienteItem(): ?int
    {
        return $this->cliente->getId();
    }


    public function getEvento(): ?ActividadEvento
    {
        return $this->evento;
    }

    public function setEvento(?ActividadEvento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }

    public function getEventoPrecio(): ?ActividadEventoPrecio
    {
        return $this->eventoPrecio;
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

//      * @return Collection|Nino[]
     
    public function getNinos(): Collection
    {
        return $this->ninos;
    }

    public function addNino(Nino $nino): self
    {
        if (!$this->ninos->contains($nino)) {
            $this->ninos[] = $nino;
        }

        return $this;
    }

    public function removeNino(Nino $nino): self
    {
        if ($this->ninos->contains($nino)) {
            $this->ninos->removeElement($nino);
        }

        return $this;
    }

//      * @return Collection|Entrada[]

    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
            // set the owning side to null (unless already changed)
            if ($entrada->getItem() === $this) {
                $entrada->setItem(NULL);
            }
        }

        return $this;
    }

    public function getReserva(): ?\DateTimeInterface
    {
        return $this->reserva;
    }

    public function setReserva(?\DateTimeInterface $reserva): self
    {
        $this->reserva = $reserva;

        return $this;
    }

    public function getRenovaciones(): ?int
    {
        return $this->renovaciones;
    }

    public function setRenovaciones(int $renovaciones): self
    {
        $this->renovaciones = $renovaciones;

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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

//      * @return Collection|Asistente[]

    public function getAsistentes(): Collection
    {
        return $this->asistentes;
    }

    public function addAsistente(Asistente $asistente): self
    {
        if (!$this->asistentes->contains($asistente)) {
            $this->asistentes[] = $asistente;
            $asistente->setItem($this);
        }

        return $this;
    }

    public function removeAsistente(Asistente $asistente): self
    {
        if ($this->asistentes->contains($asistente)) {
            $this->asistentes->removeElement($asistente);
            // set the owning side to null (unless already changed)
            if ($asistente->getItem() === $this) {
                $asistente->setItem(NULL);
            }
        }

        return $this;
    }

    public function getBoleteria(): ?bool
    {
        return $this->boleteria;
    }

    public function setBoleteria(bool $boleteria): self
    {
        $this->boleteria = $boleteria;

        return $this;
    }

    public function getEnvio(): ?Envio
    {
        return $this->envio;
    }

    public function setEnvio(?Envio $envio): self
    {
        $this->envio = $envio;

        return $this;
    }

    public function getPaquete(): ?Paquete
    {
        return $this->paquete;
    }

    public function setPaquete(?Paquete $paquete): self
    {
        $this->paquete = $paquete;

        // set (or unset) the owning side of the relation if necessary
        $newItem = $paquete === NULL ? NULL : $this;
        if ($newItem !== $paquete->getItem()) {
            $paquete->setItem($newItem);
        }

        return $this;
    }

    public function getCosto(): ?int
    {
        return $this->costo;
    }

    public function setCosto(int $costo): self
    {
        $this->costo = $costo;

        return $this;
    }

//      * @return Collection|Resena[]

    public function getResenas(): Collection
    {
        return $this->resenas;
    }

    public function addResena(Resena $resena): self
    {
        if (!$this->resenas->contains($resena)) {
            $this->resenas[] = $resena;
            $resena->setItem($this);
        }

        return $this;
    }

    public function removeResena(Resena $resena): self
    {
        if ($this->resenas->contains($resena)) {
            $this->resenas->removeElement($resena);
            // set the owning side to null (unless already changed)
            if ($resena->getItem() === $this) {
                $resena->setItem(NULL);
            }
        }

        return $this;
    }

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(int $creditos): self
    {
        $this->creditos = $creditos;

        return $this;
    }

    public function getCreditosCantidad(): ?int
    {
        return $this->creditosCantidad;
    }

    public function setCreditosCantidad(int $creditosCantidad): self
    {
        $this->creditosCantidad = $creditosCantidad;

        return $this;
    }

//    public function __toString() {
//        return $this->producto->__toString();
//    }

    public function getEmailResena(): ?\DateTimeInterface
    {
        return $this->emailResena;
    }

    public function setEmailResena(?\DateTimeInterface $emailResena): self
    {
        $this->emailResena = $emailResena;

        return $this;
    }

    public function getTransaccionDetalle(): ?TransaccionDetalle
    {
        return $this->transaccionDetalle;
    }

    public function setTransaccionDetalle(?TransaccionDetalle $transaccionDetalle): self
    {
        $this->transaccionDetalle = $transaccionDetalle;

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

    public function getBoletaCron(): ?bool
    {
        return $this->boletaCron;
    }

    public function setBoletaCron(bool $boletaCron): self
    {
        $this->boletaCron = $boletaCron;

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

    public function getCortesia(): ?bool
    {
        return $this->cortesia;
    }

    public function setCortesia(bool $cortesia): self
    {
        $this->cortesia = $cortesia;

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

    public function getProveedorRut(): ?ProveedorRut
    {
        return $this->proveedorRut;
    }

    public function setProveedorRut(?ProveedorRut $proveedorRut): self
    {
        $this->proveedorRut = $proveedorRut;

        return $this;
    }

    public function getRecaudacionPropia(): ?bool
    {
        return $this->recaudacionPropia;
    }

    public function setRecaudacionPropia(bool $recaudacionPropia): self
    {
        $this->recaudacionPropia = $recaudacionPropia;

        return $this;
    }
  
    public function getItemAmount()
    {
        return $this->cantidad * ($this->precio - $this->descuento);
    }

    public function getEasyCancellationHours()
    {
        if ($this->getActividad()) {
            return $this->getActividad()->getEasyCancellationHours();
        }
        return 0;
    }

    public function getEasyCancellationPercentage()
    {
        if ($this->getActividad()) {
            return $this->getActividad()->getEasyCancellationPercentage();
        }
        return 0;
    }

    public function getEasyCancellationHoursWithoutPenalty()
    {
        if ($this->getActividad()) {
            return $this->getActividad()->getEasyCancellationHoursWithoutPenalty();
        }
        return 0;
    }

    public function getCanCancel()
    {
        if (!$this->fechaInicio) {
            return false;
        }

        $now = new \DateTime('now');
        $diffInSeconds = $this->fechaInicio->getTimestamp() - $now->getTimestamp();
        $diffInHours = $diffInSeconds / 3600;

        return $diffInHours > $this->getEasyCancellationHours();
    }

    public function getCancellationDate()
    {
        if (!$this->fechaInicio) {
            return null;
        }

        $cloned = clone $this->fechaInicio;
        $cloned->modify('-' . $this->getEasyCancellationHours() . ' hours');

        return [$cloned->format('d F'), $cloned->format('H:i')];
    }

    public function getCancellationDateWithoutPenalty()
    {
        if (!$this->fechaInicio) {
            return null;
        }

        $cloned = clone $this->fechaInicio;
        $cloned->modify('-' . $this->getEasyCancellationHoursWithoutPenalty() . ' hours');

        return [$cloned->format('d F'), $cloned->format('H:i')];
    }

    public function getHasInsurance()
    {
        return $this->hasInsurance;
    }

    public function setHasInsurance($hasInsurance)
    {
        $this->hasInsurance = $hasInsurance;
        return $this;
    }

    public function getHasEasyCancellation()
    {
        return $this->hasEasyCancellation;
    }

    public function setHasEasyCancellation($hasEasyCancellation)
    {
        $this->hasEasyCancellation = $hasEasyCancellation;
        return $this;
    }

    public function getMoneyBackInsuranceAmount()
    {
        return $this->moneyBackInsuranceAmount;
    }

    public function setMoneyBackInsuranceAmount($amount)
    {
        $this->moneyBackInsuranceAmount = $amount;
        return $this;
    }

    public function getEasyCancellationAmount()
    {
        return $this->easyCancellationAmount;
    }

    public function setEasyCancellationAmount($amount)
    {
        $this->easyCancellationAmount = $amount;
        return $this;
    }

    public function setPromocion(?Promocion $promocion): self
    {
        $this->promocion = $promocion;
        return $this;
    }

    public function getPromocion(): ?Promocion
    {
        return $this->promocion;
    }
}
