<?php

namespace App\Entity;

use App\Repository\DevolucionDineroRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: DevolucionDineroRepository::class)]
class DevolucionDinero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'devolucionDineros', targetEntity: Transaccion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $transaccion;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\Column(type: 'integer')]
    private $monto;

    #[ORM\Column(type: 'json')]
    private $origen = [];

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    private $updated;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $puntos;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comentario;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoAnulacion;

    #[ORM\ManyToOne(inversedBy: 'devolucionDineros', targetEntity: ClienteDatoBancario::class)]
    private $clienteDatoBancario;

    #[ORM\ManyToOne(inversedBy: 'devolucionDineros', targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $gestor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numeroTicketSoporte;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

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

    public function getPuntos(): ?int
    {
        return $this->puntos;
    }

    public function setPuntos(?int $puntos): self
    {
        $this->puntos = $puntos;

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

    public function getCodigoAnulacion(): ?string
    {
        return $this->codigoAnulacion;
    }

    public function setCodigoAnulacion(?string $codigoAnulacion): self
    {
        $this->codigoAnulacion = $codigoAnulacion;

        return $this;
    }

    public function getClienteDatoBancario(): ?ClienteDatoBancario
    {
        return $this->clienteDatoBancario;
    }

    public function setClienteDatoBancario(?ClienteDatoBancario $clienteDatoBancario): self
    {
        $this->clienteDatoBancario = $clienteDatoBancario;

        return $this;
    }

    public function getGestor(): ?Usuario
    {
        return $this->gestor;
    }

    public function setGestor(?Usuario $gestor): self
    {
        $this->gestor = $gestor;

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
}
