<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\FichaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Ficha
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idMarket;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $modelo;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $alto;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $ancho;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $largo;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $peso;

    #[ORM\Column(type: 'boolean')]
    private $despacho = false;

    #[ORM\Column(type: 'boolean')]
    private $retiro = false;

    #[ORM\Column(type: 'boolean')]
    private $entregaInmediata = false;

    #[ORM\Column(type: 'text', nullable: true)]
    private $politicas;

    #[ORM\Column(type: 'text', nullable: true)]
    private $garantia;

    #[ORM\OneToOne(targetEntity: 'Actividad', inversedBy: 'ficha')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Marca', inversedBy: 'fichas')]
    protected $marca;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Sucursal', inversedBy: 'fichas')]
    protected $sucursales;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Bodega', inversedBy: 'fichas')]
    protected $bodegas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Producto', mappedBy: 'ficha')]
    protected $productos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\FichaAtributo', mappedBy: 'ficha')]
    protected $fichaAtributos;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getSla()
    {
        $slaMinimo = NULL;
        foreach ($this->getProductos() as $producto) {
            foreach ($producto->getBodegaStocks() as $bodegaStock) {
                $bodega = $bodegaStock->getBodega();
                $sucursal = $bodegaStock->getSucursal();
                $sla = $bodega ? $bodega->getSla() : $sucursal->getSla();
                if ($sla > 0 && (!$slaMinimo || $sla < $slaMinimo)) {
                    $slaMinimo = $sla;
                }
            }
        }

        return $slaMinimo;
    }

    public function __construct()
    {
        $this->productos = new ArrayCollection();
        $this->fichaAtributos = new ArrayCollection();
        $this->sucursales = new ArrayCollection();
        $this->bodegas = new ArrayCollection();
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

    public function getActividad(): ?Actividad
    {
        return $this->actividad;
    }

    public function setActividad(?Actividad $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }

//      * @return Collection|Producto[]
     
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setFicha($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->contains($producto)) {
            $this->productos->removeElement($producto);
            // set the owning side to null (unless already changed)
            if ($producto->getFicha() === $this) {
                $producto->setFicha(null);
            }
        }

        return $this;
    }

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(?string $modelo): self
    {
        $this->modelo = $modelo;

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

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getDespacho(): ?bool
    {
        return $this->despacho;
    }

    public function setDespacho(bool $despacho): self
    {
        $this->despacho = $despacho;

        return $this;
    }

    public function getRetiro(): ?bool
    {
        return $this->retiro;
    }

    public function setRetiro(bool $retiro): self
    {
        $this->retiro = $retiro;

        return $this;
    }

    public function getPoliticas(): ?string
    {
        return $this->politicas;
    }

    public function setPoliticas(?string $politicas): self
    {
        $this->politicas = $politicas;

        return $this;
    }

    public function getGarantia(): ?string
    {
        return $this->garantia;
    }

    public function setGarantia(?string $garantia): self
    {
        $this->garantia = $garantia;

        return $this;
    }

//      * @return Collection|FichaAtributo[]

    public function getFichaAtributos(): Collection
    {
        return $this->fichaAtributos;
    }

    public function addFichaAtributo(FichaAtributo $fichaAtributo): self
    {
        if (!$this->fichaAtributos->contains($fichaAtributo)) {
            $this->fichaAtributos[] = $fichaAtributo;
            $fichaAtributo->setFicha($this);
        }

        return $this;
    }

    public function removeFichaAtributo(FichaAtributo $fichaAtributo): self
    {
        if ($this->fichaAtributos->contains($fichaAtributo)) {
            $this->fichaAtributos->removeElement($fichaAtributo);
            // set the owning side to null (unless already changed)
            if ($fichaAtributo->getFicha() === $this) {
                $fichaAtributo->setFicha(null);
            }
        }

        return $this;
    }

//      * @return Collection|Sucursal[]

    public function getSucursales(): Collection
    {
        return $this->sucursales;
    }

    public function addSucursale(Sucursal $sucursale): self
    {
        if (!$this->sucursales->contains($sucursale)) {
            $this->sucursales[] = $sucursale;
        }

        return $this;
    }

    public function removeSucursale(Sucursal $sucursale): self
    {
        if ($this->sucursales->contains($sucursale)) {
            $this->sucursales->removeElement($sucursale);
        }

        return $this;
    }

//      * @return Collection|Bodega[]

    public function getBodegas(): Collection
    {
        return $this->bodegas;
    }

    public function addBodega(Bodega $bodega): self
    {
        if (!$this->bodegas->contains($bodega)) {
            $this->bodegas[] = $bodega;
        }

        return $this;
    }

    public function removeBodega(Bodega $bodega): self
    {
        if ($this->bodegas->contains($bodega)) {
            $this->bodegas->removeElement($bodega);
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

    public function getEntregaInmediata(): ?bool
    {
        return $this->entregaInmediata;
    }

    public function setEntregaInmediata(bool $entregaInmediata): self
    {
        $this->entregaInmediata = $entregaInmediata;

        return $this;
    }
}
