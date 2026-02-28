<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: App\Repository\TransaccionDetalleEstadoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class TransaccionDetalleEstado
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\TransaccionDetalle', inversedBy: 'estados')]
    protected $transaccionDetalle;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

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

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

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

    public function getTransaccionDetalle(): ?TransaccionDetalle
    {
        return $this->transaccionDetalle;
    }

    public function setTransaccionDetalle(?TransaccionDetalle $transaccionDetalle): self
    {
        $this->transaccionDetalle = $transaccionDetalle;

        return $this;
    }

}
