<?php

namespace App\Entity;

use App\Repository\LocalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: LocalRepository::class)]
class Local
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $direccion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Staff', inversedBy: 'locales')]
    #[ORM\JoinColumn(nullable: false)]
    private $administrador;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $correo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $urlResena;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: Actividad::class)]
    private $actividads;

    #[ORM\OneToMany(mappedBy: 'local', targetEntity: LocalHorario::class)]
    private $localHorarios;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    private $updated;

    public function __construct()
    {
        $this->actividads = new ArrayCollection();
        $this->localHorarios = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getAdministrador(): ?Staff
    {
        return $this->administrador;
    }

    public function setAdministrador(?Staff $administrador): self
    {
        $this->administrador = $administrador;

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

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(?string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

//      * @return Collection|Actividad[]

    public function getActividades(): Collection
    {
        return $this->actividads;
    }

    public function addActividad(Actividad $actividad): self
    {
        if (!$this->actividads->contains($actividad)) {
            $this->actividads[] = $actividad;
            $actividad->setLocal($this);
        }

        return $this;
    }

    public function removeActividad(Actividad $actividad): self
    {
        if ($this->actividads->removeElement($actividad)) {
            // set the owning side to null (unless already changed)
            if ($actividad->getLocal() === $this) {
                $actividad->setLocal(null);
            }
        }

        return $this;
    }

//      * @return Collection|LocalHorario[]

    public function getLocalHorarios(): Collection
    {
        return $this->localHorarios;
    }

    public function addLocalHorario(LocalHorario $localHorario): self
    {
        if (!$this->localHorarios->contains($localHorario)) {
            $this->localHorarios[] = $localHorario;
            $localHorario->setLocal($this);
        }

        return $this;
    }

    public function removeLocalHorario(LocalHorario $localHorario): self
    {
        if ($this->localHorarios->removeElement($localHorario)) {
            // set the owning side to null (unless already changed)
            if ($localHorario->getLocal() === $this) {
                $localHorario->setLocal(null);
            }
        }

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

//      * @return Collection|Actividad[]

    public function getActividads(): Collection
    {
        return $this->actividads;
    }

    public function getUrlResena(): ?string
    {
        return $this->urlResena;
    }

    public function setUrlResena(?string $urlResena): self
    {
        $this->urlResena = $urlResena;

        return $this;
    }
}
