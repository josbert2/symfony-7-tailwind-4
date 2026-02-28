<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ActividadZonaPrecioRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadZonaPrecio
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $precio = 0;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;

    #[ORM\Column(type: 'integer')]
    private $entradas = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoDescuento;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $cambioManual;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\ManyToOne(targetEntity: 'ActividadZona', inversedBy: 'precios')]
    protected $actividadZona;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'zonaPrecios')]
    protected $tipoPrecio;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ActividadZonaPrecioDescuento', mappedBy: 'actividadZonaPrecio')]
    protected $actividadZonaPrecioDescuento;

    #[ORM\OneToMany(targetEntity: 'ActividadEventoPrecio', mappedBy: 'actividadZonaPrecio')]
    protected $eventoPrecios;

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
        $this->eventoPrecios = new ArrayCollection();
    }

    public function getPrecioFinal() {
        $precioFinal = $this->getPrecio() - $this->getDescuento();

        return $precioFinal;
    }

    public function getDisponible() {
        $disponible = $this->getCupos() - $this->getEntradas();

        return $disponible;
    }

    public function __toString() {
        return (string) $this->getCupos();
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

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(int $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getTipoDescuento(): ?string
    {
        return $this->tipoDescuento;
    }

    public function setTipoDescuento(?string $tipoDescuento): self
    {
        $this->tipoDescuento = $tipoDescuento;

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

    public function getActividadZona(): ?ActividadZona
    {
        return $this->actividadZona;
    }

    public function setActividadZona(?ActividadZona $actividadZona): self
    {
        $this->actividadZona = $actividadZona;

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

    public function getActividadZonaPrecioDescuento(): ?ActividadZonaPrecioDescuento
    {
        return $this->actividadZonaPrecioDescuento;
    }

    public function setActividadZonaPrecioDescuento(?ActividadZonaPrecioDescuento $actividadZonaPrecioDescuento): self
    {
        $this->actividadZonaPrecioDescuento = $actividadZonaPrecioDescuento;

        // set (or unset) the owning side of the relation if necessary
        $newActividadZonaPrecio = $actividadZonaPrecioDescuento === null ? null : $this;
        if ($newActividadZonaPrecio !== $actividadZonaPrecioDescuento->getActividadZonaPrecio()) {
            $actividadZonaPrecioDescuento->setActividadZonaPrecio($newActividadZonaPrecio);
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

//      * @return Collection|ActividadEventoPrecio[]
     
    public function getEventoPrecios(): Collection
    {
        return $this->eventoPrecios;
    }

    public function addEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if (!$this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios[] = $eventoPrecio;
            $eventoPrecio->setActividadZonaPrecio($this);
        }

        return $this;
    }

    public function removeEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if ($this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios->removeElement($eventoPrecio);
            // set the owning side to null (unless already changed)
            if ($eventoPrecio->getActividadZonaPrecio() === $this) {
                $eventoPrecio->setActividadZonaPrecio(null);
            }
        }

        return $this;
    }

    public function getCambioManual(): ?\DateTimeInterface
    {
        return $this->cambioManual;
    }

    public function setCambioManual(?\DateTimeInterface $cambioManual): self
    {
        $this->cambioManual = $cambioManual;

        return $this;
    }

    public function getActividad(): ?Actividad
    {
        return $this->getTipoPrecio()->getActividad();
    }

}
