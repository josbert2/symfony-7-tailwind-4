<?php

namespace App\Entity;

use App\Repository\EstadisticaVentaSixtoRepository;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: EstadisticaVentaSixtoRepository::class)]
class EstadisticaVentaSixto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cantidadTransacciones;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $anno;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $AnnoMesDia;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $dia;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $ventaReal;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria3;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $categoria1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreActividad;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreProveedor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreMarca;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $idCliente;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreComuna;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cantidadEntradasCanceladas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $montoEntradasCanceladas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cantidadPaqueteCanceladas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $montoPaquetesCanceladas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cantidadCortesias;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $montoCortesias;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cantidadVendida;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidadTransacciones(): ?int
    {
        return $this->cantidadTransacciones;
    }

    public function setCantidadTransacciones(?int $cantidadTransacciones): self
    {
        $this->cantidadTransacciones = $cantidadTransacciones;

        return $this;
    }

    public function getAnno(): ?string
    {
        return $this->anno;
    }

    public function setAnno(?string $anno): self
    {
        $this->anno = $anno;

        return $this;
    }

    public function getMes(): ?string
    {
        return $this->mes;
    }

    public function setMes(?string $mes): self
    {
        $this->mes = $mes;

        return $this;
    }

    public function getAnnoMesDia(): ?string
    {
        return $this->AnnoMesDia;
    }

    public function setAnnoMesDia(?string $AnnoMesDia): self
    {
        $this->AnnoMesDia = $AnnoMesDia;

        return $this;
    }

    public function getDia(): ?string
    {
        return $this->dia;
    }

    public function setDia(?string $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getVentaReal(): ?int
    {
        return $this->ventaReal;
    }

    public function setVentaReal(?int $ventaReal): self
    {
        $this->ventaReal = $ventaReal;

        return $this;
    }

    public function getCategoria0(): ?string
    {
        return $this->categoria0;
    }

    public function setCategoria0(?string $categoria0): self
    {
        $this->categoria0 = $categoria0;

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

    public function getCategoria2(): ?string
    {
        return $this->categoria2;
    }

    public function setCategoria2(?string $categoria2): self
    {
        $this->categoria2 = $categoria2;

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

    public function getNombreActividad(): ?string
    {
        return $this->nombreActividad;
    }

    public function setNombreActividad(?string $nombreActividad): self
    {
        $this->nombreActividad = $nombreActividad;

        return $this;
    }

    public function getNombreProveedor(): ?string
    {
        return $this->nombreProveedor;
    }

    public function setNombreProveedor(?string $nombreProveedor): self
    {
        $this->nombreProveedor = $nombreProveedor;

        return $this;
    }

    public function getNombreMarca(): ?string
    {
        return $this->nombreMarca;
    }

    public function setNombreMarca(?string $nombreMarca): self
    {
        $this->nombreMarca = $nombreMarca;

        return $this;
    }

    public function getIdCliente(): ?int
    {
        return $this->idCliente;
    }

    public function setIdCliente(?int $idCliente): self
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    public function getNombreComuna(): ?string
    {
        return $this->nombreComuna;
    }

    public function setNombreComuna(?string $nombreComuna): self
    {
        $this->nombreComuna = $nombreComuna;

        return $this;
    }

    public function getCantidadEntradasCanceladas(): ?int
    {
        return $this->cantidadEntradasCanceladas;
    }

    public function setCantidadEntradasCanceladas(?int $cantidadEntradasCanceladas): self
    {
        $this->cantidadEntradasCanceladas = $cantidadEntradasCanceladas;

        return $this;
    }

    public function getMontoEntradasCanceladas(): ?int
    {
        return $this->montoEntradasCanceladas;
    }

    public function setMontoEntradasCanceladas(?int $montoEntradasCanceladas): self
    {
        $this->montoEntradasCanceladas = $montoEntradasCanceladas;

        return $this;
    }

    public function getCantidadPaqueteCanceladas(): ?int
    {
        return $this->cantidadPaqueteCanceladas;
    }

    public function setCantidadPaqueteCanceladas(?int $cantidadPaqueteCanceladas): self
    {
        $this->cantidadPaqueteCanceladas = $cantidadPaqueteCanceladas;

        return $this;
    }

    public function getMontoPaquetesCanceladas(): ?int
    {
        return $this->montoPaquetesCanceladas;
    }

    public function setMontoPaquetesCanceladas(?int $montoPaquetesCanceladas): self
    {
        $this->montoPaquetesCanceladas = $montoPaquetesCanceladas;

        return $this;
    }

    public function getCantidadCortesias(): ?int
    {
        return $this->cantidadCortesias;
    }

    public function setCantidadCortesias(?int $cantidadCortesias): self
    {
        $this->cantidadCortesias = $cantidadCortesias;

        return $this;
    }

    public function getMontoCortesias(): ?int
    {
        return $this->montoCortesias;
    }

    public function setMontoCortesias(?int $montoCortesias): self
    {
        $this->montoCortesias = $montoCortesias;

        return $this;
    }

    public function getCantidadVendida(): ?int
    {
        return $this->cantidadVendida;
    }

    public function setCantidadVendida(?int $cantidadVendida): self
    {
        $this->cantidadVendida = $cantidadVendida;

        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
}
