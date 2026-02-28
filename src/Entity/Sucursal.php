<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\SucursalRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Sucursal
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sla = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idSeller;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $multivendeId;

    #[ORM\Column(type: 'boolean')]
    private $multivendeSync = false;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $bsaleOfficeId = null;

    #[ORM\OneToOne(targetEntity: 'Direccion', inversedBy: 'sucursal')]
    protected $direccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'sucursales')]
    protected $proveedor;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Caja', mappedBy: 'sucursal')]
    protected $cajas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Envio', mappedBy: 'sucursal')]
    protected $envios;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Paquete', mappedBy: 'sucursal')]
    protected $paquetes;

    #[ORM\OneToMany(targetEntity: 'App\Entity\BodegaStock', mappedBy: 'sucursal')]
    protected $bodegaStocks;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Staff', mappedBy: 'sucursal')]
    protected $staffs;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Ficha', mappedBy: 'sucursales')]
    protected $fichas;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getCodigo(): ?string
    {
        return 'TIE'.sprintf("%07d", $this->id);
//        return $this->codigo;
    }

    public function __toString() {
        return $this->getNombre();
    }

    public function __construct()
    {
        $this->cajas = new ArrayCollection();
        $this->fichas = new ArrayCollection();
        $this->envios = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
        $this->bodegaStocks = new ArrayCollection();
        $this->staffs = new ArrayCollection();
    }

    public function setSla(?int $sla): self
    {
        $this->sla = $sla;

        return $this;
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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * @return Collection|Caja[]
     
    public function getCajas(): Collection
    {
        return $this->cajas;
    }

    public function addCaja(Caja $caja): self
    {
        if (!$this->cajas->contains($caja)) {
            $this->cajas[] = $caja;
            $caja->setSucursal($this);
        }

        return $this;
    }

    public function removeCaja(Caja $caja): self
    {
        if ($this->cajas->contains($caja)) {
            $this->cajas->removeElement($caja);
            // set the owning side to null (unless already changed)
            if ($caja->getSucursal() === $this) {
                $caja->setSucursal(null);
            }
        }

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

    public function getDireccion(): ?Direccion
    {
        return $this->direccion;
    }

    public function setDireccion(?Direccion $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

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
            $ficha->addSucursale($this);
        }

        return $this;
    }

    public function removeFicha(Ficha $ficha): self
    {
        if ($this->fichas->contains($ficha)) {
            $this->fichas->removeElement($ficha);
            $ficha->removeSucursale($this);
        }

        return $this;
    }

    public function getSla(): ?int
    {
        return $this->sla;
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
            $envio->setSucursal($this);
        }

        return $this;
    }

    public function removeEnvio(Envio $envio): self
    {
        if ($this->envios->contains($envio)) {
            $this->envios->removeElement($envio);
            // set the owning side to null (unless already changed)
            if ($envio->getSucursal() === $this) {
                $envio->setSucursal(null);
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

//      * @return Collection|Paquete[]

    public function getPaquetes(): Collection
    {
        return $this->paquetes;
    }

    public function addPaquete(Paquete $paquete): self
    {
        if (!$this->paquetes->contains($paquete)) {
            $this->paquetes[] = $paquete;
            $paquete->setSucursal($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getSucursal() === $this) {
                $paquete->setSucursal(null);
            }
        }

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
            $bodegaStock->setSucursal($this);
        }

        return $this;
    }

    public function removeBodegaStock(BodegaStock $bodegaStock): self
    {
        if ($this->bodegaStocks->removeElement($bodegaStock)) {
            // set the owning side to null (unless already changed)
            if ($bodegaStock->getSucursal() === $this) {
                $bodegaStock->setSucursal(null);
            }
        }

        return $this;
    }

//      * @return Collection|Staff[]

    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function addStaff(Staff $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
            $staff->setSucursal($this);
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        if ($this->staffs->removeElement($staff)) {
            // set the owning side to null (unless already changed)
            if ($staff->getSucursal() === $this) {
                $staff->setSucursal(null);
            }
        }

        return $this;
    }

    public function getBsaleOfficeId(): ?int
    {
        return $this->bsaleOfficeId;
    }

    public function setBsaleOfficeId(?int $bsaleOfficeId): self
    {
        $this->bsaleOfficeId = $bsaleOfficeId;

        return $this;
    }

}
