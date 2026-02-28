<?php

namespace App\Entity;

use App\Repository\EntradaEstadoRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: EntradaEstadoRepository::class)]
class EntradaEstado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'entradaEstados', targetEntity: Entrada::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $entrada;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razon;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\ManyToOne(inversedBy: 'entradaEstados', targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $responsableCambio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrada(): ?Entrada
    {
        return $this->entrada;
    }

    public function setEntrada(?Entrada $entrada): self
    {
        $this->entrada = $entrada;

        return $this;
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

    public function getRazon(): ?string
    {
        return $this->razon;
    }

    public function setRazon(string $razon): self
    {
        $this->razon = $razon;

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

    public function getResponsableCambio(): ?Usuario
    {
        return $this->responsableCambio;
    }

    public function setResponsableCambio(?Usuario $usuario): self
    {
        $this->responsableCambio = $usuario;

        return $this;
    }
}
