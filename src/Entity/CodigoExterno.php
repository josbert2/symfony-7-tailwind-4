<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\CodigoExternoRepository::class)]
//  * @ORM\HasLifecycleCallbacks()

class CodigoExterno
{
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $codigo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $costo;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $fechaVencimiento;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estado = 'Disponible';

    #[ORM\OneToOne(targetEntity: 'Entrada', inversedBy: 'codigoExterno')]
    protected $entrada;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'codigosExternos')]
    protected $market;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'codigosExternos')]
    protected $proveedor;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'codigosExternos')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'codigosExternos')]
    protected $tipoPrecio;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'ownerCodigosExternos')]
    protected $owner;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

//      * @ORM\PrePersist
//      * @ORM\PreUpdate

    public function setLife()
    {
        $estado = $this->getEstado();
        if(!$estado || $estado == 'Disponible'){
            $now = new \DateTime();
            $fechaVencimiento = $this->getFechaVencimiento();

            if($this->getEntrada()){
                $estado = 'Utilizado';
            }
            elseif($fechaVencimiento && $now > $fechaVencimiento){
                $estado = 'Vencido';
            }
            else{
                $estado = 'Disponible';
            }

            $this->setEstado($estado);
        }

    }
    
    public function getBarcode($format = 'png')
    {
        $actividad = $this->getActividad();
        $tipoCodigo = NULL;
        if($actividad){
            $tipoCodigo = $actividad->getTipoCodigoExterno();
        }

        if(!$tipoCodigo){
            $tipoCodigo = 'TYPE_CODE_128';
        }

        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $tipo = constant( '\Picqer\Barcode\BarcodeGeneratorPNG::'.$tipoCodigo );

        return 'data:image/png;base64,' . base64_encode($generator->getBarcode($this->getCodigo(), $tipo));
    }

//      * Get estado.

//      * @return string|null

    public function getEstado()
    {
        $estado = $this->estado;
        if(!$estado || $estado == 'Disponible'){
            $now = new \DateTime();
            $fechaVencimiento = $this->getFechaVencimiento();
            if($fechaVencimiento && $now > $fechaVencimiento){
                $estado = 'Vencido';
            }
            else{
                $estado = 'Disponible';
            }

            $this->setEstado($estado);
        }

        return $estado;
    }

    public function getProveedorPadre()
    {
        $proveedor = $this->getTipoPrecio()->getProveedor();
        if(!$proveedor){
            $proveedor = $this->getActividad()->getProveedor();
            if(!$proveedor){
                $proveedor = $this->getProveedor();
            }
        }

        return $proveedor;
    }

    public function getCodigoTicket()
    {
        $rut = $this->getEntrada()->getRut();
        if($rut){
            $codigo = $rut;
        }
        else{
            $codigo = $this->getCodigo();
        }
//        $codigo = $this->getCodigo();

        return $codigo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getFechaVencimiento(): ?\DateTimeInterface
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento(?\DateTimeInterface $fechaVencimiento): self
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

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

    public function getEntrada(): ?Entrada
    {
        return $this->entrada;
    }

    public function setEntrada(?Entrada $entrada): self
    {
        $this->entrada = $entrada;

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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

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

    public function getTipoPrecio(): ?ActividadTipoPrecio
    {
        return $this->tipoPrecio;
    }

    public function setTipoPrecio(?ActividadTipoPrecio $tipoPrecio): self
    {
        $this->tipoPrecio = $tipoPrecio;

        return $this;
    }

    public function getOwner(): ?Proveedor
    {
        return $this->owner;
    }

    public function setOwner(?Proveedor $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

public function getCosto(): ?int
{
    return $this->costo;
}

public function setCosto(?int $costo): self
{
    $this->costo = $costo;

    return $this;
}

    

}
