<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\ActividadTipoPrecioRepository::class)]
class ActividadTipoPrecio
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subtitulo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoBoleta;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoServicios;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $entradas = 0;

    #[ORM\Column(type: 'boolean')]
    private $pack = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $packMinimo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $packMaximo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $packSuma;
    
    #[ORM\Column(type: 'boolean')]
    private $ninos = true;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'tiposPrecio')]
    protected $actividad;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ProveedorRut', inversedBy: 'actividadTipoPrecios')]
    protected $proveedorRut;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Producto', mappedBy: 'tipoPrecio')]
    protected $producto;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadEventoPrecio', mappedBy: 'tipoPrecio')]
    protected $eventoPrecios;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadZonaPrecio', mappedBy: 'tipoPrecio')]
    protected $zonaPrecios;
    
    #[ORM\OneToMany(targetEntity: 'ActividadHorarioPrecio', mappedBy: 'tipoPrecio')]
    protected $horarioPrecios;

    #[ORM\OneToMany(targetEntity: 'CodigoExterno', mappedBy: 'tipoPrecio')]
    protected $codigosExternos;

    #[ORM\OneToMany(targetEntity: 'Lista', mappedBy: 'tipoPrecio')]
    protected $listas;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'tipoPrecio')]
    protected $invitaciones;

    #[ORM\OneToMany(targetEntity: 'ActividadDependencia', mappedBy: 'dependiente')]
    protected $dependientes;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadTipoPrecioMarket', mappedBy: 'actividadTipoPrecio', orphanRemoval: true)]
    protected $actividadTipoPrecioMarkets;

    #[ORM\ManyToMany(targetEntity: 'ActividadDependencia', mappedBy: 'dependencias')]
    protected $dependencias;

