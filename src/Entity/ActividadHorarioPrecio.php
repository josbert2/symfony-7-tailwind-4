<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadHorarioPrecio
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $precio = 0;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoDescuento;

    #[ORM\ManyToOne(targetEntity: 'ActividadHorario', inversedBy: 'precios')]
    protected $actividadHorario;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'horarioPrecios')]
    protected $tipoPrecio;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __toString() {
        return $this->cupos;
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

    public function getActividadHorario(): ?ActividadHorario
    {
        return $this->actividadHorario;
    }

    public function setActividadHorario(?ActividadHorario $actividadHorario): self
    {
        $this->actividadHorario = $actividadHorario;

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

}
