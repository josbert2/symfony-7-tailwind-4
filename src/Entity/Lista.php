<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ListaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Lista
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: true)]
    private $mensaje;

    #[ORM\Column(type: 'boolean')]
    private $abierta = true;

    #[ORM\ManyToOne(targetEntity: 'Grupo', inversedBy: 'listas')]
    protected $grupo;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'listas')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ActividadEvento', inversedBy: 'listas')]
    protected $actividadEvento;

    #[ORM\ManyToOne(targetEntity: 'ActividadEventoPrecio', inversedBy: 'listas')]
    protected $actividadEventoPrecio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ActividadZona', inversedBy: 'listas')]
    protected $actividadZona;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'listas')]
    protected $tipoPrecio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'listas')]
    protected $market;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\ActividadEvento', inversedBy: 'listasInstancias')]
    protected $actividadEventos;

    #[ORM\OneToMany(targetEntity: 'Invitado', mappedBy: 'lista', orphanRemoval: true)]
    protected $invitados;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $asunto;

    #[ORM\Column(type: 'boolean')]
    private $enviarEntradas = false;

    public function getTipo()
    {
        return $this->getGrupo()->getTipo();
    }

    public function __construct()
    {
        $this->invitados = new ArrayCollection();
        $this->actividadEventos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMensaje(): ?string
    {
        return $this->mensaje;
    }

    public function setMensaje(?string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getAbierta(): ?bool
    {
        return $this->abierta;
    }

    public function setAbierta(bool $abierta): self
    {
        $this->abierta = $abierta;

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

    public function getGrupo(): ?Grupo
    {
        return $this->grupo;
    }

    public function setGrupo(?Grupo $grupo): self
    {
        $this->grupo = $grupo;

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

    public function getActividadEvento(): ?ActividadEvento
    {
        return $this->actividadEvento;
    }

    public function setActividadEvento(?ActividadEvento $actividadEvento): self
    {
        $this->actividadEvento = $actividadEvento;

        return $this;
    }

    public function getActividadEventoPrecio(): ?ActividadEventoPrecio
    {
        return $this->actividadEventoPrecio;
    }

    public function setActividadEventoPrecio(?ActividadEventoPrecio $actividadEventoPrecio): self
    {
        $this->actividadEventoPrecio = $actividadEventoPrecio;

        return $this;
    }

    public function getTipoPrecio(): ?ActividadTipoPrecio
    {
        return $this->tipoPrecio;
    }

    public function setTipoPrecio(?ActividadTipoPrecio $tipoPrecio): self
    {
        $this->tipoPrecio = $tipoPrecio;

        return $this;
    }

//      * @return Collection|Invitado[]
     
    public function getInvitados(): Collection
    {
        return $this->invitados;
    }

    public function addInvitado(Invitado $invitado): self
    {
        if (!$this->invitados->contains($invitado)) {
            $this->invitados[] = $invitado;
            $invitado->setLista($this);
        }

        return $this;
    }

    public function removeInvitado(Invitado $invitado): self
    {
        if ($this->invitados->contains($invitado)) {
            $this->invitados->removeElement($invitado);
            // set the owning side to null (unless already changed)
            if ($invitado->getLista() === $this) {
                $invitado->setLista(null);
            }
        }

        return $this;
    }

    public function getActividadZona(): ?ActividadZona
    {
        return $this->actividadZona;
    }

    public function setActividadZona(?ActividadZona $actividadZona): self
    {
        $this->actividadZona = $actividadZona;

        return $this;
    }

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        $this->market = $market;

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

    public function getProveedor(): ?Proveedor
    {
        return $this->getActividad()->getProveedor();
    }

    public function getAsunto(): ?string
    {
        return $this->asunto;
    }

    public function setAsunto(?string $asunto): self
    {
        $this->asunto = $asunto;
        return $this;
    }

    public function setEnviarEntradas(bool $enviarEntradas): self
    {
        $this->enviarEntradas = $enviarEntradas;
        return $this;
    }

    public function getEnviarEntradas(): bool
    {
        return $this->enviarEntradas;
    }
}
