<?php

namespace App\Entity;

use App\Repository\PendienteActualizacionCacheRepository;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: PendienteActualizacionCacheRepository::class)]
class PendienteActualizacionCache
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private $actividadId;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $actualizarCache;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $actualizarEstadistica;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $actualizarCacheBoleteria;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActividadId(): ?int
    {
        return $this->actividadId;
    }

    public function setActividadId(int $actividadId): self
    {
        $this->actividadId = $actividadId;

        return $this;
    }

    public function getActualizarCache(): ?int
    {
        return $this->actualizarCache;
    }

    public function setActualizarCache(?int $actualizarCache): self
    {
        $this->actualizarCache = $actualizarCache;

        return $this;
    }

    public function getActualizarEstadistica(): ?int
    {
        return $this->actualizarEstadistica;
    }

    public function setActualizarEstadistica(?int $actualizarEstadistica): self
    {
        $this->actualizarEstadistica = $actualizarEstadistica;

        return $this;
    }

    public function getActualizarCacheBoleteria(): ?bool
    {
        return $this->actualizarCacheBoleteria;
    }

    public function setActualizarCacheBoleteria(?bool $actualizarCacheBoleteria): self
    {
        $this->actualizarCacheBoleteria = $actualizarCacheBoleteria;

        return $this;
    }
}
