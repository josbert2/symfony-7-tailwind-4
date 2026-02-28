<?php

namespace App\Entity;

use App\Repository\InfoMetodoPagoRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: InfoMetodoPagoRepository::class)]
class InfoMetodoPago
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'infoMetodoPagos', targetEntity: Transaccion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $transaccion;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;

    #[ORM\Column(type: 'text')]
    private $data;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'string', length: 255)]
    private $proceso;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransaccion(): ?Transaccion
    {
        return $this->transaccion;
    }

    public function setTransaccion(?Transaccion $transaccion): self
    {
        $this->transaccion = $transaccion;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

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

    public function getProceso(): ?string
    {
        return $this->proceso;
    }

    public function setProceso(string $proceso): self
    {
        $this->proceso = $proceso;

        return $this;
    }
}
