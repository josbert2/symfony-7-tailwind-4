<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\RetiroRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Retiro
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cantidad = 0;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $telefono;

    #[ORM\Column(type: 'decimal', scale: 1)]
    private $pesoPromedio = 0;

    #[ORM\Column(type: 'string', length: 255)]
    private $tamanoPromedio;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idSeller;

    #[ORM\Column(type: 'datetime')]
    private $fechaRetiro;

    #[ORM\Column(type: 'string', length: 255)]
    private $horarioRetiro;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $retiro;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $entrega;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $alto;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $ancho;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $largo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observaciones;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Bodega', inversedBy: 'retiros')]
    protected $bodega;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Carrier', inversedBy: 'retiros')]
    protected $carrier;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'retiros')]
    protected $proveedor;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getProveedor()
    {
        return $this->getBodega()->getProveedor();
    }
    
    public function getCodigo()
    {
        return 'PUP'.sprintf("%08d", $this->id);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTamanoPromedio(): ?string
    {
        return $this->tamanoPromedio;
    }

    public function setTamanoPromedio(string $tamanoPromedio): self
    {
        $this->tamanoPromedio = $tamanoPromedio;

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

    public function getIdSeller(): ?string
    {
        return $this->idSeller;
    }

    public function setIdSeller(?string $idSeller): self
    {
        $this->idSeller = $idSeller;

        return $this;
    }

    public function getFechaRetiro(): ?\DateTimeInterface
    {
        return $this->fechaRetiro;
    }

    public function setFechaRetiro(\DateTimeInterface $fechaRetiro): self
    {
        $this->fechaRetiro = $fechaRetiro;

        return $this;
    }

    public function getHorarioRetiro(): ?string
    {
        return $this->horarioRetiro;
    }

    public function setHorarioRetiro(string $horarioRetiro): self
    {
        $this->horarioRetiro = $horarioRetiro;

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

    public function getEntrega(): ?\DateTimeInterface
    {
        return $this->entrega;
    }

    public function setEntrega(?\DateTimeInterface $entrega): self
    {
        $this->entrega = $entrega;

        return $this;
    }

    public function getAlto(): ?string
    {
        return $this->alto;
    }

    public function setAlto(?string $alto): self
    {
        $this->alto = $alto;

        return $this;
    }

    public function getAncho(): ?string
    {
        return $this->ancho;
    }

    public function setAncho(?string $ancho): self
    {
        $this->ancho = $ancho;

        return $this;
    }

    public function getLargo(): ?string
    {
        return $this->largo;
    }

    public function setLargo(?string $largo): self
    {
        $this->largo = $largo;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

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

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getPesoPromedio(): ?string
    {
        return $this->pesoPromedio;
    }

    public function setPesoPromedio(string $pesoPromedio): self
    {
        $this->pesoPromedio = $pesoPromedio;

        return $this;
    }

}
