<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OrderBy;


    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadDependencia
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'dependencias')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'dependientes')]
    protected $dependiente;

    #[ORM\ManyToMany(targetEntity: 'ActividadTipoPrecio', inversedBy: 'dependencias')]
    protected $dependencias;

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
        $this->dependencias = new ArrayCollection();
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

    public function getDependiente(): ?ActividadTipoPrecio
    {
        return $this->dependiente;
    }

    public function setDependiente(?ActividadTipoPrecio $dependiente): self
    {
        $this->dependiente = $dependiente;

        return $this;
    }

//      * @return Collection|ActividadTipoPrecio[]
     
    public function getDependencias(): Collection
    {
        return $this->dependencias;
    }

    public function addDependencia(ActividadTipoPrecio $dependencia): self
    {
        if (!$this->dependencias->contains($dependencia)) {
            $this->dependencias[] = $dependencia;
        }

        return $this;
    }

    public function removeDependencia(ActividadTipoPrecio $dependencia): self
    {
        if ($this->dependencias->contains($dependencia)) {
            $this->dependencias->removeElement($dependencia);
        }

        return $this;
    }


}
