<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\AtributoValorRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class AtributoValor
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $valor;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Atributo', inversedBy: 'valores')]
    protected $atributo;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\FichaAtributo', mappedBy: 'atributoValor')]
    protected $fichaAtributos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ProductoAtributo', mappedBy: 'atributoValor')]
    protected $productoAtributos;

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
        return $this->getValor();
    }

    public function __construct()
    {
        $this->fichaAtributos = new ArrayCollection();
        $this->productoAtributos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

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

    public function getAtributo(): ?Atributo
    {
        return $this->atributo;
    }

    public function setAtributo(?Atributo $atributo): self
    {
        $this->atributo = $atributo;

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
            $fichaAtributo->setAtributoValor($this);
        }

        return $this;
    }

    public function removeFichaAtributo(FichaAtributo $fichaAtributo): self
    {
        if ($this->fichaAtributos->contains($fichaAtributo)) {
            $this->fichaAtributos->removeElement($fichaAtributo);
            // set the owning side to null (unless already changed)
            if ($fichaAtributo->getAtributoValor() === $this) {
                $fichaAtributo->setAtributoValor(null);
            }
        }

        return $this;
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
            $productoAtributo->setAtributoValor($this);
        }

        return $this;
    }

    public function removeProductoAtributo(ProductoAtributo $productoAtributo): self
    {
        if ($this->productoAtributos->contains($productoAtributo)) {
            $this->productoAtributos->removeElement($productoAtributo);
            // set the owning side to null (unless already changed)
            if ($productoAtributo->getAtributoValor() === $this) {
                $productoAtributo->setAtributoValor(null);
            }
        }

        return $this;
    }

}
