<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'suscripcion_proveedor_cobro')]
 
class SuscripcionProveedorCobro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'SuscripcionProveedor')]
    #[ORM\JoinColumn(nullable: false)]
    private $suscripcionProveedor;

    #[ORM\ManyToOne(targetEntity: 'Proveedor')]
    #[ORM\JoinColumn(nullable: false)]
    private $proveedor;

    #[ORM\Column(type: 'integer')]
    private $monto;

    #[ORM\Column(type: 'string', length: 10)]
    private $moneda;

    #[ORM\Column(type: 'string', length: 20)]
    private $estado;

    #[ORM\Column(type: 'string', length: 100)]
    private $ordenCompra;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $codigoRespuestaOneclick;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mensajeError;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaCobro;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMoneda()
    {
        return $this->moneda;
    }

    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getOrdenCompra()
    {
        return $this->ordenCompra;
    }

    public function setOrdenCompra($ordenCompra)
    {
        $this->ordenCompra = $ordenCompra;

        return $this;
    }

    public function getCodigoRespuestaOneclick()
    {
        return $this->codigoRespuestaOneclick;
    }

    public function setCodigoRespuestaOneclick($codigoRespuestaOneclick)
    {
        $this->codigoRespuestaOneclick = $codigoRespuestaOneclick;

        return $this;
    }

    public function getMensajeError()
    {
        return $this->mensajeError;
    }

    public function setMensajeError($mensajeError)
    {
        $this->mensajeError = $mensajeError;

        return $this;
    }

    public function getFechaCobro()
    {
        return $this->fechaCobro;
    }

    public function setFechaCobro($fechaCobro)
    {
        $this->fechaCobro = $fechaCobro;

        return $this;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getSuscripcionProveedor()
    {
        return $this->suscripcionProveedor;
    }

    public function setSuscripcionProveedor($suscripcionProveedor)
    {
        $this->suscripcionProveedor = $suscripcionProveedor;

        return $this;
    }

    
}
