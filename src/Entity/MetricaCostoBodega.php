<?php

namespace App\Entity;

use App\Repository\MetricaCostoBodegaRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: MetricaCostoBodegaRepository::class)]
class MetricaCostoBodega
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: Bodega::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $bodega;

    #[ORM\Column(type: 'float')]
    private $costoRecepcionUnidad;

    #[ORM\Column(type: 'float', nullable: true)]
    private $valorFijoUF;

    #[ORM\Column(type: 'float')]
    private $costoPreparacionPedido;

    #[ORM\Column(type: 'float')]
    private $costoPreparacionUnidad;

    #[ORM\Column(type: 'float')]
    private $costoTramoAlmacenamientoHasta2Meses;

    #[ORM\Column(type: 'float')]
    private $costoTramoAlmacenamiento3Meses;

    #[ORM\Column(type: 'float')]
    private $costoTramoAlmacenamientoDesde4Meses;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'float')]
    private $etiqueta;

    #[ORM\Column(type: 'float')]
    private $logisticaInversa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBodega(): ?Bodega
    {
        return $this->bodega;
    }

    public function setBodega(Bodega $bodega): self
    {
        $this->bodega = $bodega;

        return $this;
    }

    public function getCostoRecepcionUnidad(): ?float
    {
        return $this->costoRecepcionUnidad;
    }

    public function setCostoRecepcionUnidad(float $costoRecepcionUnidad): self
    {
        $this->costoRecepcionUnidad = $costoRecepcionUnidad;

        return $this;
    }

    public function getValorFijoUF(): ?float
    {
        return $this->valorFijoUF;
    }

    public function setValorFijoUF(?float $valorFijoUF): self
    {
        $this->valorFijoUF = $valorFijoUF;

        return $this;
    }

    public function getCostoPreparacionPedido(): ?float
    {
        return $this->costoPreparacionPedido;
    }

    public function setCostoPreparacionPedido(float $costoPreparacionPedido): self
    {
        $this->costoPreparacionPedido = $costoPreparacionPedido;

        return $this;
    }

    public function getCostoPreparacionUnidad(): ?float
    {
        return $this->costoPreparacionUnidad;
    }

    public function setCostoPreparacionUnidad(float $costoPreparacionUnidad): self
    {
        $this->costoPreparacionUnidad = $costoPreparacionUnidad;

        return $this;
    }

    public function getCostoTramoAlmacenamientoHasta2Meses(): ?float
    {
        return $this->costoTramoAlmacenamientoHasta2Meses;
    }

    public function setCostoTramoAlmacenamientoHasta2Meses(float $costoTramoAlmacenamientoHasta2Meses): self
    {
        $this->costoTramoAlmacenamientoHasta2Meses = $costoTramoAlmacenamientoHasta2Meses;

        return $this;
    }

    public function getCostoTramoAlmacenamiento3Meses(): ?float
    {
        return $this->costoTramoAlmacenamiento3Meses;
    }

    public function setCostoTramoAlmacenamiento3Meses(float $costoTramoAlmacenamiento3Meses): self
    {
        $this->costoTramoAlmacenamiento3Meses = $costoTramoAlmacenamiento3Meses;

        return $this;
    }

    public function getCostoTramoAlmacenamientoDesde4Meses(): ?float
    {
        return $this->costoTramoAlmacenamientoDesde4Meses;
    }

    public function setCostoTramoAlmacenamientoDesde4Meses(float $costoTramoAlmacenamientoDesde4Meses): self
    {
        $this->costoTramoAlmacenamientoDesde4Meses = $costoTramoAlmacenamientoDesde4Meses;

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

    public function getEtiqueta(): ?float
    {
        return $this->etiqueta;
    }

    public function setEtiqueta(float $etiqueta): self
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    public function getLogisticaInversa(): ?float
    {
        return $this->logisticaInversa;
    }

    public function setLogisticaInversa(float $logisticaInversa): self
    {
        $this->logisticaInversa = $logisticaInversa;

        return $this;
    }
}
