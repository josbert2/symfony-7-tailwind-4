<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity()]
class Pais
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\OneToMany(targetEntity: 'Region', mappedBy: 'pais')]
    protected $regiones;

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
        $this->regiones = new \Doctrine\Common\Collections\ArrayCollection();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return Pais

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

//      * Set created.

//      * @param \DateTime $created

//      * @return Pais

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

//      * @return Pais

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

//      * Add regione.

//      * @param \App\Entity\Region $regione

//      * @return Pais

    public function addRegione(\App\Entity\Region $regione)
    {
        $this->regiones[] = $regione;

        return $this;
    }

//      * Remove regione.

//      * @param \App\Entity\Region $regione

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeRegione(\App\Entity\Region $regione)
    {
        return $this->regiones->removeElement($regione);
    }

//      * Get regiones.

//      * @return \Doctrine\Common\Collections\Collection

    public function getRegiones()
    {
        return $this->regiones;
    }
}
