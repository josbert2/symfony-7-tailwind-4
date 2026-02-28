<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ActividadZonaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadZona
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $entradas = 0;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'zonas')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'Zona', inversedBy: 'actividades')]
    protected $zona;

    #[ORM\OneToMany(targetEntity: 'ActividadZonaPrecio', mappedBy: 'actividadZona', orphanRemoval: true)]
    protected $precios;

    #[ORM\OneToMany(targetEntity: 'ActividadEventoPrecio', mappedBy: 'actividadZona')]
    protected $eventoPrecios;

    #[ORM\OneToMany(targetEntity: 'Lista', mappedBy: 'actividadZona')]
    protected $listas;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'actividadZona')]
    protected $invitaciones;

//      * @ORM\ManyToMany (targetEntity="App\Entity\ActividadReglaValidacion", mappedBy="actividadZonas")

    protected $reglaValidaciones;

    #[ORM\Column(type: 'boolean', nullable: false)]

    protected $transaccionUnica = false;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getDisponible() {
        $disponible = $this->getCupos() - $this->getEntradas();

        return $disponible;
    }

    public function getButacas() {
        return $this->getZona()->getButacas();
    }

    public function addEventoPrecio(ActividadEventoPrecio $eventoPrecio, $check = true): self
    {
        if (!$check || !$this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios[] = $eventoPrecio;
            $eventoPrecio->setActividadZona($this);
        }

        return $this;
    }

    public function __toString() {
        return $this->getZona()->__toString();
    }

    public function __construct()
    {
        $this->precios = new ArrayCollection();
        $this->eventoPrecios = new ArrayCollection();
        $this->listas = new ArrayCollection();
        $this->invitaciones = new ArrayCollection();
        $this->reglaValidaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCupos(): ?int
    {
        return $this->cupos;
    }

    public function setCupos(int $cupos): self
    {
        $this->cupos = $cupos;

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

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): self
    {
        $this->zona = $zona;

        return $this;
    }

//      * @return Collection|ActividadZonaPrecio[]
     
    public function getPrecios(): Collection
    {
        return $this->precios;
    }

    public function addPrecio(ActividadZonaPrecio $precio): self
    {
        if (!$this->precios->contains($precio)) {
            $this->precios[] = $precio;
            $precio->setActividadZona($this);
        }

        return $this;
    }

    public function removePrecio(ActividadZonaPrecio $precio): self
    {
        if ($this->precios->contains($precio)) {
            $this->precios->removeElement($precio);
            // set the owning side to null (unless already changed)
            if ($precio->getActividadZona() === $this) {
                $precio->setActividadZona(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadEventoPrecio[]

    public function getEventoPrecios(): Collection
    {
        return $this->eventoPrecios;
    }

    public function removeEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if ($this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios->removeElement($eventoPrecio);
            // set the owning side to null (unless already changed)
            if ($eventoPrecio->getActividadZona() === $this) {
                $eventoPrecio->setActividadZona(null);
            }
        }

        return $this;
    }

    public function getEntradas(): ?int
    {
        return $this->entradas;
    }

    public function setEntradas(int $entradas): self
    {
        $this->entradas = $entradas;

        return $this;
    }

//      * @return Collection|Lista[]

    public function getListas(): Collection
    {
        return $this->listas;
    }

    public function addLista(Lista $lista): self
    {
        if (!$this->listas->contains($lista)) {
            $this->listas[] = $lista;
            $lista->setActividadZona($this);
        }

        return $this;
    }

    public function removeLista(Lista $lista): self
    {
        if ($this->listas->contains($lista)) {
            $this->listas->removeElement($lista);
            // set the owning side to null (unless already changed)
            if ($lista->getActividadZona() === $this) {
                $lista->setActividadZona(null);
            }
        }

        return $this;
    }

//      * @return Collection|Invitacion[]

    public function getInvitaciones(): Collection
    {
        return $this->invitaciones;
    }

    public function addInvitacione(Invitacion $invitacione): self
    {
        if (!$this->invitaciones->contains($invitacione)) {
            $this->invitaciones[] = $invitacione;
            $invitacione->setActividadZona($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->contains($invitacione)) {
            $this->invitaciones->removeElement($invitacione);
            // set the owning side to null (unless already changed)
            if ($invitacione->getActividadZona() === $this) {
                $invitacione->setActividadZona(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadReglaValidacion[]

    public function getReglaValidaciones(): Collection
    {
        return $this->reglaValidaciones;
    }

    public function addReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if (!$this->reglaValidaciones->contains($reglaValidacione)) {
            $this->reglaValidaciones[] = $reglaValidacione;
            $reglaValidacione->addActividadZona($this);
        }

        return $this;
    }

    public function removeReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if ($this->reglaValidaciones->removeElement($reglaValidacione)) {
            $reglaValidacione->removeActividadZona($this);
        }

        return $this;
    }

    public function getTransaccionUnica(): ?bool
    {
        return $this->transaccionUnica;
    }

    public function setTransaccionUnica(bool $transaccionUnica): self
    {
        $this->transaccionUnica = $transaccionUnica;

        return $this;
    }

}
