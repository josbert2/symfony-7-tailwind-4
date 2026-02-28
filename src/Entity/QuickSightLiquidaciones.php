<?php

namespace App\Entity;

use App\Repository\QuickSightLiquidacionesRepository;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: QuickSightLiquidacionesRepository::class)]
class QuickSightLiquidaciones
{

    #[ORM\Column(type: 'integer', nullable: true)]
    private $idTrx;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estadoTrx;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaCompra;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $canalVenta;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $idOrden;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $pkgHijo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $pkgPadre;

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: true)]
    private $idItem;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estadoPkg;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estadoPkgCorregido;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaEntrega;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $unidadNegocio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $proveedor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoPrecio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $marca;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaInicio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cantidad;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioLista;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $descuento;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioPublico;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ventaBruta;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $promocionProveedor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoProveedor;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ventaLiquidacion;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $comisionBruta;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $liquidacion;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $promocionEk;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoEk;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $invitacionConfirmada;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria3;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $creditos;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razonSocial;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rut;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailCompra;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailNotificaciones;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailSoporte;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rutTitular;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titular;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $banco;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numero;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailBanco;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $proveedorActivo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cargoStaff;

    #[ORM\Column(type: 'array', length: 255, nullable: true)]
    private $permisosStaff;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaCreacionStaff;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreStaff;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailStaff;

    #[ORM\Column(type: 'array', length: 255, nullable: true)]
    private $rol_staff;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $despachoEnvio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $descuentoEnvio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $totalEnvio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $montoEnvio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $clienteId;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $usuarioId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreUsuario;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $emailUsuario;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fechaCancelacion;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaTermino;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaCreacionCliente;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $medioPagoMP;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $medioPagoTBK;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $idBodega;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreBodega;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $fulfillment;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $marketId;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ventaCancelada;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $venta;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razonCancelacion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $usuarioCancelacion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $marketResponsable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $marketNombre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTrx(): ?int
    {
        return $this->idTrx;
    }

    public function setIdTrx(?int $idTrx): self
    {
        $this->idTrx = $idTrx;

        return $this;
    }

    public function getEstadoTrx(): ?string
    {
        return $this->estadoTrx;
    }

    public function setEstadoTrx(?string $estadoTrx): self
    {
        $this->estadoTrx = $estadoTrx;

        return $this;
    }

    public function getFechaCompra(): ?\DateTimeInterface
    {
        return $this->fechaCompra;
    }

    public function setFechaCompra(?\DateTimeInterface $fechaCompra): self
    {
        $this->fechaCompra = $fechaCompra;

        return $this;
    }

    public function getCanalVenta(): ?string
    {
        return $this->canalVenta;
    }

    public function setCanalVenta(?string $canalVenta): self
    {
        $this->canalVenta = $canalVenta;

        return $this;
    }

    public function getIdOrden(): ?int
    {
        return $this->idOrden;
    }

    public function setIdOrden(?int $idOrden): self
    {
        $this->idOrden = $idOrden;

        return $this;
    }

    public function getPkgHijo(): ?int
    {
        return $this->pkgHijo;
    }

    public function setPkgHijo(?int $pkgHijo): self
    {
        $this->pkgHijo = $pkgHijo;

        return $this;
    }

    public function getPkgPadre(): ?int
    {
        return $this->pkgPadre;
    }

    public function setPkgPadre(?int $pkgPadre): self
    {
        $this->pkgPadre = $pkgPadre;

        return $this;
    }

    public function getIdItem(): ?int
    {
        return $this->idItem;
    }

    public function setIdItem(?int $idItem): self
    {
        $this->idItem = $idItem;

        return $this;
    }

    public function getEstadoPkg(): ?string
    {
        return $this->estadoPkg;
    }

    public function setEstadoPkg(?string $estadoPkg): self
    {
        $this->estadoPkg = $estadoPkg;

        return $this;
    }

    public function getEstadoPkgCorregido(): ?string
    {
        return $this->estadoPkgCorregido;
    }

    public function setEstadoPkgCorregido(?string $estadoPkgCorregido): self
    {
        $this->estadoPkgCorregido = $estadoPkgCorregido;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(?\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    public function getUnidadNegocio(): ?string
    {
        return $this->unidadNegocio;
    }

    public function setUnidadNegocio(?string $unidadNegocio): self
    {
        $this->unidadNegocio = $unidadNegocio;

        return $this;
    }

    public function getProveedor(): ?string
    {
        return $this->proveedor;
    }

    public function setProveedor(?string $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

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

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(?string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecioLista(): ?int
    {
        return $this->precioLista;
    }

    public function setPrecioLista(?int $precioLista): self
    {
        $this->precioLista = $precioLista;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(?int $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getPrecioPublico(): ?int
    {
        return $this->precioPublico;
    }

    public function setPrecioPublico(?int $precioPublico): self
    {
        $this->precioPublico = $precioPublico;

        return $this;
    }

    public function getVentaBruta(): ?int
    {
        return $this->ventaBruta;
    }

    public function setVentaBruta(?int $ventaBruta): self
    {
        $this->ventaBruta = $ventaBruta;

        return $this;
    }

    public function getPromocionProveedor(): ?int
    {
        return $this->promocionProveedor;
    }

    public function setPromocionProveedor(?int $promocionProveedor): self
    {
        $this->promocionProveedor = $promocionProveedor;

        return $this;
    }

    public function getCodigoProveedor(): ?string
    {
        return $this->codigoProveedor;
    }

    public function setCodigoProveedor(?string $codigoProveedor): self
    {
        $this->codigoProveedor = $codigoProveedor;

        return $this;
    }

    public function getVentaLiquidacion(): ?int
    {
        return $this->ventaLiquidacion;
    }

    public function setVentaLiquidacion(?int $ventaLiquidacion): self
    {
        $this->ventaLiquidacion = $ventaLiquidacion;

        return $this;
    }

    public function getComisionBruta(): ?int
    {
        return $this->comisionBruta;
    }

    public function setComisionBruta(?int $comisionBruta): self
    {
        $this->comisionBruta = $comisionBruta;

        return $this;
    }

    public function getLiquidacion(): ?int
    {
        return $this->liquidacion;
    }

    public function setLiquidacion(?int $liquidacion): self
    {
        $this->liquidacion = $liquidacion;

        return $this;
    }

    public function getPromocionEk(): ?int
    {
        return $this->promocionEk;
    }

    public function setPromocionEk(?int $promocionEk): self
    {
        $this->promocionEk = $promocionEk;

        return $this;
    }

    public function getCodigoEk(): ?string
    {
        return $this->codigoEk;
    }

    public function setCodigoEk(?string $codigoEk): self
    {
        $this->codigoEk = $codigoEk;

        return $this;
    }

    public function getInvitacionConfirmada(): ?string
    {
        return $this->invitacionConfirmada;
    }

    public function setInvitacionConfirmada(?string $invitacionConfirmada): self
    {
        $this->invitacionConfirmada = $invitacionConfirmada;

        return $this;
    }

    public function getCategoria1(): ?string
    {
        return $this->categoria1;
    }

    public function setCategoria1(?string $categoria1): self
    {
        $this->categoria1 = $categoria1;

        return $this;
    }

    public function getCategoria2(): ?string
    {
        return $this->categoria2;
    }

    public function setCategoria2(?string $categoria2): self
    {
        $this->categoria2 = $categoria2;

        return $this;
    }

    public function getCategoria3(): ?string
    {
        return $this->categoria3;
    }

    public function setCategoria3(?string $categoria3): self
    {
        $this->categoria3 = $categoria3;

        return $this;
    }

    public function getCreditos(): ?int
    {
        return $this->creditos;
    }

    public function setCreditos(?int $creditos): self
    {
        $this->creditos = $creditos;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailCompra(): ?string
    {
        return $this->emailCompra;
    }

    public function setEmailCompra(?string $emailCompra): self
    {
        $this->emailCompra = $emailCompra;

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

    public function getEmailSoporte(): ?string
    {
        return $this->emailSoporte;
    }

    public function setEmailSoporte(?string $emailSoporte): self
    {
        $this->emailSoporte = $emailSoporte;

        return $this;
    }

    public function getRutTitular(): ?string
    {
        return $this->rutTitular;
    }

    public function setRutTitular(?string $rutTitular): self
    {
        $this->rutTitular = $rutTitular;

        return $this;
    }

    public function getTitular(): ?string
    {
        return $this->titular;
    }

    public function setTitular(?string $titular): self
    {
        $this->titular = $titular;

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

    public function getBanco(): ?string
    {
        return $this->banco;
    }

    public function setBanco(?string $banco): self
    {
        $this->banco = $banco;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEmailBanco(): ?string
    {
        return $this->emailBanco;
    }

    public function setEmailBanco(?string $emailBanco): self
    {
        $this->emailBanco = $emailBanco;

        return $this;
    }

    public function getProveedorActivo(): ?string
    {
        return $this->proveedorActivo;
    }

    public function setProveedorActivo(?string $proveedorActivo): self
    {
        $this->proveedorActivo = $proveedorActivo;

        return $this;
    }

    public function getCargoStaff(): ?string
    {
        return $this->cargoStaff;
    }

    public function setCargoStaff(?string $cargoStaff): self
    {
        $this->cargoStaff = $cargoStaff;

        return $this;
    }

    public function getPermisosStaff(): ?array
    {
        return $this->permisosStaff;
    }

    public function setPermisosStaff(?array $permisosStaff): self
    {
        $this->permisosStaff = $permisosStaff;

        return $this;
    }

    public function getFechaCreacionStaff(): ?\DateTimeInterface
    {
        return $this->fechaCreacionStaff;
    }

    public function setFechaCreacionStaff(?\DateTimeInterface $fechaCreacionStaff): self
    {
        $this->fechaCreacionStaff = $fechaCreacionStaff;

        return $this;
    }

    public function getNombreStaff(): ?string
    {
        return $this->nombreStaff;
    }

    public function setNombreStaff(?string $nombreStaff): self
    {
        $this->nombreStaff = $nombreStaff;

        return $this;
    }

    public function getEmailStaff(): ?string
    {
        return $this->emailStaff;
    }

    public function setEmailStaff(?string $emailStaff): self
    {
        $this->emailStaff = $emailStaff;

        return $this;
    }

    public function getRolStaff(): ?array
    {
        return $this->rol_staff;
    }

    public function setRolStaff(?array $rol_staff): self
    {
        $this->rol_staff = $rol_staff;

        return $this;
    }

    public function getDespachoEnvio(): ?int
    {
        return $this->despachoEnvio;
    }

    public function setDespachoEnvio(?int $despachoEnvio): self
    {
        $this->despachoEnvio = $despachoEnvio;

        return $this;
    }

    public function getDescuentoEnvio(): ?int
    {
        return $this->descuentoEnvio;
    }

    public function setDescuentoEnvio(?int $descuentoEnvio): self
    {
        $this->descuentoEnvio = $descuentoEnvio;

        return $this;
    }

    public function getTotalEnvio(): ?int
    {
        return $this->totalEnvio;
    }

    public function setTotalEnvio(?int $totalEnvio): self
    {
        $this->totalEnvio = $totalEnvio;

        return $this;
    }

    public function getMontoEnvio(): ?int
    {
        return $this->montoEnvio;
    }

    public function setMontoEnvio(?int $montoEnvio): self
    {
        $this->montoEnvio = $montoEnvio;

        return $this;
    }

    public function getClienteId(): ?int
    {
        return $this->clienteId;
    }

    public function setClienteId(?int $clienteId): self
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    public function getUsuarioId(): ?int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(?int $usuarioId): self
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(?string $nombreUsuario): self
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getEmailUsuario(): ?string
    {
        return $this->emailUsuario;
    }

    public function setEmailUsuario(?string $emailUsuario): self
    {
        $this->emailUsuario = $emailUsuario;

        return $this;
    }

    public function getFechaCancelacion(): ?string
    {
        return $this->fechaCancelacion;
    }

    public function setFechaCancelacion(?string $fechaCancelacion): self
    {
        $this->fechaCancelacion = $fechaCancelacion;

        return $this;
    }

    public function getFechaTermino(): ?\DateTimeInterface
    {
        return $this->fechaTermino;
    }

    public function setFechaTermino(?\DateTimeInterface $fechaTermino): self
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }

    public function getFechaCreacionCliente(): ?\DateTimeInterface
    {
        return $this->fechaCreacionCliente;
    }

    public function setFechaCreacionCliente(?\DateTimeInterface $fechaCreacionCliente): self
    {
        $this->fechaCreacionCliente = $fechaCreacionCliente;

        return $this;
    }

    public function getMedioPagoMP(): ?string
    {
        return $this->medioPagoMP;
    }

    public function setMedioPagoMP(?string $medioPagoMP): self
    {
        $this->medioPagoMP = $medioPagoMP;

        return $this;
    }

    public function getMedioPagoTBK(): ?string
    {
        return $this->medioPagoTBK;
    }

    public function setMedioPagoTBK(?string $medioPagoTBK): self
    {
        $this->medioPagoTBK = $medioPagoTBK;

        return $this;
    }

    public function getIdBodega(): ?int
    {
        return $this->idBodega;
    }

    public function setIdBodega(?int $idBodega): self
    {
        $this->idBodega = $idBodega;

        return $this;
    }

    public function getNombreBodega(): ?string
    {
        return $this->nombreBodega;
    }

    public function setNombreBodega(?string $nombreBodega): self
    {
        $this->nombreBodega = $nombreBodega;

        return $this;
    }

    public function getFulfillment(): ?int
    {
        return $this->fulfillment;
    }

    public function setFulfillment(?int $fulfillment): self
    {
        $this->fulfillment = $fulfillment;

        return $this;
    }

    public function getMarketId(): ?int
    {
        return $this->marketId;
    }

    public function setMarketId(?int $marketId): self
    {
        $this->marketId = $marketId;

        return $this;
    }

    public function getVentaCancelada(): ?int
    {
        return $this->ventaCancelada;
    }

    public function setVentaCancelada(?int $ventaCancelada): self
    {
        $this->ventaCancelada = $ventaCancelada;

        return $this;
    }

    public function getVenta(): ?int
    {
        return $this->venta;
    }

    public function setVenta(?int $venta): self
    {
        $this->venta = $venta;

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

    public function getUsuarioCancelacion(): ?string
    {
        return $this->usuarioCancelacion;
    }

    public function setUsuarioCancelacion(?string $usuarioCancelacion): self
    {
        $this->usuarioCancelacion = $usuarioCancelacion;

        return $this;
    }

    public function getMarketResponsable(): ?string
    {
        return $this->marketResponsable;
    }

    public function setMarketResponsable(?string $marketResponsable): self
    {
        $this->marketResponsable = $marketResponsable;

        return $this;
    }

    public function getMarketNombre(): ?string
    {
        return $this->marketNombre;
    }

    public function setMarketNombre(?string $marketNombre): self
    {
        $this->marketNombre = $marketNombre;

        return $this;
    }
}
