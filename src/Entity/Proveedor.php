<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
#[ORM\Table(name: 'proveedor', indexes: [new ORM\Index(name: 'activo', columns: ['activo'])])]
class Proveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $tipo = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private ?string $nombre = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $razonSocial = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $rut = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $sitioWeb = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $telefono = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $emailSoporte = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $telefonoSoporte = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $descripcion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $facebook = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $twitter = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $instagram = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $tips = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $emailNotificaciones = null;

    /**
     * @ORM\Column(type="integer")
     */
    private int $cobroVariable = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private int $cobroFijo = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $notificacionCompra = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $resumenAsistencia = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $calendarioSemanal = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $quiebreStock = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $serieTerminando = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $emailCompra = true;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $politicas = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $codigoBarra = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $boletaElectronica = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $cortesias = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $codigosPropios = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $periodoFacturacion = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaInformacion = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $butacas = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $boleteria = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $productos = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $retiros = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $multivende = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $confirmacionAutomatica = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $fulfillment = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $vistaClientes = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $locales = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $vistaEntradas = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $vistaDevolucion = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $sitioPropio = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $comisionTodoEvento = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $preregistro = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaRut = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaNombre = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaTelefono = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaEmail = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaDireccion = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $entregaFechaNacimiento = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $idSeller = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $tokenSeller = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $activo = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $ultimaActualizacion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $usuarioActualizacion = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $productosActualizacion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $usuarioProductosActualizacion = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $stockActualizacion = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $usuarioStockActualizacion = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $accessToken = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $expiresAt = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $refreshToken = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $refreshTokenExpiresAt = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $merchantId = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $connectionId = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $syncNuevos = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $listaPrecioId = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $syncSiemprePrecio = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $syncSiemprePrecioOferta = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $listaPrecioOfertaId = null;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $fechaInicioOferta = null;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $fechaTerminoOferta = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $tarifaPrincipal = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $tarifaSecundaria = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $fechaMultivendeSync = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $paginaMultivendeSync = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $fechaMultivendeSyncVariante = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $paginaMultivendeSyncVariante = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $fechaMultivendeSyncLink = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $paginaMultivendeSyncLink = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $fechaMultivendeSyncCarga = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $paginaMultivendeSyncCarga = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $optionMultivendeSyncCarga = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $configuradoMultivende = false;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $fechaUltimaLiquidacion = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $urlResenaProveedor = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $urlResenaLocal = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $urlResenaActividad = false;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $urlResena = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $correoResenaSubject = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $correoResenaBody = null;

    /**
     * @Assert\Valid
     * @ORM\OneToOne(targetEntity="VichFile", inversedBy="proveedor", cascade={"persist","remove"})
     */
    protected $logo;

    /**
     * @Assert\Valid
     * @ORM\OneToOne(targetEntity="VichFile", inversedBy="proveedorFoto", cascade={"persist","remove"})
     */
    protected $foto;

    /**
     * @ORM\OneToOne(targetEntity="Direccion", inversedBy="proveedor", cascade={"persist","remove"})
     */
    protected $direccion;

    /**
     * @ORM\OneToOne(targetEntity="Market", inversedBy="proveedor", cascade={"persist","remove"})
     */
    protected $market;

    /**
     * @ORM\ManyToOne(targetEntity="Plan", inversedBy="proveedores")
     */
    protected $plan;

    /**
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="proveedores")
     */
    protected $staff;

    /**
     * @ORM\ManyToOne(targetEntity="Carrier", inversedBy="proveedoresDefault")
     */
    protected $carrierDefault;

    /**
     * @ORM\ManyToMany(targetEntity="Carrier", inversedBy="proveedores")
     */
    protected $carriers;

    /**
     * @ORM\OneToOne(targetEntity="Cuenta", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $cuenta;

    /**
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="proveedor")
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Staff", mappedBy="proveedor")
     */
    protected $staffs;

    /**
     * @ORM\OneToMany(targetEntity="Actividad", mappedBy="proveedor", cascade={"persist"})
     */
    protected $actividades;

    /**
     * @ORM\OneToMany(targetEntity="Promocion", mappedBy="proveedor")
     */
    protected $promociones;

    /**
     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="proveedor")
     */
    protected $grupos;

    /**
     * @ORM\OneToMany(targetEntity="CodigoExterno", mappedBy="proveedor")
     */
    protected $codigosExternos;

    /**
     * @ORM\OneToMany(targetEntity="CodigoExterno", mappedBy="owner")
     */
    protected $ownerCodigosExternos;

    /**
     * @ORM\OneToMany(targetEntity="ProveedorRut", mappedBy="proveedor")
     */
    protected $ruts;

    /**
     * @ORM\OneToMany(targetEntity="Mapa", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $mapas;

    /**
     * @ORM\OneToMany(targetEntity="ProveedorMarket", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $proveedorMarkets;

    /**
     * @ORM\OneToMany(targetEntity="Sucursal", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $sucursales;

    /**
     * @ORM\OneToMany(targetEntity="Bodega", mappedBy="proveedor", cascade={"persist"})
     */
    protected $bodegas;

    /**
     * @ORM\OneToMany(targetEntity="ProveedorArchivo", mappedBy="proveedor", cascade={"persist","remove"}, orphanRemoval=true)
     */
    protected $archivos;

    /**
     * @ORM\OneToMany(targetEntity="Paquete", mappedBy="proveedor")
     */
    protected $paquetes;

    /**
     * @ORM\OneToMany(targetEntity="MultivendeMap", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $multivendeMaps;

    /**
     * @ORM\OneToMany(targetEntity="TransaccionDetalle", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $transaccionDetalles;

    /**
     * @ORM\OneToMany(targetEntity="Liquidacion", mappedBy="proveedor", cascade={"persist","remove"})
     */
    protected $liquidaciones;

    /**
     * @ORM\ManyToMany(targetEntity="Paquete", mappedBy="proveedores")
     */
    protected $paquetesMulti;

    /**
     * @ORM\ManyToMany(targetEntity="Cliente", mappedBy="favoritos")
     */
    protected $clienteFavoritos;

    /**
     * @Gedmo\Slug(fields={"nombre"})
     * @ORM\Column(length=128, unique=true)
     */
    private ?string $slug = null;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected ?\DateTimeInterface $created = null;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected ?\DateTimeInterface $updated = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?\DateTimeInterface $deleted = null;

    /**
     * @ORM\OneToMany(targetEntity=StockDia::class, mappedBy="proveedor")
     */
    private $stockDias;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $temporizadores = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $cancellationInsurance = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $whatsapp = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $attendance = false;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->staffs = new ArrayCollection();
        $this->actividades = new ArrayCollection();
        $this->promociones = new ArrayCollection();
        $this->grupos = new ArrayCollection();
        $this->codigosExternos = new ArrayCollection();
        $this->ruts = new ArrayCollection();
        $this->mapas = new ArrayCollection();
        $this->proveedorMarkets = new ArrayCollection();
        $this->clienteFavoritos = new ArrayCollection();
        $this->ownerCodigosExternos = new ArrayCollection();
        $this->sucursales = new ArrayCollection();
        $this->archivos = new ArrayCollection();
        $this->bodegas = new ArrayCollection();
        $this->carriers = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
        $this->multivendeMaps = new ArrayCollection();
        $this->transaccionDetalles = new ArrayCollection();
        $this->paquetesMulti = new ArrayCollection();
        $this->stockDias = new ArrayCollection();
        $this->liquidaciones = new ArrayCollection();
    }

    public function getCodigo()
    {
        return 'SLR' . sprintf("%08d", $this->id);
    }

    public function getCompletitud()
    {
        $completitud = 0;

        $administrador = $this->getAdministrador();

        if ($administrador->getUsuario()->getTelefono()) {
            $completitud += 25;
        }

        if ($this->cuenta) {
            $completitud += 25;
        }

        if ($this->direccion) {
            $completitud += 50;
        }

//        dump($completitud);

        return $completitud;
    }

    /**
     * Set logo
     *
     * @param \VichFile $logo
     *
     * @return Proveedor
     */
    public function setLogo(\VichFile $logo = NULL)
    {
        $logo->setProveedor($this);
        $this->logo = $logo;

        return $this;
    }

    /**
     * Set foto.
     *
     * @param \VichFile|null $foto
     *
     * @return Proveedor
     */
    public function setFoto(\VichFile $foto = NULL)
    {
        $foto->setProveedorFoto($this);
        $this->foto = $foto;

        return $this;
    }

    /**
     * Set cuenta.
     *
     * @param \Cuenta|null $cuenta
     *
     * @return Proveedor
     */
    public function setCuenta(\Cuenta $cuenta = NULL)
    {
        $cuenta->setProveedor($this);
        $this->cuenta = $cuenta;

        return $this;
    }

    public function getAdministrador()
    {
        return $this->staffs->first();
    }

    public function getPlanMarket($mId): ?Plan
    {
        $plan = NULL;

        foreach ($this->getProveedorMarkets() as $proveedorMarket) {
            if ($proveedorMarket->getMarket()->getId() == $mId) {
                $plan = $proveedorMarket->getPlan();
            }
        }

        return $plan;
    }

    public function getMarketPropio(): ?Market
    {
        $market = NULL;

        foreach ($this->getProveedorMarkets() as $proveedorMarket) {
            if ($proveedorMarket->getMarketPropio()) {
                $market = $proveedorMarket->getMarket();
                break;
            }
        }

        return $market;
    }

    public function getCargaEnCurso()
    {
        return $this->getPaginaMultivendeSync() ?? $this->getPaginaMultivendeSyncVariante() ?? $this->getPaginaMultivendeSyncLink() ?? $this->getPaginaMultivendeSyncCarga();
    }

    public function getUltimaLiquidacionEmitida()
    {
        $ultimaLiquidacion = NULL;
        $liquidaciones = $this->getLiquidaciones()->toArray();
//        dump($liquidaciones);
        /** @var Liquidacion $liquidacion */
        foreach (array_reverse($liquidaciones) as $liquidacion) {
            if ($liquidacion->getFechaAprobado()) {
                $ultimaLiquidacion = $liquidacion;
                break;
            }
        }

        return $ultimaLiquidacion;
    }

    public function getProveedorMarketByMarket($market)
    {
        $proveedorMarketAux = NULL;
        foreach ($this->getProveedorMarkets() as $proveedorMarket) {
            if ($proveedorMarket->getMarket()->getId() == $market->getId()) {
                $proveedorMarketAux = $proveedorMarket;
                break;
            }
        }
        return $proveedorMarketAux;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razonSocial;
    }

    public function setRazonSocial(?string $razonSocial): self
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(?string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getSitioWeb(): ?string
    {
        return $this->sitioWeb;
    }

    public function setSitioWeb(?string $sitioWeb): self
    {
        $this->sitioWeb = $sitioWeb;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmailSoporte(): ?string
    {
        return $this->emailSoporte;
    }

    public function setEmailSoporte(?string $emailSoporte): self
    {
        $this->emailSoporte = $emailSoporte;

        return $this;
    }

    public function getTelefonoSoporte(): ?string
    {
        return $this->telefonoSoporte;
    }

    public function setTelefonoSoporte(?string $telefonoSoporte): self
    {
        $this->telefonoSoporte = $telefonoSoporte;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTips(): ?string
    {
        return $this->tips;
    }

    public function setTips(?string $tips): self
    {
        $this->tips = $tips;

        return $this;
    }

    public function getEmailNotificaciones(): ?string
    {
        return $this->emailNotificaciones;
    }

    public function setEmailNotificaciones(?string $emailNotificaciones): self
    {
        $this->emailNotificaciones = $emailNotificaciones;

        return $this;
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

    public function getNotificacionCompra(): ?bool
    {
        return $this->notificacionCompra;
    }

    public function setNotificacionCompra(bool $notificacionCompra): self
    {
        $this->notificacionCompra = $notificacionCompra;

        return $this;
    }

    public function getResumenAsistencia(): ?bool
    {
        return $this->resumenAsistencia;
    }

    public function setResumenAsistencia(bool $resumenAsistencia): self
    {
        $this->resumenAsistencia = $resumenAsistencia;

        return $this;
    }

    public function getCalendarioSemanal(): ?bool
    {
        return $this->calendarioSemanal;
    }

    public function setCalendarioSemanal(bool $calendarioSemanal): self
    {
        $this->calendarioSemanal = $calendarioSemanal;

        return $this;
    }

    public function getQuiebreStock(): ?bool
    {
        return $this->quiebreStock;
    }

    public function setQuiebreStock(bool $quiebreStock): self
    {
        $this->quiebreStock = $quiebreStock;

        return $this;
    }

    public function getSerieTerminando(): ?bool
    {
        return $this->serieTerminando;
    }

    public function setSerieTerminando(bool $serieTerminando): self
    {
        $this->serieTerminando = $serieTerminando;

        return $this;
    }

    public function getPoliticas(): ?string
    {
        return $this->politicas;
    }

    public function setPoliticas(?string $politicas): self
    {
        $this->politicas = $politicas;

        return $this;
    }

    public function getCodigoBarra(): ?bool
    {
        return $this->codigoBarra;
    }

    public function setCodigoBarra(bool $codigoBarra): self
    {
        $this->codigoBarra = $codigoBarra;

        return $this;
    }

    public function getBoletaElectronica(): ?bool
    {
        return $this->boletaElectronica;
    }

    public function setBoletaElectronica(bool $boletaElectronica): self
    {
        $this->boletaElectronica = $boletaElectronica;

        return $this;
    }

    public function getCortesias(): ?bool
    {
        return $this->cortesias;
    }

    public function setCortesias(bool $cortesias): self
    {
        $this->cortesias = $cortesias;

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

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getLogo(): ?VichFile
    {
        return $this->logo;
    }

    public function getFoto(): ?VichFile
    {
        return $this->foto;
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

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

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

    public function getCuenta(): ?Cuenta
    {
        return $this->cuenta;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->setProveedor($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            // set the owning side to null (unless already changed)
            if ($tag->getProveedor() === $this) {
                $tag->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Staff[]
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
            $staff->setProveedor($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getProveedor() === $this) {
                $staff->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Actividad[]
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividad $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->setProveedor($this);
        }

        return $this;
    }

    public function removeActividade(Actividad $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
            // set the owning side to null (unless already changed)
            if ($actividade->getProveedor() === $this) {
                $actividade->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promocion[]
     */
    public function getPromociones(): Collection
    {
        return $this->promociones;
    }

    public function addPromocione(Promocion $promocione): self
    {
        if (!$this->promociones->contains($promocione)) {
            $this->promociones[] = $promocione;
            $promocione->setProveedor($this);
        }

        return $this;
    }

    public function removePromocione(Promocion $promocione): self
    {
        if ($this->promociones->contains($promocione)) {
            $this->promociones->removeElement($promocione);
            // set the owning side to null (unless already changed)
            if ($promocione->getProveedor() === $this) {
                $promocione->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Grupo[]
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): self
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos[] = $grupo;
            $grupo->setProveedor($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->contains($grupo)) {
            $this->grupos->removeElement($grupo);
            // set the owning side to null (unless already changed)
            if ($grupo->getProveedor() === $this) {
                $grupo->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CodigoExterno[]
     */
    public function getCodigosExternos(): Collection
    {
        return $this->codigosExternos;
    }

    public function addCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if (!$this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos[] = $codigosExterno;
            $codigosExterno->setProveedor($this);
        }

        return $this;
    }

    public function removeCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if ($this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos->removeElement($codigosExterno);
            // set the owning side to null (unless already changed)
            if ($codigosExterno->getProveedor() === $this) {
                $codigosExterno->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProveedorRut[]
     */
    public function getRuts(): Collection
    {
        return $this->ruts;
    }

    public function addRut(ProveedorRut $rut): self
    {
        if (!$this->ruts->contains($rut)) {
            $this->ruts[] = $rut;
            $rut->setProveedor($this);
        }

        return $this;
    }

    public function removeRut(ProveedorRut $rut): self
    {
        if ($this->ruts->contains($rut)) {
            $this->ruts->removeElement($rut);
            // set the owning side to null (unless already changed)
            if ($rut->getProveedor() === $this) {
                $rut->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mapa[]
     */
    public function getMapas(): Collection
    {
        return $this->mapas;
    }

    public function addMapa(Mapa $mapa): self
    {
        if (!$this->mapas->contains($mapa)) {
            $this->mapas[] = $mapa;
            $mapa->setProveedor($this);
        }

        return $this;
    }

    public function removeMapa(Mapa $mapa): self
    {
        if ($this->mapas->contains($mapa)) {
            $this->mapas->removeElement($mapa);
            // set the owning side to null (unless already changed)
            if ($mapa->getProveedor() === $this) {
                $mapa->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProveedorMarket[]
     */
    public function getProveedorMarkets(): Collection
    {
        return $this->proveedorMarkets;
    }

    public function addProveedorMarket(ProveedorMarket $proveedorMarket): self
    {
        if (!$this->proveedorMarkets->contains($proveedorMarket)) {
            $this->proveedorMarkets[] = $proveedorMarket;
            $proveedorMarket->setProveedor($this);
        }

        return $this;
    }

    public function removeProveedorMarket(ProveedorMarket $proveedorMarket): self
    {
        if ($this->proveedorMarkets->contains($proveedorMarket)) {
            $this->proveedorMarkets->removeElement($proveedorMarket);
            // set the owning side to null (unless already changed)
            if ($proveedorMarket->getProveedor() === $this) {
                $proveedorMarket->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cliente[]
     */
    public function getClienteFavoritos(): Collection
    {
        return $this->clienteFavoritos;
    }

    public function addClienteFavorito(Cliente $clienteFavorito): self
    {
        if (!$this->clienteFavoritos->contains($clienteFavorito)) {
            $this->clienteFavoritos[] = $clienteFavorito;
            $clienteFavorito->addFavorito($this);
        }

        return $this;
    }

    public function removeClienteFavorito(Cliente $clienteFavorito): self
    {
        if ($this->clienteFavoritos->contains($clienteFavorito)) {
            $this->clienteFavoritos->removeElement($clienteFavorito);
            $clienteFavorito->removeFavorito($this);
        }

        return $this;
    }

    public function getCodigosPropios(): ?bool
    {
        return $this->codigosPropios;
    }

    public function setCodigosPropios(bool $codigosPropios): self
    {
        $this->codigosPropios = $codigosPropios;

        return $this;
    }

    public function getEntregaInformacion(): ?bool
    {
        return $this->entregaInformacion;
    }

    public function setEntregaInformacion(bool $entregaInformacion): self
    {
        $this->entregaInformacion = $entregaInformacion;

        return $this;
    }

    public function getButacas(): ?bool
    {
        return $this->butacas;
    }

    public function setButacas(bool $butacas): self
    {
        $this->butacas = $butacas;

        return $this;
    }

    /**
     * @return Collection|CodigoExterno[]
     */
    public function getOwnerCodigosExternos(): Collection
    {
        return $this->ownerCodigosExternos;
    }

    public function addOwnerCodigosExterno(CodigoExterno $ownerCodigosExterno): self
    {
        if (!$this->ownerCodigosExternos->contains($ownerCodigosExterno)) {
            $this->ownerCodigosExternos[] = $ownerCodigosExterno;
            $ownerCodigosExterno->setOwner($this);
        }

        return $this;
    }

    public function removeOwnerCodigosExterno(CodigoExterno $ownerCodigosExterno): self
    {
        if ($this->ownerCodigosExternos->contains($ownerCodigosExterno)) {
            $this->ownerCodigosExternos->removeElement($ownerCodigosExterno);
            // set the owning side to null (unless already changed)
            if ($ownerCodigosExterno->getOwner() === $this) {
                $ownerCodigosExterno->setOwner(NULL);
            }
        }

        return $this;
    }

    public function getEmailCompra(): ?bool
    {
        return $this->emailCompra;
    }

    public function setEmailCompra(bool $emailCompra): self
    {
        $this->emailCompra = $emailCompra;

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

    /**
     * @return Collection|Sucursal[]
     */
    public function getSucursales(): Collection
    {
        return $this->sucursales;
    }

    public function addSucursale(Sucursal $sucursale): self
    {
        if (!$this->sucursales->contains($sucursale)) {
            $this->sucursales[] = $sucursale;
            $sucursale->setProveedor($this);
        }

        return $this;
    }

    public function removeSucursale(Sucursal $sucursale): self
    {
        if ($this->sucursales->contains($sucursale)) {
            $this->sucursales->removeElement($sucursale);
            // set the owning side to null (unless already changed)
            if ($sucursale->getProveedor() === $this) {
                $sucursale->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProveedorArchivo[]
     */
    public function getArchivos(): Collection
    {
        return $this->archivos;
    }

    public function addArchivo(ProveedorArchivo $archivo): self
    {
        if (!$this->archivos->contains($archivo)) {
            $this->archivos[] = $archivo;
            $archivo->setProveedor($this);
        }

        return $this;
    }

    public function removeArchivo(ProveedorArchivo $archivo): self
    {
        if ($this->archivos->contains($archivo)) {
            $this->archivos->removeElement($archivo);
            // set the owning side to null (unless already changed)
            if ($archivo->getProveedor() === $this) {
                $archivo->setProveedor(NULL);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bodega[]
     */
    public function getBodegas(): Collection
    {
        return $this->bodegas;
    }

    public function addBodega(Bodega $bodega): self
    {
        if (!$this->bodegas->contains($bodega)) {
            $this->bodegas[] = $bodega;
            $bodega->setProveedor($this);
        }

        return $this;
    }

    public function removeBodega(Bodega $bodega): self
    {
        if ($this->bodegas->contains($bodega)) {
            $this->bodegas->removeElement($bodega);
            // set the owning side to null (unless already changed)
            if ($bodega->getProveedor() === $this) {
                $bodega->setProveedor(NULL);
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

    public function getIdSeller(): ?string
    {
        return $this->idSeller;
    }

    public function setIdSeller(?string $idSeller): self
    {
        $this->idSeller = $idSeller;

        return $this;
    }

    /**
     * @return Collection|Carrier[]
     */
    public function getCarriers(): Collection
    {
        return $this->carriers;
    }

    public function addCarrier(Carrier $carrier): self
    {
        if (!$this->carriers->contains($carrier)) {
            $this->carriers[] = $carrier;
        }

        return $this;
    }

    public function removeCarrier(Carrier $carrier): self
    {
        if ($this->carriers->contains($carrier)) {
            $this->carriers->removeElement($carrier);
        }

        return $this;
    }

    public function getTokenSeller(): ?string
    {
        return $this->tokenSeller;
    }

    public function setTokenSeller(?string $tokenSeller): self
    {
        $this->tokenSeller = $tokenSeller;

        return $this;
    }

    public function getRetiros(): ?bool
    {
        return $this->retiros;
    }

    public function setRetiros(bool $retiros): self
    {
        $this->retiros = $retiros;

        return $this;
    }

    /**
     * @return Collection|Paquete[]
     */
    public function getPaquetes(): Collection
    {
        return $this->paquetes;
    }

    public function addPaquete(Paquete $paquete): self
    {
        if (!$this->paquetes->contains($paquete)) {
            $this->paquetes[] = $paquete;
            $paquete->setProveedor($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getProveedor() === $this) {
                $paquete->setProveedor(NULL);
            }
        }

        return $this;
    }

    public function getUltimaActualizacion(): ?\DateTimeInterface
    {
        return $this->ultimaActualizacion;
    }

    public function setUltimaActualizacion(?\DateTimeInterface $ultimaActualizacion): self
    {
        $this->ultimaActualizacion = $ultimaActualizacion;

        return $this;
    }

    public function getUsuarioActualizacion(): ?string
    {
        return $this->usuarioActualizacion;
    }

    public function setUsuarioActualizacion(?string $usuarioActualizacion): self
    {
        $this->usuarioActualizacion = $usuarioActualizacion;

        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(?string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(?string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getRefreshTokenExpiresAt(): ?\DateTimeInterface
    {
        return $this->refreshTokenExpiresAt;
    }

    public function setRefreshTokenExpiresAt(?\DateTimeInterface $refreshTokenExpiresAt): self
    {
        $this->refreshTokenExpiresAt = $refreshTokenExpiresAt;

        return $this;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function setMerchantId(?string $merchantId): self
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return Collection|MultivendeMap[]
     */
    public function getMultivendeMaps(): Collection
    {
        return $this->multivendeMaps;
    }

    public function addMultivendeMap(MultivendeMap $multivendeMap): self
    {
        if (!$this->multivendeMaps->contains($multivendeMap)) {
            $this->multivendeMaps[] = $multivendeMap;
            $multivendeMap->setProveedor($this);
        }

        return $this;
    }

    public function removeMultivendeMap(MultivendeMap $multivendeMap): self
    {
        if ($this->multivendeMaps->removeElement($multivendeMap)) {
            // set the owning side to null (unless already changed)
            if ($multivendeMap->getProveedor() === $this) {
                $multivendeMap->setProveedor(NULL);
            }
        }

        return $this;
    }

    public function getSyncNuevos(): ?bool
    {
        return $this->syncNuevos;
    }

    public function setSyncNuevos(bool $syncNuevos): self
    {
        $this->syncNuevos = $syncNuevos;

        return $this;
    }

    public function getListaPrecioId(): ?string
    {
        return $this->listaPrecioId;
    }

    public function setListaPrecioId(?string $listaPrecioId): self
    {
        $this->listaPrecioId = $listaPrecioId;

        return $this;
    }

    public function getSyncSiemprePrecio(): ?bool
    {
        return $this->syncSiemprePrecio;
    }

    public function setSyncSiemprePrecio(bool $syncSiemprePrecio): self
    {
        $this->syncSiemprePrecio = $syncSiemprePrecio;

        return $this;
    }

    public function getListaPrecioOfertaId(): ?string
    {
        return $this->listaPrecioOfertaId;
    }

    public function setListaPrecioOfertaId(?string $listaPrecioOfertaId): self
    {
        $this->listaPrecioOfertaId = $listaPrecioOfertaId;

        return $this;
    }

    public function getFechaInicioOferta(): ?\DateTimeInterface
    {
        return $this->fechaInicioOferta;
    }

    public function setFechaInicioOferta(?\DateTimeInterface $fechaInicioOferta): self
    {
        $this->fechaInicioOferta = $fechaInicioOferta;

        return $this;
    }

    public function getFechaTerminoOferta(): ?\DateTimeInterface
    {
        return $this->fechaTerminoOferta;
    }

    public function setFechaTerminoOferta(?\DateTimeInterface $fechaTerminoOferta): self
    {
        $this->fechaTerminoOferta = $fechaTerminoOferta;

        return $this;
    }

    public function getProductosActualizacion(): ?\DateTimeInterface
    {
        return $this->productosActualizacion;
    }

    public function setProductosActualizacion(?\DateTimeInterface $productosActualizacion): self
    {
        $this->productosActualizacion = $productosActualizacion;

        return $this;
    }

    public function getUsuarioProductosActualizacion(): ?string
    {
        return $this->usuarioProductosActualizacion;
    }

    public function setUsuarioProductosActualizacion(?string $usuarioProductosActualizacion): self
    {
        $this->usuarioProductosActualizacion = $usuarioProductosActualizacion;

        return $this;
    }

    public function getStockActualizacion(): ?\DateTimeInterface
    {
        return $this->stockActualizacion;
    }

    public function setStockActualizacion(?\DateTimeInterface $stockActualizacion): self
    {
        $this->stockActualizacion = $stockActualizacion;

        return $this;
    }

    public function getUsuarioStockActualizacion(): ?string
    {
        return $this->usuarioStockActualizacion;
    }

    public function setUsuarioStockActualizacion(?string $usuarioStockActualizacion): self
    {
        $this->usuarioStockActualizacion = $usuarioStockActualizacion;

        return $this;
    }

    public function getSyncSiemprePrecioOferta(): ?bool
    {
        return $this->syncSiemprePrecioOferta;
    }

    public function setSyncSiemprePrecioOferta(bool $syncSiemprePrecioOferta): self
    {
        $this->syncSiemprePrecioOferta = $syncSiemprePrecioOferta;

        return $this;
    }

    public function getMultivende(): ?bool
    {
        return $this->multivende;
    }

    public function setMultivende(bool $multivende): self
    {
        $this->multivende = $multivende;

        return $this;
    }

    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    public function setConnectionId(?string $connectionId): self
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    public function getTarifaPrincipal(): ?string
    {
        return $this->tarifaPrincipal;
    }

    public function setTarifaPrincipal(?string $tarifaPrincipal): self
    {
        $this->tarifaPrincipal = $tarifaPrincipal;

        return $this;
    }

    public function getTarifaSecundaria(): ?string
    {
        return $this->tarifaSecundaria;
    }

    public function setTarifaSecundaria(?string $tarifaSecundaria): self
    {
        $this->tarifaSecundaria = $tarifaSecundaria;

        return $this;
    }

    public function getPaginaMultivendeSync(): ?int
    {
        return $this->paginaMultivendeSync;
    }

    public function setPaginaMultivendeSync(?int $paginaMultivendeSync): self
    {
        $this->paginaMultivendeSync = $paginaMultivendeSync;

        return $this;
    }

    public function getFechaMultivendeSync(): ?\DateTimeInterface
    {
        return $this->fechaMultivendeSync;
    }

    public function setFechaMultivendeSync(?\DateTimeInterface $fechaMultivendeSync): self
    {
        $this->fechaMultivendeSync = $fechaMultivendeSync;

        return $this;
    }

    public function getFechaMultivendeSyncVariante(): ?\DateTimeInterface
    {
        return $this->fechaMultivendeSyncVariante;
    }

    public function setFechaMultivendeSyncVariante(?\DateTimeInterface $fechaMultivendeSyncVariante): self
    {
        $this->fechaMultivendeSyncVariante = $fechaMultivendeSyncVariante;

        return $this;
    }

    public function getPaginaMultivendeSyncVariante(): ?int
    {
        return $this->paginaMultivendeSyncVariante;
    }

    public function setPaginaMultivendeSyncVariante(?int $paginaMultivendeSyncVariante): self
    {
        $this->paginaMultivendeSyncVariante = $paginaMultivendeSyncVariante;

        return $this;
    }

    public function getFechaMultivendeSyncLink(): ?\DateTimeInterface
    {
        return $this->fechaMultivendeSyncLink;
    }

    public function setFechaMultivendeSyncLink(?\DateTimeInterface $fechaMultivendeSyncLink): self
    {
        $this->fechaMultivendeSyncLink = $fechaMultivendeSyncLink;

        return $this;
    }

    public function getPaginaMultivendeSyncLink(): ?int
    {
        return $this->paginaMultivendeSyncLink;
    }

    public function setPaginaMultivendeSyncLink(?int $paginaMultivendeSyncLink): self
    {
        $this->paginaMultivendeSyncLink = $paginaMultivendeSyncLink;

        return $this;
    }

    public function getFechaMultivendeSyncCarga(): ?\DateTimeInterface
    {
        return $this->fechaMultivendeSyncCarga;
    }

    public function setFechaMultivendeSyncCarga(?\DateTimeInterface $fechaMultivendeSyncCarga): self
    {
        $this->fechaMultivendeSyncCarga = $fechaMultivendeSyncCarga;

        return $this;
    }

    public function getPaginaMultivendeSyncCarga(): ?int
    {
        return $this->paginaMultivendeSyncCarga;
    }

    public function setPaginaMultivendeSyncCarga(?int $paginaMultivendeSyncCarga): self
    {
        $this->paginaMultivendeSyncCarga = $paginaMultivendeSyncCarga;

        return $this;
    }

    public function getOptionMultivendeSyncCarga(): ?string
    {
        return $this->optionMultivendeSyncCarga;
    }

    public function setOptionMultivendeSyncCarga(?string $optionMultivendeSyncCarga): self
    {
        $this->optionMultivendeSyncCarga = $optionMultivendeSyncCarga;

        return $this;
    }

    public function getConfiguradoMultivende(): ?bool
    {
        return $this->configuradoMultivende;
    }

    public function setConfiguradoMultivende(bool $configuradoMultivende): self
    {
        $this->configuradoMultivende = $configuradoMultivende;

        return $this;
    }

    /**
     * @return Collection|TransaccionDetalle[]
     */
    public function getTransaccionDetalles(): Collection
    {
        return $this->transaccionDetalles;
    }

    public function addTransaccionDetalle(TransaccionDetalle $transaccionDetalle): self
    {
        if (!$this->transaccionDetalles->contains($transaccionDetalle)) {
            $this->transaccionDetalles[] = $transaccionDetalle;
            $transaccionDetalle->setProveedor($this);
        }

        return $this;
    }

    public function removeTransaccionDetalle(TransaccionDetalle $transaccionDetalle): self
    {
        if ($this->transaccionDetalles->removeElement($transaccionDetalle)) {
            // set the owning side to null (unless already changed)
            if ($transaccionDetalle->getProveedor() === $this) {
                $transaccionDetalle->setProveedor(NULL);
            }
        }

        return $this;
    }

    public function getConfirmacionAutomatica(): ?bool
    {
        return $this->confirmacionAutomatica;
    }

    public function setConfirmacionAutomatica(bool $confirmacionAutomatica): self
    {
        $this->confirmacionAutomatica = $confirmacionAutomatica;

        return $this;
    }

    public function getCarrierDefault(): ?Carrier
    {
        return $this->carrierDefault;
    }

    public function setCarrierDefault(?Carrier $carrierDefault): self
    {
        $this->carrierDefault = $carrierDefault;

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

    /**
     * @return Collection|Paquete[]
     */
    public function getPaquetesMulti(): Collection
    {
        return $this->paquetesMulti;
    }

    public function addPaquetesMulti(Paquete $paquetesMulti): self
    {
        if (!$this->paquetesMulti->contains($paquetesMulti)) {
            $this->paquetesMulti[] = $paquetesMulti;
            $paquetesMulti->addProveedore($this);
        }

        return $this;
    }

    public function removePaquetesMulti(Paquete $paquetesMulti): self
    {
        if ($this->paquetesMulti->removeElement($paquetesMulti)) {
            $paquetesMulti->removeProveedore($this);
        }

        return $this;
    }

    /**
     * @return Collection|StockDia[]
     */
    public function getStockDias(): Collection
    {
        return $this->stockDias;
    }

    public function addStockDia(StockDia $stockDia): self
    {
        if (!$this->stockDias->contains($stockDia)) {
            $this->stockDias[] = $stockDia;
            $stockDia->setProveedor($this);
        }

        return $this;
    }

    public function removeStockDia(StockDia $stockDia): self
    {
        if ($this->stockDias->removeElement($stockDia)) {
            // set the owning side to null (unless already changed)
            if ($stockDia->getProveedor() === $this) {
                $stockDia->setProveedor(NULL);
            }
        }

        return $this;
    }

    public function getFechaUltimaLiquidacion(): ?\DateTimeInterface
    {
        return $this->fechaUltimaLiquidacion;
    }

    public function setFechaUltimaLiquidacion(?\DateTimeInterface $fechaUltimaLiquidacion): self
    {
        $this->fechaUltimaLiquidacion = $fechaUltimaLiquidacion;

        return $this;
    }

    /**
     * @return Collection|Liquidacion[]
     */
    public function getLiquidaciones(): Collection
    {
        return $this->liquidaciones;
    }

    public function addLiquidacione(Liquidacion $liquidacione): self
    {
        if (!$this->liquidaciones->contains($liquidacione)) {
            $this->liquidaciones[] = $liquidacione;
            $liquidacione->setProveedor($this);
        }

        return $this;
    }

    public function removeLiquidacione(Liquidacion $liquidacione): self
    {
        if ($this->liquidaciones->removeElement($liquidacione)) {
            // set the owning side to null (unless already changed)
            if ($liquidacione->getProveedor() === $this) {
                $liquidacione->setProveedor(NULL);
            }
        }

        return $this;
    }

    public function getVistaClientes(): ?bool
    {
        return $this->vistaClientes;
    }

    public function setVistaClientes(bool $vistaClientes): self
    {
        $this->vistaClientes = $vistaClientes;

        return $this;
    }

    public function getComisionTodoEvento(): ?bool
    {
        return $this->comisionTodoEvento;
    }

    public function getLocales(): ?bool
    {
        return $this->locales;
    }

    public function setComisionTodoEvento(bool $comisionTodoEvento): self
    {
        $this->comisionTodoEvento = $comisionTodoEvento;

        return $this;
    }

    public function setLocales(?bool $locales): self
    {
        $this->locales = $locales;

        return $this;
    }

    public function getListadoLocales()
    {
        $locales = [];
        foreach ($this->staffs as $staff) {
            foreach ($staff->getLocals() as $local) {
                $locales[] = $local;
            }
        }
        return $locales;
    }

    public function getVistaEntradas(): ?bool
    {
        return $this->vistaEntradas;
    }

    public function setVistaEntradas(?bool $vistaEntradas): self
    {
        $this->vistaEntradas = $vistaEntradas;

        return $this;
    }

    public function getVistaDevolucion(): ?bool
    {
        return $this->vistaDevolucion;
    }

    public function setVistaDevolucion(?bool $vistaDevolucion): self
    {
        $this->vistaDevolucion = $vistaDevolucion;

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

    public function getSitioPropio(): ?bool
    {
        return $this->sitioPropio;
    }

    public function setSitioPropio(bool $sitioPropio): self
    {
        $this->sitioPropio = $sitioPropio;

        return $this;
    }

    public function getPreregistro(): ?bool
    {
        return $this->preregistro;
    }

    public function setPreregistro(bool $preregistro): self
    {
        $this->preregistro = $preregistro;

        return $this;
    }

    public function getEntregaRut(): ?bool
    {
        return $this->entregaRut;
    }

    public function setEntregaRut(bool $entregaRut): self
    {
        $this->entregaRut = $entregaRut;

        return $this;
    }

    public function getEntregaNombre(): ?bool
    {
        return $this->entregaNombre;
    }

    public function setEntregaNombre(bool $entregaNombre): self
    {
        $this->entregaNombre = $entregaNombre;

        return $this;
    }

    public function getEntregaTelefono(): ?bool
    {
        return $this->entregaTelefono;
    }

    public function setEntregaTelefono(bool $entregaTelefono): self
    {
        $this->entregaTelefono = $entregaTelefono;

        return $this;
    }

    public function getEntregaEmail(): ?bool
    {
        return $this->entregaEmail;
    }

    public function setEntregaEmail(bool $entregaEmail): self
    {
        $this->entregaEmail = $entregaEmail;

        return $this;
    }

    public function getEntregaDireccion(): ?bool
    {
        return $this->entregaDireccion;
    }

    public function setEntregaDireccion(bool $entregaDireccion): self
    {
        $this->entregaDireccion = $entregaDireccion;

        return $this;
    }

    public function getEntregaFechaNacimiento(): ?bool
    {
        return $this->entregaFechaNacimiento;
    }

    public function setEntregaFechaNacimiento(bool $entregaFechaNacimiento): self
    {
        $this->entregaFechaNacimiento = $entregaFechaNacimiento;

        return $this;
    }

    public function getTemporizadores(): ?bool
    {
        return $this->temporizadores;
    }

    public function setTemporizadores(bool $temporizadores): self
    {
        $this->temporizadores= $temporizadores;

        return $this;
    }

    public function getCancellationInsurance(): ?bool
    {
        return $this->cancellationInsurance;
    }
    public function setCancellationInsurance(bool $cancellationInsurance): self
    {
        $this->cancellationInsurance = $cancellationInsurance;
        return $this;
    }

    public function getWhatsapp(): ?bool
    {
        return $this->whatsapp;
    }

    public function setWhatsapp(bool $whatsapp): self
    {
        $this->whatsapp = $whatsapp;
        return $this;
    }

    public function getAttendance(): ?bool
    {
        return $this->attendance;
    }

    public function setAttendance(bool $attendance): self
    {
        $this->attendance = $attendance;
        return $this;
    }

    public function getUrlResena(): ?string
    {
        return $this->urlResena;
    }

    public function setUrlResena(?string $urlResena): self
    {
        $this->urlResena = $urlResena;

        return $this;
    }

    public function getUrlResenaProveedor(): ?bool
    {
        return $this->urlResenaProveedor;
    }

    public function setUrlResenaProveedor(bool $urlResenaProveedor): self
    {
        $this->urlResenaProveedor = $urlResenaProveedor;

        return $this;
    }

    public function getUrlResenaLocal(): ?bool
    {
        return $this->urlResenaLocal;
    }

    public function setUrlResenaLocal(bool $urlResenaLocal): self
    {
        $this->urlResenaLocal = $urlResenaLocal;

        return $this;
    }

    public function getUrlResenaActividad(): ?bool
    {
        return $this->urlResenaActividad;
    }

    public function setUrlResenaActividad(bool $urlResenaActividad): self
    {
        $this->urlResenaActividad = $urlResenaActividad;

        return $this;
    }

    public function getCorreoResenaSubject(): ?string
    {
        return $this->correoResenaSubject;
    }

    public function setCorreoResenaSubject(?string $correoResenaSubject): self
    {
        $this->correoResenaSubject = $correoResenaSubject;

        return $this;
    }

    public function getCorreoResenaBody(): ?string
    {
        return $this->correoResenaBody;
    }

    public function setCorreoResenaBody(?string $correoResenaBody): self
    {
        $this->correoResenaBody = $correoResenaBody;

        return $this;
    }
}
