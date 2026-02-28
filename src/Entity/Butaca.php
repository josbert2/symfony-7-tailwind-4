<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Butaca
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idSvg;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombreSvg;

    #[ORM\Column(type: 'boolean')]
    private $bloqueado = false;

    #[ORM\Column(type: 'boolean')]
    private $vistaParcial = false;

    #[ORM\Column(type: 'boolean')]
    private $sillaRuedas = false;

    #[ORM\Column(type: 'boolean')]
    private $sillaRuedasCompania = false;

    #[ORM\ManyToOne(targetEntity: 'Zona', inversedBy: 'butacas')]
    protected $zona;

    #[ORM\OneToMany(targetEntity: 'ActividadEventoPrecio', mappedBy: 'butaca')]
    protected $eventoPrecios;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

//    public function getEntradas()
//    {
//
//    }
//
//    public function getDisponible() {
//        $disponible = $this->getCupos() - $this->getEntradas();
//
//        return $disponible;
//    }

    public function __construct()
    {
        $this->eventoPrecios = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombreSvg;
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

    public function getNombreSvg(): ?string
    {
        return $this->nombreSvg;
    }

    public function setNombreSvg(string $nombreSvg): self
    {
        $this->nombreSvg = $nombreSvg;

        return $this;
    }

    public function getBloqueado(): ?bool
    {
        return $this->bloqueado;
    }

    public function setBloqueado(bool $bloqueado): self
    {
        $this->bloqueado = $bloqueado;

        return $this;
    }

    public function getVistaParcial(): ?bool
    {
        return $this->vistaParcial;
    }

    public function setVistaParcial(bool $vistaParcial): self
    {
        $this->vistaParcial = $vistaParcial;

        return $this;
    }

    public function getSillaRuedas(): ?bool
    {
        return $this->sillaRuedas;
    }

    public function setSillaRuedas(bool $sillaRuedas): self
    {
        $this->sillaRuedas = $sillaRuedas;

        return $this;
    }

    public function getSillaRuedasCompania(): ?bool
    {
        return $this->sillaRuedasCompania;
    }

    public function setSillaRuedasCompania(bool $sillaRuedasCompania): self
    {
        $this->sillaRuedasCompania = $sillaRuedasCompania;

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

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): self
    {
        $this->zona = $zona;

        return $this;
    }

//      * @return Collection|ActividadEventoPrecio[]
     
    public function getEventoPrecios(): Collection
    {
        return $this->eventoPrecios;
    }

    public function addEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if (!$this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios[] = $eventoPrecio;
            $eventoPrecio->setButaca($this);
        }

        return $this;
    }

    public function removeEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if ($this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios->removeElement($eventoPrecio);
            // set the owning side to null (unless already changed)
            if ($eventoPrecio->getButaca() === $this) {
                $eventoPrecio->setButaca(null);
            }
        }

        return $this;
    }



}
