<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class TipoPrecio
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

//    /**
     */
//     * #[ORM\OneToMany(targetEntity: 'ActividadTipoPrecio', mappedBy: 'tiposPrecio')]
// //     */
//    protected $actividadTiposPrecio;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function __toString() {
        return $this->nombre;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return TipoPrecio

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

//      * @return TipoPrecio

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

//      * @return TipoPrecio

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

//      * Add actividadTiposPrecio.

//      * @param \App\Entity\ActividadTipoPrecio $actividadTiposPrecio

//      * @return TipoPrecio

    public function addActividadTiposPrecio(\App\Entity\ActividadTipoPrecio $actividadTiposPrecio)
    {
        $this->actividadTiposPrecio[] = $actividadTiposPrecio;

        return $this;
    }

//      * Remove actividadTiposPrecio.

//      * @param \App\Entity\ActividadTipoPrecio $actividadTiposPrecio

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeActividadTiposPrecio(\App\Entity\ActividadTipoPrecio $actividadTiposPrecio)
    {
        return $this->actividadTiposPrecio->removeElement($actividadTiposPrecio);
    }

//      * Get actividadTiposPrecio.

//      * @return \Doctrine\Common\Collections\Collection

    public function getActividadTiposPrecio()
    {
        return $this->actividadTiposPrecio;
    }
}
