<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\ActividadHorarioRepository::class)]
class ActividadHorario
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'array')]
    private $dias;
    
    #[ORM\Column(type: 'time')]
    private $horaInicio;
    
    #[ORM\Column(type: 'time')]
    private $horaTermino;
    
    #[ORM\Column(type: 'boolean')]
    private $sinRestriccion = false;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'horarios')]
    protected $actividad;

    #[ORM\OneToMany(targetEntity: 'ActividadHorarioPrecio', mappedBy: 'actividadHorario', orphanRemoval: true)]
    protected $precios;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $verde;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $azul;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rojo;

    #[ORM\OneToMany(targetEntity: 'ActividadHorarioOmision', mappedBy: 'actividadHorario', orphanRemoval: true)]
    protected $omisiones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\ManyToOne(inversedBy: 'actividadHorarios', targetEntity: ActividadBloque::class)]
    private $bloque;

    public function __construct()
    {
        $this->precios = new ArrayCollection();
        $this->omisiones = new ArrayCollection();
    }

    public function __toString() {
        return $this->horaInicio->format('H:i');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDias(): ?array
    {
        return $this->dias;
    }

    public function setDias(array $dias): self
    {
        $this->dias = $dias;

        return $this;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraTermino(): ?\DateTimeInterface
    {
        return $this->horaTermino;
    }

    public function setHoraTermino(\DateTimeInterface $horaTermino): self
    {
        $this->horaTermino = $horaTermino;

        return $this;
    }

    public function getSinRestriccion(): ?bool
    {
        return $this->sinRestriccion;
    }

    public function setSinRestriccion(bool $sinRestriccion): self
    {
        $this->sinRestriccion = $sinRestriccion;

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

    public function getActividad(): ?Actividad
    {
        return $this->actividad;
    }

    public function setActividad(?Actividad $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }

//      * @return Collection|ActividadHorarioPrecio[]

    public function getPrecios(): Collection
    {
        return $this->precios;
    }

    public function addPrecio(ActividadHorarioPrecio $precio): self
    {
        if (!$this->precios->contains($precio)) {
            $this->precios[] = $precio;
            $precio->setActividadHorario($this);
        }

        return $this;
    }

    public function removePrecio(ActividadHorarioPrecio $precio): self
    {
        if ($this->precios->contains($precio)) {
            $this->precios->removeElement($precio);
            // set the owning side to null (unless already changed)
            if ($precio->getActividadHorario() === $this) {
                $precio->setActividadHorario(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadHorarioOmision[]

    public function getOmisiones(): Collection
    {
        return $this->omisiones;
    }

    public function addOmisione(ActividadHorarioOmision $omisione): self
    {
        if (!$this->omisiones->contains($omisione)) {
            $this->omisiones[] = $omisione;
            $omisione->setActividadHorario($this);
        }

        return $this;
    }

    public function removeOmisione(ActividadHorarioOmision $omisione): self
    {
        if ($this->omisiones->contains($omisione)) {
            $this->omisiones->removeElement($omisione);
            // set the owning side to null (unless already changed)
            if ($omisione->getActividadHorario() === $this) {
                $omisione->setActividadHorario(null);
            }
        }

        return $this;
    }

    public function getBloque(): ?ActividadBloque
    {
        return $this->bloque;
    }

    public function setBloque(?ActividadBloque $bloque): self
    {
        $this->bloque = $bloque;

        return $this;
    }

}
