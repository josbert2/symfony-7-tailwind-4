<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OrderBy;

    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadReglaValidacionDias
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'array')]
    private $diasCompra;

    #[ORM\Column(type: 'array')]
    private $diasAsistencia;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ActividadReglaValidacion', inversedBy: 'dias')]
    protected $actividadReglaValidacion;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiasCompra(): ?array
    {
        return $this->diasCompra;
    }

    public function setDiasCompra(array $diasCompra): self
    {
        $this->diasCompra = $diasCompra;

        return $this;
    }

    public function getDiasAsistencia(): ?array
    {
        return $this->diasAsistencia;
    }

    public function setDiasAsistencia(array $diasAsistencia): self
    {
        $this->diasAsistencia = $diasAsistencia;

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

    public function getActividadReglaValidacion(): ?ActividadReglaValidacion
    {
        return $this->actividadReglaValidacion;
    }

    public function setActividadReglaValidacion(?ActividadReglaValidacion $actividadReglaValidacion): self
    {
        $this->actividadReglaValidacion = $actividadReglaValidacion;

        return $this;
    }


}
