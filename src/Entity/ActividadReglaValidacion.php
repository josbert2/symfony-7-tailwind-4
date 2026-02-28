<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ActividadReglaValidacionRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadReglaValidacion
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'boolean')]
    private $validacionInstancia = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionDias = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionValor = false;

    #[ORM\Column(type: 'integer')]
    private $desdeCaducado = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $desdeCaducadoUnidad;

    #[ORM\Column(type: 'integer')]
    private $hastaCaducado = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hastaCaducadoUnidad;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Actividad', inversedBy: 'reglaValidaciones')]
    protected $actividad;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\ActividadEvento', inversedBy: 'reglaValidaciones')]
    protected $actividadEventos;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\ActividadTipoPrecio', inversedBy: 'reglaValidaciones')]
    protected $actividadTipoPrecios;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\ActividadZona', inversedBy: 'reglaValidaciones')]
    protected $actividadZonas;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Staff', inversedBy: 'reglaValidaciones')]
    protected $staffs;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadReglaValidacionDias', mappedBy: 'actividadReglaValidacion', orphanRemoval: true)]
    protected $dias;

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
        $this->actividadEventos = new ArrayCollection();
        $this->actividadTipoPrecios = new ArrayCollection();
        $this->actividadZonas = new ArrayCollection();
        $this->staffs = new ArrayCollection();
        $this->dias = new ArrayCollection();
    }

    public function getProveedor()
    {
        return $this->getActividad()->getProveedor();
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

    public function getValidacionInstancia(): ?bool
    {
        return $this->validacionInstancia;
    }

    public function setValidacionInstancia(bool $validacionInstancia): self
    {
        $this->validacionInstancia = $validacionInstancia;

        return $this;
    }

    public function getValidacionDias(): ?bool
    {
        return $this->validacionDias;
    }

    public function setValidacionDias(bool $validacionDias): self
    {
        $this->validacionDias = $validacionDias;

        return $this;
    }

    public function getValidacionValor(): ?bool
    {
        return $this->validacionValor;
    }

    public function setValidacionValor(bool $validacionValor): self
    {
        $this->validacionValor = $validacionValor;

        return $this;
    }

    public function getDesdeCaducado(): ?int
    {
        return $this->desdeCaducado;
    }

    public function setDesdeCaducado(int $desdeCaducado): self
    {
        $this->desdeCaducado = $desdeCaducado;

        return $this;
    }

    public function getDesdeCaducadoUnidad(): ?string
    {
        return $this->desdeCaducadoUnidad;
    }

    public function setDesdeCaducadoUnidad(?string $desdeCaducadoUnidad): self
    {
        $this->desdeCaducadoUnidad = $desdeCaducadoUnidad;

        return $this;
    }

    public function getHastaCaducado(): ?int
    {
        return $this->hastaCaducado;
    }

    public function setHastaCaducado(int $hastaCaducado): self
    {
        $this->hastaCaducado = $hastaCaducado;

        return $this;
    }

    public function getHastaCaducadoUnidad(): ?string
    {
        return $this->hastaCaducadoUnidad;
    }

    public function setHastaCaducadoUnidad(?string $hastaCaducadoUnidad): self
    {
        $this->hastaCaducadoUnidad = $hastaCaducadoUnidad;

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

    public function getActividad(): ?Actividad
    {
        return $this->actividad;
    }

    public function setActividad(?Actividad $actividad): self
    {
        $this->actividad = $actividad;

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
        }

        return $this;
    }

    public function removeActividadEvento(ActividadEvento $actividadEvento): self
    {
        $this->actividadEventos->removeElement($actividadEvento);

        return $this;
    }

//      * @return Collection|ActividadTipoPrecio[]

    public function getActividadTipoPrecios(): Collection
    {
        return $this->actividadTipoPrecios;
    }

    public function addActividadTipoPrecio(ActividadTipoPrecio $actividadTipoPrecio): self
    {
        if (!$this->actividadTipoPrecios->contains($actividadTipoPrecio)) {
            $this->actividadTipoPrecios[] = $actividadTipoPrecio;
        }

        return $this;
    }

    public function removeActividadTipoPrecio(ActividadTipoPrecio $actividadTipoPrecio): self
    {
        $this->actividadTipoPrecios->removeElement($actividadTipoPrecio);

        return $this;
    }

//      * @return Collection|ActividadZona[]

    public function getActividadZonas(): Collection
    {
        return $this->actividadZonas;
    }

    public function addActividadZona(ActividadZona $actividadZona): self
    {
        if (!$this->actividadZonas->contains($actividadZona)) {
            $this->actividadZonas[] = $actividadZona;
        }

        return $this;
    }

    public function removeActividadZona(ActividadZona $actividadZona): self
    {
        $this->actividadZonas->removeElement($actividadZona);

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
        }

        return $this;
    }

    public function removeStaff(Staff $staff): self
    {
        $this->staffs->removeElement($staff);

        return $this;
    }

//      * @return Collection|ActividadReglaValidacionDias[]

    public function getDias(): Collection
    {
        return $this->dias;
    }

    public function addDia(ActividadReglaValidacionDias $dia): self
    {
        if (!$this->dias->contains($dia)) {
            $this->dias[] = $dia;
            $dia->setActividadReglaValidacion($this);
        }

        return $this;
    }

    public function removeDia(ActividadReglaValidacionDias $dia): self
    {
        if ($this->dias->removeElement($dia)) {
            // set the owning side to null (unless already changed)
            if ($dia->getActividadReglaValidacion() === $this) {
                $dia->setActividadReglaValidacion(NULL);
            }
        }

        return $this;
    }

}
