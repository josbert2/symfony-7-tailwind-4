<?php

namespace App\Entity;

use App\Repository\IndemnizacionRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: IndemnizacionRepository::class)]
class Indemnizacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\ManyToOne(inversedBy: 'indemnizacions', targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $gestor;

    #[ORM\Column(type: 'json')]
    private $origen = [];

    #[ORM\ManyToOne(inversedBy: 'indemnizacions', targetEntity: Transaccion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $transaccion;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $monto;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $puntos;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numeroTicketSoporte;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    private $updated;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comentario;

    #[ORM\OneToOne(inversedBy: 'indemnizacion', targetEntity: Paquete::class)]
    private $paqueteAsociado;

    #[ORM\OneToOne(targetEntity: DevolucionDinero::class)]
    private $devolucionDinero;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numeroFactura;

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

    public function getGestor(): ?usuario
    {
        return $this->gestor;
    }

    public function setGestor(?usuario $gestor): self
    {
        $this->gestor = $gestor;

        return $this;
    }

    public function getOrigen(): ?array
    {
        return $this->origen;
    }

    public function setOrigen(array $origen): self
    {
        $this->origen = $origen;

        return $this;
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

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(?int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getPuntos(): ?int
    {
        return $this->puntos;
    }

    public function setPuntos(?int $puntos): self
    {
        $this->puntos = $puntos;

        return $this;
    }

    public function getNumeroTicketSoporte(): ?string
    {
        return $this->numeroTicketSoporte;
    }

    public function setNumeroTicketSoporte(?string $numeroTicketSoporte): self
    {
        $this->numeroTicketSoporte = $numeroTicketSoporte;

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

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getPaqueteAsociado(): ?Paquete
    {
        return $this->paqueteAsociado;
    }

    public function setPaqueteAsociado(?Paquete $paqueteAsociado): self
    {
        $this->paqueteAsociado = $paqueteAsociado;

        return $this;
    }

    public function getDevolucionDinero(): ?DevolucionDinero
    {
        return $this->devolucionDinero;
    }

    public function setDevolucionDinero(?DevolucionDinero $devolucionDinero): self
    {
        $this->devolucionDinero = $devolucionDinero;

        return $this;
    }

    public function getNumeroFactura(): ?string
    {
        return $this->numeroFactura;
    }

    public function setNumeroFactura(?string $numeroFactura): self
    {
        $this->numeroFactura = $numeroFactura;

        return $this;
    }
}
