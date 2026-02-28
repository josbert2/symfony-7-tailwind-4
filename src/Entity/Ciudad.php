<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\CiudadRepository::class)]
class Ciudad
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;
    
    #[ORM\Column(name: 'activo', type: 'boolean')]
    private $activo = true;

    #[ORM\ManyToOne(targetEntity: 'Region', inversedBy: 'ciudades')]
    protected $region;
    
    #[ORM\OneToMany(targetEntity: 'Comuna', mappedBy: 'ciudad')]
    protected $comunas;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function __toString() {
        return $this->nombre;
    }

//      * Constructor

    public function __construct()
    {
        $this->comunas = new \Doctrine\Common\Collections\ArrayCollection();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return Ciudad

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

//      * Get nombre.

//      * @return string

    public function getNombre()
    {
        return $this->nombre;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return Ciudad

    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

//      * Get activo.

//      * @return bool

    public function getActivo()
    {
        return $this->activo;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Ciudad

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

//      * Get created.

//      * @return \DateTime

    public function getCreated()
    {
        return $this->created;
    }

//      * Set updated.

//      * @param \DateTime $updated

//      * @return Ciudad

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

//      * Get updated.

//      * @return \DateTime

    public function getUpdated()
    {
        return $this->updated;
    }

//      * Set region.

//      * @param \App\Entity\Region|null $region

//      * @return Ciudad

    public function setRegion(\App\Entity\Region $region = null)
    {
        $this->region = $region;

        return $this;
    }

//      * Get region.

//      * @return \App\Entity\Region|null

    public function getRegion()
    {
        return $this->region;
    }

//      * Add comuna.

//      * @param \App\Entity\Comuna $comuna

//      * @return Ciudad

    public function addComuna(\App\Entity\Comuna $comuna)
    {
        $this->comunas[] = $comuna;

        return $this;
    }

//      * Remove comuna.

//      * @param \App\Entity\Comuna $comuna

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeComuna(\App\Entity\Comuna $comuna)
    {
        return $this->comunas->removeElement($comuna);
    }

//      * Get comunas.

//      * @return \Doctrine\Common\Collections\Collection

    public function getComunas()
    {
        return $this->comunas;
    }
}
