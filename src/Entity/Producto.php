<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Table(name: 'sku')])
    #[ORM\Entity(repositoryClass: App\Repository\ProductoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Producto
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idMarket;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ean;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sku;

    #[ORM\Column(type: 'integer')]
    private $costo = 0;

    #[ORM\Column(type: 'boolean')]
    private $fulfillment = false;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Ficha', inversedBy: 'productos')]
    protected $ficha;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ActividadTipoPrecio', inversedBy: 'producto')]
    protected $tipoPrecio;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ProductoAtributo', mappedBy: 'producto')]
    protected $productoAtributos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\BodegaStock', mappedBy: 'producto')]
    protected $bodegaStocks;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: StockDia::class)]
    private $stockDias;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: CostoBodega::class)]
    private $costoBodegas;

    public function __construct()
    {
        $this->productoAtributos = new ArrayCollection();
        $this->bodegaStocks = new ArrayCollection();
        $this->stockDias = new ArrayCollection();
        $this->costoBodegas = new ArrayCollection();
    }

    public function setCosto(?int $costo): self
    {
        if (is_null($costo)) {
            $costo = 0;
        }

        $this->costo = $costo;

        return $this;
    }

//    public function getFulfillment()
//    {
//        $fulfillment = false;
//
//        foreach ($this->getFicha()->getBodegas() as $bodega) {
//            if ($bodega->getFulfillment()) {
//                $fulfillment = true;
//                break;
//            }
//        }
//
//        return $fulfillment;
//    }

    public function getSkuFulfillment()
    {
        return 'FF' . sprintf("%08d", $this->getTipoPrecio() ? $this->getTipoPrecio()->getId() : $this->getId());
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFicha(): ?Ficha
    {
        return $this->ficha;
    }

    public function setFicha(?Ficha $ficha): self
    {
        $this->ficha = $ficha;

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

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getCosto(): ?int
    {
        return $this->costo;
    }

//      * @return Collection|ProductoAtributo[]
     
    public function getProductoAtributos(): Collection
    {
        return $this->productoAtributos;
    }

    public function addProductoAtributo(ProductoAtributo $productoAtributo): self
    {
        if (!$this->productoAtributos->contains($productoAtributo)) {
            $this->productoAtributos[] = $productoAtributo;
            $productoAtributo->setProducto($this);
        }

        return $this;
    }

    public function removeProductoAtributo(ProductoAtributo $productoAtributo): self
    {
        if ($this->productoAtributos->contains($productoAtributo)) {
            $this->productoAtributos->removeElement($productoAtributo);
            // set the owning side to null (unless already changed)
            if ($productoAtributo->getProducto() === $this) {
                $productoAtributo->setProducto(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|BodegaStock[]

    public function getBodegaStocks(): Collection
    {
        return $this->bodegaStocks;
    }

    public function addBodegaStock(BodegaStock $bodegaStock): self
    {
        if (!$this->bodegaStocks->contains($bodegaStock)) {
            $this->bodegaStocks[] = $bodegaStock;
            $bodegaStock->setProducto($this);
        }

        return $this;
    }

    public function removeBodegaStock(BodegaStock $bodegaStock): self
    {
        if ($this->bodegaStocks->removeElement($bodegaStock)) {
            // set the owning side to null (unless already changed)
            if ($bodegaStock->getProducto() === $this) {
                $bodegaStock->setProducto(NULL);
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

    public function getFulfillment(): ?bool
    {
        return $this->fulfillment;
    }

    public function setFulfillment(bool $fulfillment): self
    {
        $this->fulfillment = $fulfillment;

        return $this;
    }

//      * @return Collection|StockDia[]

    public function getStockDias(): Collection
    {
        return $this->stockDias;
    }

    public function addStockDia(StockDia $stockDia): self
    {
        if (!$this->stockDias->contains($stockDia)) {
            $this->stockDias[] = $stockDia;
            $stockDia->setProducto($this);
        }

        return $this;
    }

    public function removeStockDia(StockDia $stockDia): self
    {
        if ($this->stockDias->removeElement($stockDia)) {
            // set the owning side to null (unless already changed)
            if ($stockDia->getProducto() === $this) {
                $stockDia->setProducto(null);
            }
        }

        return $this;
    }

//      * @return Collection|CostoBodega[]

    public function getCostoBodegas(): Collection
    {
        return $this->costoBodegas;
    }

    public function addCostoBodega(CostoBodega $costoBodega): self
    {
        if (!$this->costoBodegas->contains($costoBodega)) {
            $this->costoBodegas[] = $costoBodega;
            $costoBodega->setProducto($this);
        }

        return $this;
    }

    public function removeCostoBodega(CostoBodega $costoBodega): self
    {
        if ($this->costoBodegas->removeElement($costoBodega)) {
            // set the owning side to null (unless already changed)
            if ($costoBodega->getProducto() === $this) {
                $costoBodega->setProducto(null);
            }
        }

        return $this;
    }
}
