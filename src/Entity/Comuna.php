<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ComunaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Comuna
{
    #[ORM\Id]
    #[ORM\GeneratedValue]()
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Region', inversedBy: 'comunas')]
    protected $region;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Direccion', mappedBy: 'comuna')]
    protected $direcciones;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Tarifa', mappedBy: 'comunaOrigen')]
    protected $tarifasOrigen;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Tarifa', mappedBy: 'comunaDestino')]
    protected $tarifasDestino;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Promocion', mappedBy: 'comunas')]
    protected $promociones;

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
        $this->direcciones = new ArrayCollection();
        $this->tarifasOrigen = new ArrayCollection();
        $this->tarifasDestino = new ArrayCollection();
        $this->promociones = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombre;
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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

//      * @return Collection|Direccion[]
     
    public function getDirecciones(): Collection
    {
        return $this->direcciones;
    }

    public function addDireccione(Direccion $direccione): self
    {
        if (!$this->direcciones->contains($direccione)) {
            $this->direcciones[] = $direccione;
            $direccione->setComuna($this);
        }

        return $this;
    }

    public function removeDireccione(Direccion $direccione): self
    {
        if ($this->direcciones->contains($direccione)) {
            $this->direcciones->removeElement($direccione);
            // set the owning side to null (unless already changed)
            if ($direccione->getComuna() === $this) {
                $direccione->setComuna(null);
            }
        }

        return $this;
    }

//      * @return Collection|Tarifa[]

    public function getTarifasOrigen(): Collection
    {
        return $this->tarifasOrigen;
    }

    public function addTarifasOrigen(Tarifa $tarifasOrigen): self
    {
        if (!$this->tarifasOrigen->contains($tarifasOrigen)) {
            $this->tarifasOrigen[] = $tarifasOrigen;
            $tarifasOrigen->setComunaOrigen($this);
        }

        return $this;
    }

    public function removeTarifasOrigen(Tarifa $tarifasOrigen): self
    {
        if ($this->tarifasOrigen->removeElement($tarifasOrigen)) {
            // set the owning side to null (unless already changed)
            if ($tarifasOrigen->getComunaOrigen() === $this) {
                $tarifasOrigen->setComunaOrigen(null);
            }
        }

        return $this;
    }

//      * @return Collection|Tarifa[]

    public function getTarifasDestino(): Collection
    {
        return $this->tarifasDestino;
    }

    public function addTarifasDestino(Tarifa $tarifasDestino): self
    {
        if (!$this->tarifasDestino->contains($tarifasDestino)) {
            $this->tarifasDestino[] = $tarifasDestino;
            $tarifasDestino->setComunaDestino($this);
        }

        return $this;
    }

    public function removeTarifasDestino(Tarifa $tarifasDestino): self
    {
        if ($this->tarifasDestino->removeElement($tarifasDestino)) {
            // set the owning side to null (unless already changed)
            if ($tarifasDestino->getComunaDestino() === $this) {
                $tarifasDestino->setComunaDestino(null);
            }
        }

        return $this;
    }

//      * @return Collection|Promocion[]

    public function getPromociones(): Collection
    {
        return $this->promociones;
    }

    public function addPromocione(Promocion $promocione): self
    {
        if (!$this->promociones->contains($promocione)) {
            $this->promociones[] = $promocione;
            $promocione->addComuna($this);
        }

        return $this;
    }

    public function removePromocione(Promocion $promocione): self
    {
        if ($this->promociones->removeElement($promocione)) {
            $promocione->removeComuna($this);
        }

        return $this;
    }

}
