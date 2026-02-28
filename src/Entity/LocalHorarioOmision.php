<?php

namespace App\Entity;

use App\Repository\LocalHorarioOmisionRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: LocalHorarioOmisionRepository::class)]
class LocalHorarioOmision
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'localHorarioOmisions', targetEntity: LocalHorario::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $localHorario;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalHorario(): ?LocalHorario
    {
        return $this->localHorario;
    }

    public function setLocalHorario(?LocalHorario $localHorario): self
    {
        $this->localHorario = $localHorario;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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
}
