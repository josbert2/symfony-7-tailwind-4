<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity()]
class ActividadOmision
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'omisiones')]
    protected $actividad;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set fecha.

//      * @param \DateTime $fecha

//      * @return ActividadOmision

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

//      * Get fecha.

//      * @return \DateTime

    public function getFecha()
    {
        return $this->fecha;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return ActividadOmision

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

//      * @return ActividadOmision

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

//      * Set actividad.

//      * @param \App\Entity\Actividad|null $actividad

//      * @return ActividadOmision

    public function setActividad(\App\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

//      * Get actividad.

//      * @return \App\Entity\Actividad|null

    public function getActividad()
    {
        return $this->actividad;
    }
}
