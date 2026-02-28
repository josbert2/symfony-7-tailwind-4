<?php

namespace App\Entity;

use App\Repository\LocalHorarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity(repositoryClass: LocalHorarioRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class LocalHorario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'localHorarios', targetEntity: Local::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $local;

    #[ORM\Column(type: 'string')]
    private $horaInicio;

    #[ORM\Column(type: 'string')]
    private $horaTermino;

    #[ORM\Column(type: 'integer')]
    private $cupos;

    #[ORM\Column(type: 'json')]
    private $dias = [];

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    private $updated;

    #[ORM\OneToMany(mappedBy: 'localHorario', targetEntity: LocalHorarioOmision::class)]
    private $localHorarioOmisions;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;

    #[ORM\Column(type: 'datetime')]
    private $fechaInicio;

    #[ORM\Column(type: 'datetime')]
    private $fechaTermino;

    public function __construct()
    {
        $this->localHorarioOmisions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getHoraInicio(): ?string
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(string $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraTermino(): ?string
    {
        return $this->horaTermino;
    }

    public function setHoraTermino(string $horaTermino): self
    {
        $this->horaTermino = $horaTermino;

        return $this;
    }

    public function getCupos(): ?int
    {
        return $this->cupos;
    }

    public function setCupos(int $cupos): self
    {
        $this->cupos = $cupos;

        return $this;
    }

    public function getDias(): ?array
    {
        return $this->dias;
    }

    public function setDias(array $dias): self
    {
        $this->dias = $dias;

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

//      * @return Collection|LocalHorarioOmision[]
     
    public function getLocalHorarioOmisions(): Collection
    {
        return $this->localHorarioOmisions;
    }

    public function addLocalHorarioOmision(LocalHorarioOmision $localHorarioOmision): self
    {
        if (!$this->localHorarioOmisions->contains($localHorarioOmision)) {
            $this->localHorarioOmisions[] = $localHorarioOmision;
            $localHorarioOmision->setLocalHorario($this);
        }

        return $this;
    }

    public function removeLocalHorarioOmision(LocalHorarioOmision $localHorarioOmision): self
    {
        if ($this->localHorarioOmisions->removeElement($localHorarioOmision)) {
            // set the owning side to null (unless already changed)
            if ($localHorarioOmision->getLocalHorario() === $this) {
                $localHorarioOmision->setLocalHorario(null);
            }
        }

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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaTermino(): ?\DateTimeInterface
    {
        return $this->fechaTermino;
    }

    public function setFechaTermino(\DateTimeInterface $fechaTermino): self
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }
}
