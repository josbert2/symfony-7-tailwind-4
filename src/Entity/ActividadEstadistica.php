<?php

namespace App\Entity;

use App\Repository\ActividadEstadisticaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: ActividadEstadisticaRepository::class)]
class ActividadEstadistica
{

    #[ORM\Column(type: 'integer')]
    private $actividadEventoId;

    #[ORM\Column(type: 'datetime')]
    private $fechaInicio;

    #[ORM\Column(type: 'datetime')]
    private $fechaTermino;

    #[ORM\Column(type: 'string', length: 255)]
    private $sinRestriccion;

    #[ORM\Column(type: 'integer')]
    private $entradas;

    #[ORM\Column(type: 'integer')]
    private $precioFinal;

    #[ORM\Column(type: 'integer')]
    private $precio;

    #[ORM\Column(type: 'integer')]
    private $disponible;

    #[ORM\Column(type: 'integer')]
    private $porcDesc;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipoPrecio;

    #[ORM\Column(type: 'integer')]
    private $tipoPrecioCount;

    #[ORM\Column(type: 'float')]
    private $maxDescuento;

    #[ORM\Column(type: 'integer')]
    private $minPrecio;

    #[ORM\Column(type: 'integer')]
    private $sla;

    #[ORM\Column(type: 'integer')]
    private $fulfillment;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 255)]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'actividadEstadisticas', targetEntity: Actividad::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $actividad;

    #[ORM\ManyToOne(inversedBy: 'actividadEstadisticas', targetEntity: Market::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $market;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $descuento;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $totalDisponible;

    public function __construct()
    {

    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getActividadEventoId(): ?int
    {
        return $this->actividadEventoId;
    }

    public function setActividadEventoId(int $actividadEventoId): self
    {
        $this->actividadEventoId = $actividadEventoId;

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

    public function getSinRestriccion(): ?string
    {
        return $this->sinRestriccion;
    }

    public function setSinRestriccion(string $sinRestriccion): self
    {
        $this->sinRestriccion = $sinRestriccion;

        return $this;
    }

    public function getEntradas(): ?int
    {
        return $this->entradas;
    }

    public function setEntradas(int $entradas): self
    {
        $this->entradas = $entradas;

        return $this;
    }

    public function getPrecioFinal(): ?int
    {
        return $this->precioFinal;
    }

    public function setPrecioFinal(int $precioFinal): self
    {
        $this->precioFinal = $precioFinal;

        return $this;
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

    public function getDisponible(): ?int
    {
        return $this->disponible;
    }

    public function setDisponible(int $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getPorcDesc(): ?int
    {
        return $this->porcDesc;
    }

    public function setPorcDesc(int $porcDesc): self
    {
        $this->porcDesc = $porcDesc;

        return $this;
    }

    public function getTipoPrecio(): ?string
    {
        return $this->tipoPrecio;
    }

    public function setTipoPrecio(string $tipoPrecio): self
    {
        $this->tipoPrecio = $tipoPrecio;

        return $this;
    }

    public function getTipoPrecioCount(): ?int
    {
        return $this->tipoPrecioCount;
    }

    public function setTipoPrecioCount(int $tipoPrecioCount): self
    {
        $this->tipoPrecioCount = $tipoPrecioCount;

        return $this;
    }

    public function getMaxDescuento(): ?float
    {
        return $this->maxDescuento;
    }

    public function setMaxDescuento(float $maxDescuento): self
    {
        $this->maxDescuento = $maxDescuento;

        return $this;
    }

    public function getMinPrecio(): ?int
    {
        return $this->minPrecio;
    }

    public function setMinPrecio(int $minPrecio): self
    {
        $this->minPrecio = $minPrecio;

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

    public function getFulfillment(): ?int
    {
        return $this->fulfillment;
    }

    public function setFulfillment(int $fulfillment): self
    {
        $this->fulfillment = $fulfillment;

        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

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

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        $this->market = $market;

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

    public function getTotalDisponible(): ?int
    {
        return $this->totalDisponible;
    }

    public function setTotalDisponible(?int $totalDisponible): self
    {
        $this->totalDisponible = $totalDisponible;

        return $this;
    }
}
