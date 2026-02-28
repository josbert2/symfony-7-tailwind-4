<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class ActividadFoto
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $idMarket;

    #[ORM\Column(type: 'text', nullable: true)]
    private $urlMarket;

//      * @Assert\Valid
    #[ORM\ManyToOne(targetEntity: 'VichFile', inversedBy: 'actividadFotos')]

    protected $imagen;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'fotos')]
    protected $actividad;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'actividadFotos')]
    protected $market;

    public function __toString()
    {
        if($this->getImagen()){
            return $this->getImagen()->getOriginalName().$this->getActividad()->getId();
        }
        else{
            return 'sin-imagen'.$this->getActividad()->getId();
        }
    }

//      * Set imagen.

//      * @param \App\Entity\VichFile|null $imagen

//      * @return Nino

    public function setImagen(\App\Entity\VichFile $imagen = null)
    {
        $imagen->addActividadFoto($this);
        $this->imagen = $imagen;

        return $this;
    }

//      * Get id

//      * @return integer

    public function getId()
    {
        return $this->id;
    }

//      * Set created

//      * @param \DateTime $created

//      * @return ActividadFoto

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

//      * Get created

//      * @return \DateTime

    public function getCreated()
    {
        return $this->created;
    }

//      * Set updated

//      * @param \DateTime $updated

//      * @return ActividadFoto

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

//      * Get updated

//      * @return \DateTime

    public function getUpdated()
    {
        return $this->updated;
    }

//      * Get imagen

//      * @return \App\Entity\VichFile

    public function getImagen()
    {
        return $this->imagen;
    }

//      * Set actividad

//      * @param \App\Entity\Actividad $actividad

//      * @return ActividadFoto

    public function setActividad(\App\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

//      * Get actividad

//      * @return \App\Entity\Actividad

    public function getActividad()
    {
        return $this->actividad;
    }

    public function getIdMarket(): ?string
    {
        return $this->idMarket;
    }

    public function setIdMarket(?string $idMarket): self
    {
        $this->idMarket = $idMarket;

        return $this;
    }

    public function getUrlMarket(): ?string
    {
        return $this->urlMarket;
    }

    public function setUrlMarket(?string $urlMarket): self
    {
        $this->urlMarket = $urlMarket;

        return $this;
    }

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        $this->market = $market;
        return $this;
    }
}
