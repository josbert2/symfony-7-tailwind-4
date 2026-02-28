<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\InvitacionRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Invitacion
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado = 'Pendiente';

    #[ORM\Column(type: 'string', length: 255)]
    private $codigo;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaEmail;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaReenvio;

    #[ORM\Column(type: 'boolean')]
    private $abierta = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaVencimiento;

    #[ORM\ManyToOne(targetEntity: 'Invitado', inversedBy: 'invitaciones')]
    protected $invitado;

    #[ORM\ManyToOne(targetEntity: 'Invitado', inversedBy: 'invitacionesReenviadas')]
    protected $invitadoOriginal;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'invitaciones')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'ActividadEvento', inversedBy: 'invitaciones')]
    protected $actividadEvento;

    #[ORM\ManyToOne(targetEntity: 'ActividadEventoPrecio', inversedBy: 'invitaciones')]
    protected $actividadEventoPrecio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ActividadZona', inversedBy: 'invitaciones')]
    protected $actividadZona;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'invitaciones')]
    protected $tipoPrecio;

    #[ORM\OneToOne(targetEntity: 'Transaccion', mappedBy: 'invitacion')]
    protected $transaccion;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getTipo()
    {
        return $this->getInvitado()->getTipo();
    }

    public function getProveedor()
    {
        return $this->getInvitado()->getProveedor();
    }

    public function getLista()
    {
        return $this->getInvitado()->getLista();
    }

    public function getGrupo()
    {
        return $this->getInvitado()->getGrupo();
    }

    public function getMarket()
    {
        return $this->getInvitado()->getMarket();
    }

    public function getEntrada() : ?Entrada
    {
        if($this->getTransaccion()){
            return $this->getTransaccion()->getItems()->first()->getEntradas()->first();
        }

        return NULL;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getFechaEmail(): ?\DateTimeInterface
    {
        return $this->fechaEmail;
    }

    public function setFechaEmail(?\DateTimeInterface $fechaEmail): self
    {
        $this->fechaEmail = $fechaEmail;

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

    public function getInvitado(): ?Invitado
    {
        return $this->invitado;
    }

    public function setInvitado(?Invitado $invitado): self
    {
        $this->invitado = $invitado;

        return $this;
    }

    public function getInvitadoOriginal(): ?Invitado
    {
        return $this->invitadoOriginal;
    }

    public function setInvitadoOriginal(?Invitado $invitadoOriginal): self
    {
        $this->invitadoOriginal = $invitadoOriginal;

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

    public function getTransaccion(): ?Transaccion
    {
        return $this->transaccion;
    }

    public function setTransaccion(?Transaccion $transaccion): self
    {
        $this->transaccion = $transaccion;

        // set (or unset) the owning side of the relation if necessary
        $newInvitacion = $transaccion === null ? null : $this;
        if ($newInvitacion !== $transaccion->getInvitacion()) {
            $transaccion->setInvitacion($newInvitacion);
        }

        return $this;
    }

    public function getFechaReenvio(): ?\DateTimeInterface
    {
        return $this->fechaReenvio;
    }

    public function setFechaReenvio(?\DateTimeInterface $fechaReenvio): self
    {
        $this->fechaReenvio = $fechaReenvio;

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

    public function getFechaVencimiento(): ?\DateTimeInterface
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento(?\DateTimeInterface $fechaVencimiento): self
    {
        $this->fechaVencimiento = $fechaVencimiento;

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



}
