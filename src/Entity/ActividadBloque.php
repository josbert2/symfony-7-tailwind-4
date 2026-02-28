<?php

namespace App\Entity;

use App\Repository\ActividadBloqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity(repositoryClass: ActividadBloqueRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadBloque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'actividadBloques', targetEntity: Actividad::class)]
    private $actividad;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;

    #[ORM\Column(type: 'integer')]
    private $cantidad;

    #[ORM\Column(type: 'integer')]
    private $verde = 0;

    #[ORM\Column(type: 'integer')]
    private $azul = 0;

    #[ORM\Column(type: 'integer')]
    private $rojo = 0;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;

    #[ORM\OneToMany(mappedBy: 'bloque', targetEntity: ActividadEvento::class)]
    private $actividadEventos;

    #[ORM\OneToMany(mappedBy: 'bloque', targetEntity: ActividadHorario::class)]
    private $actividadHorarios;

    public function __construct()
    {
        $this->actividadEventos = new ArrayCollection();
        $this->actividadHorarios = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getVerde(): ?int
    {
        return $this->verde;
    }

    public function setVerde(int $verde): self
    {
        $this->verde = $verde;

        return $this;
    }

    public function getAzul(): ?int
    {
        return $this->azul;
    }

    public function setAzul(int $azul): self
    {
        $this->azul = $azul;

        return $this;
    }

    public function getRojo(): ?int
    {
        return $this->rojo;
    }

    public function setRojo(int $rojo): self
    {
        $this->rojo = $rojo;

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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

//      * @return Collection|ActividadEvento[]
     
    public function getActividadEventos(): Collection
    {
        return $this->actividadEventos;
    }

    public function addActividadEvento(ActividadEvento $actividadEvento): self
    {
        if (!$this->actividadEventos->contains($actividadEvento)) {
            $this->actividadEventos[] = $actividadEvento;
            $actividadEvento->setBloque($this);
        }

        return $this;
    }

    public function removeActividadEvento(ActividadEvento $actividadEvento): self
    {
        if ($this->actividadEventos->removeElement($actividadEvento)) {
            // set the owning side to null (unless already changed)
            if ($actividadEvento->getBloque() === $this) {
                $actividadEvento->setBloque(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadHorario[]

    public function getActividadHorarios(): Collection
    {
        return $this->actividadHorarios;
    }

    public function addActividadHorario(ActividadHorario $actividadHorario): self
    {
        if (!$this->actividadHorarios->contains($actividadHorario)) {
            $this->actividadHorarios[] = $actividadHorario;
            $actividadHorario->setBloque($this);
        }

        return $this;
    }

    public function removeActividadHorario(ActividadHorario $actividadHorario): self
    {
        if ($this->actividadHorarios->removeElement($actividadHorario)) {
            // set the owning side to null (unless already changed)
            if ($actividadHorario->getBloque() === $this) {
                $actividadHorario->setBloque(null);
            }
        }

        return $this;
    }
}
