<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class ActividadHorarioOmision
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha;

    #[ORM\ManyToOne(targetEntity: 'ActividadHorario', inversedBy: 'omisiones')]
    protected $actividadHorario;

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

//      * @return ActividadHorarioOmision

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

//      * @return ActividadHorarioOmision

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

//      * @return ActividadHorarioOmision

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

//      * Set actividadHorario.

//      * @param \App\Entity\ActividadHorario|null $actividadHorario

//      * @return ActividadHorarioOmision

    public function setActividadHorario(\App\Entity\ActividadHorario $actividadHorario = null)
    {
        $this->actividadHorario = $actividadHorario;

        return $this;
    }

//      * Get actividadHorario.

//      * @return \App\Entity\ActividadHorario|null

    public function getActividadHorario()
    {
        return $this->actividadHorario;
    }
}
