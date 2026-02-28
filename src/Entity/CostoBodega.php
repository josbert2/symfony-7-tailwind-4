<?php

namespace App\Entity;

use App\Repository\CostoBodegaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: CostoBodegaRepository::class)]
class CostoBodega
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'costoBodegas', targetEntity: Bodega::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $bodega;

    #[ORM\Column(type: 'float')]
    private $total_uf;

    #[ORM\Column(type: 'float')]
    private $uf;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'float')]
    private $volumen;

    #[ORM\Column(type: 'integer')]
    private $cantidadUnidadesRecepcionadas;

    #[ORM\Column(type: 'integer')]
    private $cantidadUnidadesPreparadas;

    #[ORM\Column(type: 'integer')]
    private $cantidadOrdenesPreparadas;

    #[ORM\Column(type: 'float')]
    private $tramo;

    #[ORM\Column(type: 'integer')]
    private $stock;

    #[ORM\ManyToOne(inversedBy: 'costoBodegas', targetEntity: Producto::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $producto;

    #[ORM\Column(type: 'float')]
    private $mesesInventario;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotalUf(): ?float
    {
        return $this->total_uf;
    }

    public function setTotalUf(float $total_uf): self
    {
        $this->total_uf = $total_uf;

        return $this;
    }

    public function getUf(): ?float
    {
        return $this->uf;
    }

    public function setUf(float $uf): self
    {
        $this->uf = $uf;

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

    public function getVolumen(): ?float
    {
        return $this->volumen;
    }

    public function setVolumen(float $volumen): self
    {
        $this->volumen = $volumen;

        return $this;
    }

    public function getCantidadUnidadesRecepcionadas(): ?int
    {
        return $this->cantidadUnidadesRecepcionadas;
    }

    public function setCantidadUnidadesRecepcionadas(int $cantidadUnidadesRecepcionadas): self
    {
        $this->cantidadUnidadesRecepcionadas = $cantidadUnidadesRecepcionadas;

        return $this;
    }

    public function getCantidadUnidadesPreparadas(): ?int
    {
        return $this->cantidadUnidadesPreparadas;
    }

    public function setCantidadUnidadesPreparadas(int $cantidadUnidadesPreparadas): self
    {
        $this->cantidadUnidadesPreparadas = $cantidadUnidadesPreparadas;

        return $this;
    }

    public function getCantidadOrdenesPreparadas(): ?int
    {
        return $this->cantidadOrdenesPreparadas;
    }

    public function setCantidadOrdenesPreparadas(int $cantidadOrdenesPreparadas): self
    {
        $this->cantidadOrdenesPreparadas = $cantidadOrdenesPreparadas;

        return $this;
    }

    public function getTramo(): ?float
    {
        return $this->tramo;
    }

    public function setTramo(float $tramo): self
    {
        $this->tramo = $tramo;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getMesesInventario(): ?float
    {
        return $this->mesesInventario;
    }

    public function setMesesInventario(float $mesesInventario): self
    {
        $this->mesesInventario = $mesesInventario;

        return $this;
    }
}