//      * @ORM\ManyToMany (targetEntity="App\Entity\ActividadReglaValidacion", mappedBy="actividadTipoPrecios")

    protected $reglaValidaciones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function getProveedor()
    {
        $proveedor = $this->getActividad()->getProveedor();

        return $proveedor;
    }

    public function getActividadTipoPrecioMarket($market)
    {
        foreach ($this->getActividadTipoPrecioMarkets() as $actividadTipoPrecioMarket) {
            if ($actividadTipoPrecioMarket->getMarket() == $market) {
                return $actividadTipoPrecioMarket;
            }
        }

        return NULL;
    }

    public function __construct()
    {
        $this->eventoPrecios = new ArrayCollection();
        $this->horarioPrecios = new ArrayCollection();
        $this->codigosExternos = new ArrayCollection();
        $this->dependientes = new ArrayCollection();
        $this->dependencias = new ArrayCollection();
        $this->listas = new ArrayCollection();
        $this->invitaciones = new ArrayCollection();
        $this->zonaPrecios = new ArrayCollection();
        $this->reglaValidaciones = new ArrayCollection();
        $this->actividadTipoPrecioMarkets = new ArrayCollection();
    }

    public function getDisponible() {
        $disponible = $this->getCupos() - $this->getEntradas();

        return $disponible;
    }

    public function __toString() {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        $nombre = trim(preg_replace('/\s\s+/', ' ', $this->nombre));
        return $nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getSubtitulo(): ?string
    {
        return $this->subtitulo;
    }

    public function setSubtitulo(?string $subtitulo): self
    {
        $this->subtitulo = $subtitulo;

        return $this;
    }

    public function getNinos(): ?bool
    {
        return $this->ninos;
    }

    public function setNinos(bool $ninos): self
    {
        $this->ninos = $ninos;

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

    public function getEventoPrecios(): Collection
    {
        return $this->eventoPrecios;
    }

    public function addEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if (!$this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios[] = $eventoPrecio;
            $eventoPrecio->setTipoPrecio($this);
        }

        return $this;
    }

    public function removeEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if ($this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios->removeElement($eventoPrecio);
            // set the owning side to null (unless already changed)
            if ($eventoPrecio->getTipoPrecio() === $this) {
                $eventoPrecio->setTipoPrecio(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadHorarioPrecio[]

    public function getHorarioPrecios(): Collection
    {
        return $this->horarioPrecios;
    }

    public function addHorarioPrecio(ActividadHorarioPrecio $horarioPrecio): self
    {
        if (!$this->horarioPrecios->contains($horarioPrecio)) {
            $this->horarioPrecios[] = $horarioPrecio;
            $horarioPrecio->setTipoPrecio($this);
        }

        return $this;
    }

    public function removeHorarioPrecio(ActividadHorarioPrecio $horarioPrecio): self
    {
        if ($this->horarioPrecios->contains($horarioPrecio)) {
            $this->horarioPrecios->removeElement($horarioPrecio);
            // set the owning side to null (unless already changed)
            if ($horarioPrecio->getTipoPrecio() === $this) {
                $horarioPrecio->setTipoPrecio(null);
            }
        }

        return $this;
    }

//      * @return Collection|CodigoExterno[]

    public function getCodigosExternos(): Collection
    {
        return $this->codigosExternos;
    }

    public function addCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if (!$this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos[] = $codigosExterno;
            $codigosExterno->setTipoPrecio($this);
        }

        return $this;
    }

    public function removeCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if ($this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos->removeElement($codigosExterno);
            // set the owning side to null (unless already changed)
            if ($codigosExterno->getTipoPrecio() === $this) {
                $codigosExterno->setTipoPrecio(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadDependencia[]

    public function getDependientes(): Collection
    {
        return $this->dependientes;
    }

    public function addDependiente(ActividadDependencia $dependiente): self
    {
        if (!$this->dependientes->contains($dependiente)) {
            $this->dependientes[] = $dependiente;
            $dependiente->setDependiente($this);
        }

        return $this;
    }

    public function removeDependiente(ActividadDependencia $dependiente): self
    {
        if ($this->dependientes->contains($dependiente)) {
            $this->dependientes->removeElement($dependiente);
            // set the owning side to null (unless already changed)
            if ($dependiente->getDependiente() === $this) {
                $dependiente->setDependiente(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadDependencia[]

    public function getDependencias(): Collection
    {
        return $this->dependencias;
    }

    public function addDependencia(ActividadDependencia $dependencia): self
    {
        if (!$this->dependencias->contains($dependencia)) {
            $this->dependencias[] = $dependencia;
            $dependencia->setDependencia($this);
        }

        return $this;
    }

    public function removeDependencia(ActividadDependencia $dependencia): self
    {
        if ($this->dependencias->contains($dependencia)) {
            $this->dependencias->removeElement($dependencia);
            // set the owning side to null (unless already changed)
            if ($dependencia->getDependencia() === $this) {
                $dependencia->setDependencia(null);
            }
        }

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

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
            $lista->setTipoPrecio($this);
        }

        return $this;
    }

    public function removeLista(Lista $lista): self
    {
        if ($this->listas->contains($lista)) {
            $this->listas->removeElement($lista);
            // set the owning side to null (unless already changed)
            if ($lista->getTipoPrecio() === $this) {
                $lista->setTipoPrecio(null);
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
            $invitacione->setTipoPrecio($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->contains($invitacione)) {
            $this->invitaciones->removeElement($invitacione);
            // set the owning side to null (unless already changed)
            if ($invitacione->getTipoPrecio() === $this) {
                $invitacione->setTipoPrecio(null);
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

//      * @return Collection|ActividadZonaPrecio[]

    public function getZonaPrecios(): Collection
    {
        return $this->zonaPrecios;
    }

    public function addZonaPrecio(ActividadZonaPrecio $zonaPrecio): self
    {
        if (!$this->zonaPrecios->contains($zonaPrecio)) {
            $this->zonaPrecios[] = $zonaPrecio;
            $zonaPrecio->setTipoPrecio($this);
        }

        return $this;
    }

    public function removeZonaPrecio(ActividadZonaPrecio $zonaPrecio): self
    {
        if ($this->zonaPrecios->contains($zonaPrecio)) {
            $this->zonaPrecios->removeElement($zonaPrecio);
            // set the owning side to null (unless already changed)
            if ($zonaPrecio->getTipoPrecio() === $this) {
                $zonaPrecio->setTipoPrecio(null);
            }
        }

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;

        // set (or unset) the owning side of the relation if necessary
        $newTipoPrecio = $producto === null ? null : $this;
        if ($newTipoPrecio !== $producto->getTipoPrecio()) {
            $producto->setTipoPrecio($newTipoPrecio);
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

    public function getTipoBoleta(): ?string
    {
        return $this->tipoBoleta;
    }

    public function setTipoBoleta(?string $tipoBoleta): self
    {
        $this->tipoBoleta = $tipoBoleta;

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
            $reglaValidacione->addActividadTipoPrecio($this);
        }

        return $this;
    }

    public function removeReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if ($this->reglaValidaciones->removeElement($reglaValidacione)) {
            $reglaValidacione->removeActividadTipoPrecio($this);
        }

        return $this;
    }

//      * @return Collection|ActividadTipoPrecioMarket[]

    public function getActividadTipoPrecioMarkets(): Collection
    {
        return $this->actividadTipoPrecioMarkets;
    }

    public function addActividadTipoPrecioMarket(ActividadTipoPrecioMarket $actividadTipoPrecioMarket): self
    {
        if (!$this->actividadTipoPrecioMarkets->contains($actividadTipoPrecioMarket)) {
            $this->actividadTipoPrecioMarkets[] = $actividadTipoPrecioMarket;
            $actividadTipoPrecioMarket->setActividadTipoPrecio($this);
        }

        return $this;
    }

    public function removeActividadTipoPrecioMarket(ActividadTipoPrecioMarket $actividadTipoPrecioMarket): self
    {
        if ($this->actividadTipoPrecioMarkets->removeElement($actividadTipoPrecioMarket)) {
            // set the owning side to null (unless already changed)
            if ($actividadTipoPrecioMarket->getActividadTipoPrecio() === $this) {
                $actividadTipoPrecioMarket->setActividadTipoPrecio(null);
            }
        }

        return $this;
    }

    public function getProveedorRut(): ?ProveedorRut
    {
        return $this->proveedorRut;
    }

    public function setProveedorRut(?ProveedorRut $proveedorRut): self
    {
        $this->proveedorRut = $proveedorRut;

        return $this;
    }

    public function getTipoServicios(): ?string
    {
        return $this->tipoServicios;
    }

    public function setTipoServicios(?string $tipoServicios): self
    {
        $this->tipoServicios = $tipoServicios;

        return $this;
    }

    public function getPackMinimo(): ?int
    {
        return $this->packMinimo;
    }

    public function setPackMinimo(?int $packMinimo): self
    {
        $this->packMinimo = $packMinimo;

        return $this;
    }

    public function getPackMaximo(): ?int
    {
        return $this->packMaximo;
    }

    public function setPackMaximo(?int $packMaximo): self
    {
        $this->packMaximo = $packMaximo;

        return $this;
    }

    public function getPackSuma(): ?int
    {
        return $this->packSuma;
    }

    public function setPackSuma(?int $packSuma): self
    {
        $this->packSuma = $packSuma;

        return $this;
    }

    public function getPack(): ?bool
    {
        return $this->pack;
    }

    public function setPack(bool $pack): self
    {
        $this->pack = $pack;

        return $this;
    }

}
