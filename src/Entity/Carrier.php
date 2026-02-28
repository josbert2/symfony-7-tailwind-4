<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\CarrierRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Carrier
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigo;

    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Envio', mappedBy: 'carrier')]
    protected $envios;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Paquete', mappedBy: 'carrier')]
    protected $paquetes;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Proveedor', mappedBy: 'carrierDefault')]
    protected $proveedoresDefault;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Proveedor', mappedBy: 'carriers')]
    protected $proveedores;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __construct()
    {
        $this->envios = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
        $this->proveedores = new ArrayCollection();
        $this->proveedoresDefault = new ArrayCollection();
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

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

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

//      * @return Collection|Envio[]
     
    public function getEnvios(): Collection
    {
        return $this->envios;
    }

    public function addEnvio(Envio $envio): self
    {
        if (!$this->envios->contains($envio)) {
            $this->envios[] = $envio;
            $envio->setCarrier($this);
        }

        return $this;
    }

    public function removeEnvio(Envio $envio): self
    {
        if ($this->envios->contains($envio)) {
            $this->envios->removeElement($envio);
            // set the owning side to null (unless already changed)
            if ($envio->getCarrier() === $this) {
                $envio->setCarrier(null);
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
            $paquete->setCarrier($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getCarrier() === $this) {
                $paquete->setCarrier(null);
            }
        }

        return $this;
    }

//      * @return Collection|Proveedor[]

    public function getProveedores(): Collection
    {
        return $this->proveedores;
    }

    public function addProveedore(Proveedor $proveedore): self
    {
        if (!$this->proveedores->contains($proveedore)) {
            $this->proveedores[] = $proveedore;
            $proveedore->addCarrier($this);
        }

        return $this;
    }

    public function removeProveedore(Proveedor $proveedore): self
    {
        if ($this->proveedores->contains($proveedore)) {
            $this->proveedores->removeElement($proveedore);
            $proveedore->removeCarrier($this);
        }

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

//      * @return Collection|Proveedor[]

    public function getProveedoresDefault(): Collection
    {
        return $this->proveedoresDefault;
    }

    public function addProveedoresDefault(Proveedor $proveedoresDefault): self
    {
        if (!$this->proveedoresDefault->contains($proveedoresDefault)) {
            $this->proveedoresDefault[] = $proveedoresDefault;
            $proveedoresDefault->setCarrierDefault($this);
        }

        return $this;
    }

    public function removeProveedoresDefault(Proveedor $proveedoresDefault): self
    {
        if ($this->proveedoresDefault->removeElement($proveedoresDefault)) {
            // set the owning side to null (unless already changed)
            if ($proveedoresDefault->getCarrierDefault() === $this) {
                $proveedoresDefault->setCarrierDefault(null);
            }
        }

        return $this;
    }

}
