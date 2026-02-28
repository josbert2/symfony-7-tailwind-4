<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Utils\RequestContext;

//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="estado",columns={"estado"),
//  *     @ORM\Index(name="idx_transaccion_estado_deleted", columns={"estado", "deleted"),
//  *     @ORM\Index(name="idx_transaccion_estado_deleted_created", columns={"estado", "deleted", "created")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\TransaccionRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Transaccion
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idMarket;

    #[ORM\Column(type: 'integer')]
    private $monto = 0;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;

    #[ORM\Column(type: 'integer')]
    private $despacho = 0;

    #[ORM\Column(type: 'integer')]
    private $creditos = 0;

    #[ORM\Column(type: 'integer')]
    private $total = 0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaPago;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;

    #[ORM\Column(type: 'json', nullable: true)]
    private $tokens;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $notificacionFallida;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $emailFallida;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $medioPago;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $efectivo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $voucher;

    #[ORM\Column(type: 'boolean')]
    private $boleteria = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $session;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $bonificacionPuntos;

    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    private $codigoRandom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ordenCompra;

    #[ORM\ManyToOne(targetEntity: 'Promocion', inversedBy: 'transacciones')]
    protected $promocion;

    #[ORM\ManyToOne(targetEntity: 'Cliente', inversedBy: 'transacciones')]
    protected $cliente;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Caja', inversedBy: 'transacciones')]
    protected $caja;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Cuadratura', inversedBy: 'transacciones')]
    protected $cuadratura;

    #[ORM\ManyToOne(targetEntity: 'Staff', inversedBy: 'transacciones')]
    protected $staff;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Transbank', inversedBy: 'transaccionOriginal')]
    protected $transbank;

    #[ORM\OneToOne(targetEntity: 'MercadoPago', inversedBy: 'transaccion')]
    protected $mercadoPago;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Dte', inversedBy: 'transaccionOriginal')]
    protected $dte;

    #[ORM\OneToOne(targetEntity: 'Invitacion', inversedBy: 'transaccion')]
    protected $invitacion;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Transbank', mappedBy: 'transaccion')]
    protected $transbanks;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Dte', mappedBy: 'transaccion')]
    protected $dtes;

    #[ORM\OneToMany(targetEntity: 'TransaccionEstado', mappedBy: 'transaccion')]
    protected $estados;

    #[ORM\OneToMany(targetEntity: 'Item', mappedBy: 'transaccion')]
    protected $items;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Envio', mappedBy: 'transaccion')]
    protected $envios;

    
    #[ORM\OneToMany(targetEntity: 'App\Entity\TransaccionDetalle', mappedBy: 'transaccion')]
//      * @ORM\OrderBy({"market" = "ASC")

    protected $detalles;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'transaccion', targetEntity: InfoMetodoPago::class, orphanRemoval: true)]
    private $infoMetodoPagos;

    #[ORM\OneToMany(mappedBy: 'transaccion', targetEntity: DevolucionDinero::class)]
    private $devolucionDineros;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $correoCompraEnviado;

    #[ORM\OneToMany(mappedBy: 'transaccion', targetEntity: Indemnizacion::class)]
    private $indemnizacions;

    #[ORM\OneToOne(targetEntity: 'TransaccionPromocionListaCodigo', mappedBy: 'transaccion')]
    private $transaccionPromocionListaCodigos;

    #[ORM\ManyToOne(targetEntity: 'Sucursal')]
    #[ORM\JoinColumn(name: 'sucursal_id', referencedColumnName: 'id', nullable: true)]
    private $sucursal;


    public function getTransbank(): ?Transbank
    {
        $transbank = $this->getTransbanks()->first();
        return $transbank ?: NULL;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;
        $this->addToken($token);

        return $this;
    }

    public function addToken($token)
    {
        $tokens = !empty($this->tokens) ? $this->tokens : [];
        if (!in_array($token, $tokens)) {
            $tokens[] = $token;
        }
        $this->tokens = $tokens;

        return $this;
    }

    public function __construct()
    {
        $this->estados = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->envios = new ArrayCollection();
        $this->transbanks = new ArrayCollection();
        $this->detalles = new ArrayCollection();
        $this->dtes = new ArrayCollection();
        $this->devolucionDineros = new ArrayCollection();
        $this->infoMetodoPagos = new ArrayCollection();
        $this->indemnizacions = new ArrayCollection();
    }

    public function getProductos()
    {
        $productos = false;
        foreach ($this->getEnvios() as $envio) {
            if ($envio->getProductos()) {
                $productos = true;
                break;
            }
        }

        return $productos;
    }

