<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

//  * @ORM\Table(indexes={
//  *      @ORM\Index(name="horarios", columns={"fecha_inicio", "fecha_termino", "sin_restriccion"),
//  *      @ORM\Index(name="idx_fecha_inicio", columns={"fecha_inicio"),
//  *      @ORM\Index(name="idx_fecha_termino", columns={"fecha_termino"),
//  *      @ORM\Index(name="idx_actividad_evento_id_fecha", columns={"id", "fecha_inicio"),
//  *      @ORM\Index(name="idx_ae_actividad_fecha_inicio", columns={"actividad_id", "fecha_inicio")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\ActividadEventoRepository::class)]

class ActividadEvento
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $fechaInicio;

    #[ORM\Column(type: 'datetime')]
    private $fechaTermino;

    #[ORM\Column(type: 'boolean')]
    private $sinRestriccion = false;

    #[ORM\Column(type: 'integer')]
    private $impresiones = 0;

    #[ORM\Column(type: 'boolean')]
    private $bloqueado = false;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $entradas = 0;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'eventos')]
    protected $actividad;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Market', inversedBy: 'eventos')]
    protected $markets;

    
    #[ORM\OneToMany(targetEntity: 'ActividadEventoPrecio', mappedBy: 'actividadEvento', orphanRemoval: true)]
//      * @ORM\OrderBy({"id" = "ASC")

    protected $precios;

    #[ORM\OneToMany(targetEntity: 'Item', mappedBy: 'evento')]
    protected $items;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Lista', mappedBy: 'actividadEvento')]
    protected $listas;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'actividadEvento')]
    protected $invitaciones;

