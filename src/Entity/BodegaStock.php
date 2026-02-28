<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\BodegaStockRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @ORM\HasLifecycleCallbacks
//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="idx_disponible", columns={"disponible")
//  * )

class BodegaStock
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $entradas = 0;

    #[ORM\Column(type: 'integer')]
    private $disponible = 0;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Bodega', inversedBy: 'bodegaStocks')]
    protected $bodega;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Sucursal', inversedBy: 'bodegaStocks')]
    protected $sucursal;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Producto', inversedBy: 'bodegaStocks')]
    protected $producto;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getCodigo()
    {
        if ($this->getBodega()) {
            $codigo = 'bod' . $this->getBodega()->getCodigoFulfillmentId();
        } else {
            $codigo = 'suc' . $this->getSucursal()->getId();
        }

        return $codigo;
    }

//      * @ORM\PrePersist
//      * @ORM\PreUpdate

    public function setData()
    {
//        $this->setDisponible($this->getCupos() - $this->getEntradas());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCupos(): ?int
    {
        return $this->cupos;
    }

    public function setCupos(int $cupos): self
    {
        $this->cupos = $cupos;

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

    public function getDisponible(): ?int
    {
        return $this->disponible;
    }

    public function setDisponible(int $disponible): self
    {
        $this->disponible = $disponible;

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

    public function getSucursal(): ?Sucursal
    {
        return $this->sucursal;
    }

    public function setSucursal(?Sucursal $sucursal): self
    {
        $this->sucursal = $sucursal;

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


}
