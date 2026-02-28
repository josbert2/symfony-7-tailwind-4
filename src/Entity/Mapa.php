<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Mapa
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'VichFile', inversedBy: 'mapa')]
     
    protected $imagen;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'mapas')]
    protected $proveedor;

    #[ORM\OneToMany(targetEntity: 'Zona', mappedBy: 'mapa', orphanRemoval: true)]
    protected $zonas;

    #[ORM\OneToMany(targetEntity: 'Actividad', mappedBy: 'mapa')]
    protected $actividades;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;



    public function setImagen(?VichFile $imagen): self
    {
        $imagen->setMapa($this);
        $this->imagen = $imagen;

        return $this;
    }

    public function __construct()
    {
        $this->zonas = new ArrayCollection();
        $this->actividades = new ArrayCollection();
    }

    public function __toString() {
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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * @return Collection|Zona[]

    public function getZonas(): Collection
    {
        return $this->zonas;
    }

    public function addZona(Zona $zona): self
    {
        if (!$this->zonas->contains($zona)) {
            $this->zonas[] = $zona;
            $zona->setMapa($this);
        }

        return $this;
    }

    public function removeZona(Zona $zona): self
    {
        if ($this->zonas->contains($zona)) {
            $this->zonas->removeElement($zona);
            // set the owning side to null (unless already changed)
            if ($zona->getMapa() === $this) {
                $zona->setMapa(null);
            }
        }

        return $this;
    }

//      * @return Collection|Actividad[]

    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividad $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->setMapa($this);
        }

        return $this;
    }

    public function removeActividade(Actividad $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
            // set the owning side to null (unless already changed)
            if ($actividade->getMapa() === $this) {
                $actividade->setMapa(null);
            }
        }

        return $this;
    }

}
