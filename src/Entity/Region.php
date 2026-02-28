<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\RegionRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]()
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $ordinal;

    #[ORM\Column(type: 'integer')]
    private $orden = 0;

    #[ORM\ManyToOne(targetEntity: 'Pais', inversedBy: 'regiones')]
    protected $pais;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Comuna', mappedBy: 'region')]
    protected $comunas;

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
        $this->comunas = new ArrayCollection();
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

    public function getOrdinal(): ?string
    {
        return $this->ordinal;
    }

    public function setOrdinal(string $ordinal): self
    {
        $this->ordinal = $ordinal;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(int $orden): self
    {
        $this->orden = $orden;

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

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

//      * @return Collection|Comuna[]
     
    public function getComunas(): Collection
    {
        return $this->comunas;
    }

    public function addComuna(Comuna $comuna): self
    {
        if (!$this->comunas->contains($comuna)) {
            $this->comunas[] = $comuna;
            $comuna->setRegion($this);
        }

        return $this;
    }

    public function removeComuna(Comuna $comuna): self
    {
        if ($this->comunas->contains($comuna)) {
            $this->comunas->removeElement($comuna);
            // set the owning side to null (unless already changed)
            if ($comuna->getRegion() === $this) {
                $comuna->setRegion(null);
            }
        }

        return $this;
    }

}
