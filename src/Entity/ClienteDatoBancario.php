<?php

namespace App\Entity;

use App\Repository\ClienteDatoBancarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: ClienteDatoBancarioRepository::class)]
class ClienteDatoBancario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido;

    #[ORM\Column(type: 'string', length: 255)]
    private $rut;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $telefono;

    #[ORM\Column(type: 'string', length: 255)]
    private $banco;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipoCuenta;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroCuenta;

    #[ORM\Column(type: 'integer')]
    private $cuentaPorDefecto;

    #[ORM\ManyToOne(inversedBy: 'clienteDatoBancarios', targetEntity: Cliente::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $cliente;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;

    #[ORM\OneToMany(mappedBy: 'clienteDatoBancario', targetEntity: DevolucionDinero::class)]
    private $devolucionDineros;

    public function __construct()
    {
        $this->devolucionDineros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getBanco(): ?string
    {
        return $this->banco;
    }

    public function setBanco(string $banco): self
    {
        $this->banco = $banco;

        return $this;
    }

    public function getTipoCuenta(): ?string
    {
        return $this->tipoCuenta;
    }

    public function setTipoCuenta(string $tipoCuenta): self
    {
        $this->tipoCuenta = $tipoCuenta;

        return $this;
    }

    public function getNumeroCuenta(): ?string
    {
        return $this->numeroCuenta;
    }

    public function setNumeroCuenta(string $numeroCuenta): self
    {
        $this->numeroCuenta = $numeroCuenta;

        return $this;
    }

    public function getCuentaPorDefecto(): ?int
    {
        return $this->cuentaPorDefecto;
    }

    public function setCuentaPorDefecto(int $cuentaPorDefecto): self
    {
        $this->cuentaPorDefecto = $cuentaPorDefecto;

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

//      * @return Collection|DevolucionDinero[]

    public function getDevolucionDineros(): Collection
    {
        return $this->devolucionDineros;
    }

    public function addDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if (!$this->devolucionDineros->contains($devolucionDinero)) {
            $this->devolucionDineros[] = $devolucionDinero;
            $devolucionDinero->setClienteDatoBancario($this);
        }

        return $this;
    }

    public function removeDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if ($this->devolucionDineros->removeElement($devolucionDinero)) {
            // set the owning side to null (unless already changed)
            if ($devolucionDinero->getClienteDatoBancario() === $this) {
                $devolucionDinero->setClienteDatoBancario(null);
            }
        }

        return $this;
    }
}
