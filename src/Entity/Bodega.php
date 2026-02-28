<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\BodegaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="idx_sla", columns={"sla")
//  * )

class Bodega
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoFulfillment;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;

    #[ORM\Column(type: 'integer')]
    private $sla = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idSeller;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $multivendeId;

    #[ORM\Column(type: 'boolean')]
    private $multivendeSync = false;

    #[ORM\Column(type: 'boolean')]
    private $fulfillment = false;

    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\OneToOne(targetEntity: 'Direccion', inversedBy: 'bodega')]
    protected $direccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'bodegas')]
    protected $proveedor;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Envio', mappedBy: 'bodega')]
    protected $envios;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Paquete', mappedBy: 'bodega')]
    protected $paquetes;

    #[ORM\OneToMany(targetEntity: 'App\Entity\BodegaStock', mappedBy: 'bodega')]
    protected $bodegaStocks;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Ficha', mappedBy: 'bodegas')]
    protected $fichas;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'bodega', targetEntity: StockDia::class)]
    private $stockDias;

    #[ORM\OneToMany(mappedBy: 'bodega', targetEntity: CostoBodega::class)]
    private $costoBodegas;

    #[ORM\ManyToOne(inversedBy: 'bodegas', targetEntity: Staff::class)]
    private $encargado;

    public function __construct()
    {
        $this->fichas = new ArrayCollection();
        $this->envios = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
        $this->bodegaStocks = new ArrayCollection();
        $this->stockDias = new ArrayCollection();
        $this->costoBodegas = new ArrayCollection();
    }

    public function getCodigo(): ?string
    {
        return 'BOD' . sprintf("%07d", $this->id);
//        return $this->codigo;
    }

    public function getCodigoFulfillmentId(): ?string
    {
        return $this->getCodigoFulfillment() ?: $this->getId();
    }

    public function getNombreFulfillment(): ?string
    {
        return $this->getCodigoFulfillment() ? 'Fulfillment ' . $this->getCodigoFulfillment() : $this->getNombre();
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

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

    public function getDireccion(): ?Direccion
    {
        return $this->direccion;
    }

    public function setDireccion(?Direccion $direccion): self
    {
        $this->direccion = $direccion;

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

//      * @return Collection|Ficha[]
     
    public function getFichas(): Collection
    {
        return $this->fichas;
    }

    public function addFicha(Ficha $ficha): self
    {
        if (!$this->fichas->contains($ficha)) {
            $this->fichas[] = $ficha;
            $ficha->addBodega($this);
        }

        return $this;
    }

    public function removeFicha(Ficha $ficha): self
    {
        if ($this->fichas->contains($ficha)) {
            $this->fichas->removeElement($ficha);
            $ficha->removeBodega($this);
        }

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

//      * @return Collection|Envio[]

    public function getEnvios(): Collection
    {
        return $this->envios;
    }

    public function addEnvio(Envio $envio): self
    {
        if (!$this->envios->contains($envio)) {
            $this->envios[] = $envio;
            $envio->setBodega($this);
        }

        return $this;
    }

    public function removeEnvio(Envio $envio): self
    {
        if ($this->envios->contains($envio)) {
            $this->envios->removeElement($envio);
            // set the owning side to null (unless already changed)
            if ($envio->getBodega() === $this) {
                $envio->setBodega(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|Paquete[]

    public function getPaquetes(): Collection
    {
        return $this->paquetes;
    }

    public function addPaquete(Paquete $paquete): self
    {
        if (!$this->paquetes->contains($paquete)) {
            $this->paquetes[] = $paquete;
            $paquete->setBodega($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getBodega() === $this) {
                $paquete->setBodega(NULL);
            }
        }

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

    public function getMultivendeId(): ?string
    {
        return $this->multivendeId;
    }

    public function setMultivendeId(?string $multivendeId): self
    {
        $this->multivendeId = $multivendeId;

        return $this;
    }

    public function getMultivendeSync(): ?bool
    {
        return $this->multivendeSync;
    }

    public function setMultivendeSync(bool $multivendeSync): self
    {
        $this->multivendeSync = $multivendeSync;

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
            $bodegaStock->setBodega($this);
        }

        return $this;
    }

    public function removeBodegaStock(BodegaStock $bodegaStock): self
    {
        if ($this->bodegaStocks->removeElement($bodegaStock)) {
            // set the owning side to null (unless already changed)
            if ($bodegaStock->getBodega() === $this) {
                $bodegaStock->setBodega(NULL);
            }
        }

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

    public function getCodigoFulfillment(): ?string
    {
        return $this->codigoFulfillment;
    }

    public function setCodigoFulfillment(?string $codigoFulfillment): self
    {
        $this->codigoFulfillment = $codigoFulfillment;

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
            $stockDia->setBodega($this);
        }

        return $this;
    }

    public function removeStockDia(StockDia $stockDia): self
    {
        if ($this->stockDias->removeElement($stockDia)) {
            // set the owning side to null (unless already changed)
            if ($stockDia->getBodega() === $this) {
                $stockDia->setBodega(null);
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
            $costoBodega->setBodega($this);
        }

        return $this;
    }

    public function removeCostoBodega(CostoBodega $costoBodega): self
    {
        if ($this->costoBodegas->removeElement($costoBodega)) {
            // set the owning side to null (unless already changed)
            if ($costoBodega->getBodega() === $this) {
                $costoBodega->setBodega(null);
            }
        }

        return $this;
    }

    public function getEncargado(): ?Staff
    {
        return $this->encargado;
    }

    public function setEncargado(?Staff $encargado): self
    {
        $this->encargado = $encargado;

        return $this;
    }


}
