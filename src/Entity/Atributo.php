<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\AtributoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Atributo
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Categoria', inversedBy: 'atributos')]
    protected $categoria;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\AtributoValor', mappedBy: 'atributo')]
    protected $valores;

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
        $this->valores = new ArrayCollection();
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

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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

//      * @return Collection|AtributoValor[]
     
    public function getValores(): Collection
    {
        return $this->valores;
    }

    public function addValore(AtributoValor $valore): self
    {
        if (!$this->valores->contains($valore)) {
            $this->valores[] = $valore;
            $valore->setAtributo($this);
        }

        return $this;
    }

    public function removeValore(AtributoValor $valore): self
    {
        if ($this->valores->contains($valore)) {
            $this->valores->removeElement($valore);
            // set the owning side to null (unless already changed)
            if ($valore->getAtributo() === $this) {
                $valore->setAtributo(null);
            }
        }

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

}
