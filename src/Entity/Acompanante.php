<?php

namespace App\Entity;

use App\Repository\AcompananteRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

    #[ORM\Entity(repositoryClass: AcompananteRepository::class)]
class Acompanante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'acompanantes', targetEntity: Cliente::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $cliente;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rut;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $direccion;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $familiar;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaNacimiento;

    #[ORM\OneToMany(targetEntity: 'Asistente', mappedBy: 'acompanante')]
    protected $asistentes;

    #[ORM\Column(type: 'text', nullable: true)]
    private $customData;

    public function __construct()
    {
        $this->asistentes = new ArrayCollection();
    }

    public function __toString() {
        $data = '';
        if($this->nombre) {
            $data = $this->nombre;
        }
        if(!$data && $this->email) {
            $data = $this->email;
        }
        if(!$data && $this->rut) {
            $data = $this->rut;
        }
        return $data;
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

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(?string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getFamiliar(): ?bool
    {
        return $this->familiar;
    }

    public function setFamiliar(?bool $familiar): self
    {
        $this->familiar = $familiar;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

//      * @return Collection|Entrada[]

    public function getAsistentes(): Collection
    {
        return $this->asistentes;
    }

    public function addAsistente(Asistente $asistente): self
    {
        if (!$this->asistentes->contains($asistente)) {
            $this->asistentes[] = $asistente;
            $asistente->setAcompanante($this);
        }

        return $this;
    }

    public function removeAsistente(Asistente $asistente): self
    {
        if ($this->asistentes->removeElement($asistente)) {
            // set the owning side to null (unless already changed)
            if ($asistente->getAcompanante() === $this) {
                $asistente->setAcompanante(null);
            }
        }

        return $this;
    }

    public function getCustomData()
    {
        return $this->customData;
    }

    public function setCustomData(?string $customData): self
    {
        $this->customData = $customData;
        return $this;
    }
}