//      * @ORM\ManyToMany (targetEntity="App\Entity\ActividadReglaValidacion", mappedBy="actividadEventos")

    protected $reglaValidaciones;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Lista', mappedBy: 'actividadEventos')]
    protected $listasInstancias;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $verde;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $azul;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $rojo;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\ManyToOne(inversedBy: 'actividadEventos', targetEntity: ActividadBloque::class)]
    private $bloque;

    #[ORM\ManyToOne(inversedBy: 'actividadEventos', targetEntity: ActividadEvento::class)]
    private $actividadEvento;

    #[ORM\OneToMany(mappedBy: 'actividadEvento', targetEntity: ActividadEvento::class)]
    private $actividadEventos;

    #[ORM\ManyToOne(inversedBy: 'actividadEventos', targetEntity: ActividadHorario::class)]
    #[ORM\JoinColumn(name: 'activity_schedule_id', referencedColumnName: 'id')]

    private $actividadHorario;

    public function __construct()
    {
        $this->precios = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->listas = new ArrayCollection();
        $this->invitaciones = new ArrayCollection();
        $this->markets = new ArrayCollection();
        $this->reglaValidaciones = new ArrayCollection();
        $this->listasInstancias = new ArrayCollection();
        $this->actividadEventos = new ArrayCollection();
    }

    public function getDuracion()
    {
        $duracion = '';
        if ($this->sinRestriccion) {
            $duracion = 'Sin hora llegada';
        } else {
            $diff = $this->fechaTermino->diff($this->fechaInicio);
            $horas = $diff->format('%h');
            $minutos = $diff->format('%i');
            if ($horas > 0) {
                $duracion .= $diff->format('%h') . ' hrs';
            }
            if ($minutos > 0) {
                if ($duracion != '') {
                    $duracion .= ' ';
                }
                $duracion .= $diff->format('%i') . ' min';
            }

            if ($duracion == '') {
                $duracion = 'Sin hora llegada';
            }
        }

        return $duracion;
    }

    public function getPrecio()
    {
        return $this->getPrecios()->first();
    }

    public function getProveedor()
    {
        return $this->getActividad()->getProveedor();
    }

    public function getSlug()
    {
        return $this->getActividad()->getSlug();
    }

    public function addPrecio(ActividadEventoPrecio $precio, $check = true): self
    {
        if (!$check || !$precio->getActividadEvento()) {
            $precio->setActividadEvento($this);
        }
        $this->precios[] = $precio;

        return $this;
    }

    public function removePrecio(ActividadEventoPrecio $precio): self
    {
        if ($precio->getActividadEvento() == $this) {
            $this->precios->removeElement($precio);
            // set the owning side to null (unless already changed)
            if ($precio->getActividadEvento() === $this) {
                $precio->setActividadEvento(NULL);
            }
        }

        return $this;
    }

    public function getLinkOption()
    {
        return $this->getActividad()->getLinkOption();
    }

    public function __toString()
    {
        return $this->fechaInicio->format('d-m-Y H:i');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaTermino(): ?\DateTimeInterface
    {
        return $this->fechaTermino;
    }

    public function setFechaTermino(\DateTimeInterface $fechaTermino): self
    {
        $this->fechaTermino = $fechaTermino;

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

    public function getImpresiones(): ?int
    {
        return $this->impresiones;
    }

    public function setImpresiones(int $impresiones): self
    {
        $this->impresiones = $impresiones;

        return $this;
    }

    public function getBloqueado(): ?bool
    {
        return $this->bloqueado;
    }

    public function setBloqueado(bool $bloqueado): self
    {
        $this->bloqueado = $bloqueado;

        return $this;
    }

    public function getVerde(): ?int
    {
        return $this->verde;
    }

    public function setVerde(?int $verde): self
    {
        $this->verde = $verde;

        return $this;
    }

    public function getAzul(): ?int
    {
        return $this->azul;
    }

    public function setAzul(?int $azul): self
    {
        $this->azul = $azul;

        return $this;
    }

    public function getRojo(): ?int
    {
        return $this->rojo;
    }

    public function setRojo(?int $rojo): self
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

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

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

//      * @return Collection|ActividadEventoPrecio[]
     
    public function getPrecios(): Collection
    {
        return $this->precios;
    }

//      * @return Collection|Item[]

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setEvento($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getEvento() === $this) {
                $item->setEvento(NULL);
            }
        }

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
            $lista->setActividadEvento($this);
        }

        return $this;
    }

    public function removeLista(Lista $lista): self
    {
        if ($this->listas->contains($lista)) {
            $this->listas->removeElement($lista);
            // set the owning side to null (unless already changed)
            if ($lista->getActividadEvento() === $this) {
                $lista->setActividadEvento(NULL);
            }
        }

        return $this;
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

    public function getEntradas(): ?int
    {
        return $this->entradas;
    }

    public function setEntradas(int $entradas): self
    {
        $this->entradas = $entradas;

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
            $invitacione->setActividadEvento($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->contains($invitacione)) {
            $this->invitaciones->removeElement($invitacione);
            // set the owning side to null (unless already changed)
            if ($invitacione->getActividadEvento() === $this) {
                $invitacione->setActividadEvento(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|Market[]

    public function getMarkets(): Collection
    {
        return $this->markets;
    }

    public function addMarket(Market $market): self
    {
        if (!$this->markets->contains($market)) {
            $this->markets[] = $market;
        }

        return $this;
    }

    public function removeMarket(Market $market): self
    {
        if ($this->markets->contains($market)) {
            $this->markets->removeElement($market);
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
            $reglaValidacione->addActividadEvento($this);
        }

        return $this;
    }

    public function removeReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if ($this->reglaValidaciones->removeElement($reglaValidacione)) {
            $reglaValidacione->removeActividadEvento($this);
        }

        return $this;
    }

//      * @return Collection|Lista[]

    public function getListasInstancias(): Collection
    {
        return $this->listasInstancias;
    }

    public function addListasInstancia(Lista $listasInstancia): self
    {
        if (!$this->listasInstancias->contains($listasInstancia)) {
            $this->listasInstancias[] = $listasInstancia;
            $listasInstancia->addActividadEvento($this);
        }

        return $this;
    }

    public function removeListasInstancia(Lista $listasInstancia): self
    {
        if ($this->listasInstancias->removeElement($listasInstancia)) {
            $listasInstancia->removeActividadEvento($this);
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

    public function getActividadEvento(): ?self
    {
        return $this->actividadEvento;
    }

    public function setActividadEvento(?self $actividadEvento): self
    {
        $this->actividadEvento = $actividadEvento;

        return $this;
    }

//      * @return Collection|self[]

    public function getActividadEventos(): Collection
    {
        return $this->actividadEventos;
    }

    public function addActividadEvento(self $actividadEvento): self
    {
        if (!$this->actividadEventos->contains($actividadEvento)) {
            $this->actividadEventos[] = $actividadEvento;
            $actividadEvento->setActividadEvento($this);
        }

        return $this;
    }

    public function removeActividadEvento(self $actividadEvento): self
    {
        if ($this->actividadEventos->removeElement($actividadEvento)) {
            // set the owning side to null (unless already changed)
            if ($actividadEvento->getActividadEvento() === $this) {
                $actividadEvento->setActividadEvento(null);
            }
        }

        return $this;
    }


}
