<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Zona
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idSvg;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombreSvg;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'VichFile', inversedBy: 'zona')]
     
    protected $imagen;

    #[ORM\ManyToOne(targetEntity: 'Mapa', inversedBy: 'zonas')]
    protected $mapa;

    #[ORM\OneToMany(targetEntity: 'Butaca', mappedBy: 'zona')]
    protected $butacas;

    #[ORM\OneToMany(targetEntity: 'ActividadZona', mappedBy: 'zona')]
    protected $actividades;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __construct()
    {
        $this->butacas = new ArrayCollection();
        $this->actividades = new ArrayCollection();
    }

    public function setImagen(?VichFile $imagen): self
    {
        $imagen->setZona($this);
        $this->imagen = $imagen;

        return $this;
    }

    public function setCupos(?int $cupos): self
    {
        if(!$cupos){
            $cupos = 0;
        }
        $this->cupos = $cupos;

        return $this;
    }

    public function addButaca(Butaca $butaca): self
    {
        if (!$butaca->getZona()) {
            $butaca->setZona($this);
        }
        $this->butacas[] = $butaca;

        return $this;
    }

    public function removeButaca(Butaca $butaca): self
    {
        if ($butaca->getZona() == $this) {
            $this->butacas->removeElement($butaca);
            // set the owning side to null (unless already changed)
            if ($butaca->getZona() === $this) {
                $butaca->setZona(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSvg(): ?string
    {
        return $this->idSvg;
    }

    public function setIdSvg(?string $idSvg): self
    {
        $this->idSvg = $idSvg;

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

    public function getCupos(): ?int
    {
        return $this->cupos;
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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getImagen(): ?VichFile
    {
        return $this->imagen;
    }

    public function getMapa(): ?Mapa
    {
        return $this->mapa;
    }

    public function setMapa(?Mapa $mapa): self
    {
        $this->mapa = $mapa;

        return $this;
    }

//      * @return Collection|Butaca[]

    public function getButacas(): Collection
    {
        return $this->butacas;
    }

//      * @return Collection|ActividadZona[]

    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(ActividadZona $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->setZona($this);
        }

        return $this;
    }

    public function removeActividade(ActividadZona $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
            // set the owning side to null (unless already changed)
            if ($actividade->getZona() === $this) {
                $actividade->setZona(null);
            }
        }

        return $this;
    }

    public function getNombreSvg(): ?string
    {
        return $this->nombreSvg;
    }

    public function setNombreSvg(?string $nombreSvg): self
    {
        $this->nombreSvg = $nombreSvg;

        return $this;
    }

}
