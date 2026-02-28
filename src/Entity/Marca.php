<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\MarcaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Marca
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[Gedmo\Slug()]
    #[ORM\Column(length: 128, unique: true)]
    private $slug;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\Ficha', mappedBy: 'marca')]
    protected $fichas;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __toString()
    {
        return $this->getNombre();
    }

    public function __construct()
    {
        $this->fichas = new ArrayCollection();
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

//      * @return Collection|Ficha[]
     
    public function getFichas(): Collection
    {
        return $this->fichas;
    }

    public function addFicha(Ficha $ficha): self
    {
        if (!$this->fichas->contains($ficha)) {
            $this->fichas[] = $ficha;
            $ficha->setMarca($this);
        }

        return $this;
    }

    public function removeFicha(Ficha $ficha): self
    {
        if ($this->fichas->contains($ficha)) {
            $this->fichas->removeElement($ficha);
            // set the owning side to null (unless already changed)
            if ($ficha->getMarca() === $this) {
                $ficha->setMarca(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

}