//      * Add estado.

//      * @param \App\Entity\TransaccionEstado $estado

//      * @return Transaccion

    public function addEstado(\App\Entity\TransaccionEstado $estado)
    {
        $estado->setTransaccion($this);
        $this->estado = $estado->getEstado();
        $this->estados[] = $estado;

        return $this;
    }

    public function getCodigo()
    {
        $sigla = $this->getMarket() && $this->getMarket()->getSigla() ? $this->getMarket()->getSigla() : 'EK';
        return $sigla . sprintf("%07d", $this->getId());
    }

    public function getActividades()
    {
        $actividades = [];
        foreach ($this->getItems() as $item) {
            $actividad = $item->getActividad();
            if ($actividad && !in_array($actividad, $actividades)) {
                $actividades[] = $actividad;
            }
        }
//        dump($actividades);
        return $actividades;
    }

    public function getEvento($actividad)
    {
        $evento = NULL;
        foreach ($this->getItems() as $item) {
            $actividad = $item->getActividad();
            if ($item->getActividad() == $actividad) {
                $evento = $item->getEvento();
            }
        }

        return $evento;
    }

    public function getProveedor()
    {
        $item = $this->getItems()->first();
        if ($item && is_object($item)) {
            return $item->getProveedor();
        }

        return 'Sin proveedor';
    }

    public function getMarket(): ?Market
    {
        $items = $this->getItems();
        if ($items->count() > 0) {
            return $items->first()->getMarket();
        } else {
            return NULL;
        }
    }

    public function setCreditosItems()
    {
        $subtotal = $this->getMonto() - $this->getDescuento();
        if ($subtotal > 0) {
            $creditos = $this->getCreditos();
            $sum = 0;

            foreach ($this->getItems() as $item) {
                $cantidad = $item->getCantidad();
                $precioFinal = $item->getPrecioFinal();
                $creditosCantidad = round($creditos * ($precioFinal * $cantidad / $subtotal));
                $creditosItem = round($creditosCantidad / $cantidad);
                $item->setCreditosCantidad($creditosCantidad);
                $item->setCreditos($creditosItem);
                $sum += $creditosCantidad;
            }

            $diff = $creditos - $sum;
            $item->setCreditosCantidad($creditosCantidad + $diff);
        }

    }

    public function getDtesAll()
    {
        $dtes = $this->getDtes()->toArray();
        $dte = $this->getDte();
        if ($dte) {
            $dtes[] = $dte;
        }

        return $dtes;
    }

    public function getCargoServicio()
    {
        $cargoServicio = 0;
        foreach ($this->getItems() as $item) {
            $cargoServicio += ceil($item->getCargoServicio(true) * $item->getCantidad() * RequestContext::getIva());
        }

        return $cargoServicio;
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

    public function getDespacho(): ?int
    {
        return $this->despacho;
    }

    public function setDespacho(int $despacho): self
    {
        $this->despacho = $despacho;

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

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getNotificacionFallida(): ?\DateTimeInterface
    {
        return $this->notificacionFallida;
    }

    public function setNotificacionFallida(?\DateTimeInterface $notificacionFallida): self
    {
        $this->notificacionFallida = $notificacionFallida;

        return $this;
    }

    public function getEmailFallida(): ?\DateTimeInterface
    {
        return $this->emailFallida;
    }

    public function setEmailFallida(?\DateTimeInterface $emailFallida): self
    {
        $this->emailFallida = $emailFallida;

        return $this;
    }

    public function getMedioPago(): ?string
    {
        return $this->medioPago;
    }

    public function setMedioPago(?string $medioPago): self
    {
        $this->medioPago = $medioPago;

        return $this;
    }

    public function getEfectivo(): ?string
    {
        return $this->efectivo;
    }

    public function setEfectivo(?string $efectivo): self
    {
        $this->efectivo = $efectivo;

        return $this;
    }

    public function getVoucher(): ?string
    {
        return $this->voucher;
    }

    public function setVoucher(?string $voucher): self
    {
        $this->voucher = $voucher;

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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getPromocion(): ?Promocion
    {
        return $this->promocion;
    }

    public function setPromocion(?Promocion $promocion): self
    {
        $this->promocion = $promocion;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getCaja(): ?Caja
    {
        return $this->caja;
    }

    public function setCaja(?Caja $caja): self
    {
        $this->caja = $caja;

        return $this;
    }

    public function getCuadratura(): ?Cuadratura
    {
        return $this->cuadratura;
    }

    public function setCuadratura(?Cuadratura $cuadratura): self
    {
        $this->cuadratura = $cuadratura;

        return $this;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(?Staff $staff): self
    {
        $this->staff = $staff;

        return $this;
    }

    public function getMercadoPago(): ?MercadoPago
    {
        return $this->mercadoPago;
    }

    public function setMercadoPago(?MercadoPago $mercadoPago): self
    {
        $this->mercadoPago = $mercadoPago;

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

    public function getInvitacion(): ?Invitacion
    {
        return $this->invitacion;
    }

    public function setInvitacion(?Invitacion $invitacion): self
    {
        $this->invitacion = $invitacion;

        return $this;
    }

//      * @return Collection|TransaccionEstado[]
     
    public function getEstados(): Collection
    {
        return $this->estados;
    }

    public function removeEstado(TransaccionEstado $estado): self
    {
        if ($this->estados->contains($estado)) {
            $this->estados->removeElement($estado);
            // set the owning side to null (unless already changed)
            if ($estado->getTransaccion() === $this) {
                $estado->setTransaccion(NULL);
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
            $item->setTransaccion($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getTransaccion() === $this) {
                $item->setTransaccion(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|Envio[]

    public function getEnvios(): Collection
    {
        return $this->envios;
    }

    public function addEnvio(Envio $envio): self
    {
        if (!$this->envios->contains($envio)) {
            $this->envios[] = $envio;
            $envio->setTransaccion($this);
        }

        return $this;
    }

    public function removeEnvio(Envio $envio): self
    {
        if ($this->envios->contains($envio)) {
            $this->envios->removeElement($envio);
            // set the owning side to null (unless already changed)
            if ($envio->getTransaccion() === $this) {
                $envio->setTransaccion(NULL);
            }
        }

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

    public function getTokens(): ?array
    {
        return $this->tokens;
    }

    public function setTokens(?array $tokens): self
    {
        $this->tokens = $tokens;

        return $this;
    }

//      * @return Collection|Transbank[]

    public function getTransbanks(): Collection
    {
        return $this->transbanks;
    }

    public function addTransbank(Transbank $transbank): self
    {
        if (!$this->transbanks->contains($transbank)) {
            $this->transbanks[] = $transbank;
            $transbank->setTransaccion($this);
        }

        return $this;
    }

    public function removeTransbank(Transbank $transbank): self
    {
        if ($this->transbanks->removeElement($transbank)) {
            // set the owning side to null (unless already changed)
            if ($transbank->getTransaccion() === $this) {
                $transbank->setTransaccion(NULL);
            }
        }

        return $this;
    }

    public function setTransbank(?Transbank $transbank): self
    {
        $this->transbank = $transbank;

        return $this;
    }

//      * @return Collection|TransaccionDetalle[]

    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(TransaccionDetalle $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles[] = $detalle;
            $detalle->setTransaccion($this);
        }

        return $this;
    }

    public function removeDetalle(TransaccionDetalle $detalle): self
    {
        if ($this->detalles->removeElement($detalle)) {
            // set the owning side to null (unless already changed)
            if ($detalle->getTransaccion() === $this) {
                $detalle->setTransaccion(NULL);
            }
        }

        return $this;
    }

    public function getOrdenCompra(): ?string
    {
        return $this->ordenCompra;
    }

    public function setOrdenCompra(?string $ordenCompra): self
    {
        $this->ordenCompra = $ordenCompra;

        return $this;
    }

//      * @return Collection|Dte[]

    public function getDtes(): Collection
    {
        return $this->dtes;
    }

    public function addDte(Dte $dte): self
    {
        if (!$this->dtes->contains($dte)) {
            $this->dtes[] = $dte;
            $dte->setTransaccion($this);
        }

        return $this;
    }

    public function removeDte(Dte $dte): self
    {
        if ($this->dtes->removeElement($dte)) {
            // set the owning side to null (unless already changed)
            if ($dte->getTransaccion() === $this) {
                $dte->setTransaccion(NULL);
            }
        }

        return $this;
    }

    public function getCodigoRandom(): ?string
    {
        return $this->codigoRandom;
    }

    public function setCodigoRandom(?string $codigoRandom): self
    {
        $this->codigoRandom = $codigoRandom;

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

//      * @return Collection|InfoMetodoPago[]

    public function getInfoMetodoPagos(): Collection
    {
        return $this->infoMetodoPagos;
    }

    public function addInfoMetodoPago(InfoMetodoPago $infoMetodoPago): self
    {
        if (!$this->infoMetodoPagos->contains($infoMetodoPago)) {
            $this->infoMetodoPagos[] = $infoMetodoPago;
            $infoMetodoPago->setTransaccion($this);
        }

        return $this;
    }

    public function removeInfoMetodoPago(InfoMetodoPago $infoMetodoPago): self
    {
        if ($this->infoMetodoPagos->removeElement($infoMetodoPago)) {
            // set the owning side to null (unless already changed)
            if ($infoMetodoPago->getTransaccion() === $this) {
                $infoMetodoPago->setTransaccion(NULL);
            }
        }

        return $this;
    }

    public function addDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if (!$this->devolucionDineros->contains($devolucionDinero)) {
            $this->devolucionDineros[] = $devolucionDinero;
            $devolucionDinero->setTransaccion($this);
        }

        return $this;
    }

    public function removeDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if ($this->devolucionDineros->removeElement($devolucionDinero)) {
            // set the owning side to null (unless already changed)
            if ($devolucionDinero->getTransaccion() === $this) {
                $devolucionDinero->setTransaccion(NULL);
            }
        }

        return $this;
    }

    public function getCorreoCompraEnviado(): ?string
    {
        return $this->correoCompraEnviado;
    }

    public function setCorreoCompraEnviado(?string $correoCompraEnviado): self
    {
        $this->correoCompraEnviado = $correoCompraEnviado;

        return $this;
    }

//      * @return Collection|Indemnizacion[]

    public function getIndemnizacions(): Collection
    {
        return $this->indemnizacions;
    }

    public function addIndemnizacion(Indemnizacion $indemnizacion): self
    {
        if (!$this->indemnizacions->contains($indemnizacion)) {
            $this->indemnizacions[] = $indemnizacion;
            $indemnizacion->setTransaccion($this);
        }

        return $this;
    }

    public function removeIndemnizacion(Indemnizacion $indemnizacion): self
    {
        if ($this->indemnizacions->removeElement($indemnizacion)) {
            // set the owning side to null (unless already changed)
            if ($indemnizacion->getTransaccion() === $this) {
                $indemnizacion->setTransaccion(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|DevolucionDinero[]

    public function getDevolucionDineros(): Collection
    {
        return $this->devolucionDineros;
    }

    public function getTransaccionPromocionListaCodigos()
    {
        return $this->transaccionPromocionListaCodigos;
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

    public function addTransaccionPromocionListaCodigo(TransaccionPromocionListaCodigo $transaccionPromocionListaCodigo): self
    {
        if (!$this->transaccionPromocionListaCodigos->contains($transaccionPromocionListaCodigo)) {
            $this->transaccionPromocionListaCodigos[] = $transaccionPromocionListaCodigo;
            $transaccionPromocionListaCodigo->setTransaccion($this);
        }

        return $this;
    }

    public function removeTransaccionPromocionListaCodigo(TransaccionPromocionListaCodigo $transaccionPromocionListaCodigo): self
    {
        if ($this->transaccionPromocionListaCodigos->removeElement($transaccionPromocionListaCodigo)) {
            // set the owning side to null (unless already changed)
            if ($transaccionPromocionListaCodigo->getTransaccion() === $this) {
                $transaccionPromocionListaCodigo->setTransaccion(null);
            }
        }

        return $this;
    }
}
