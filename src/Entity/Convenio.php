<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class Convenio
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $responsable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaInicio;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaTermino;
    
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Promocion', mappedBy: 'convenios')]
    protected $promociones;

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
        $this->promociones = new \Doctrine\Common\Collections\ArrayCollection();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return Convenio

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

//      * Set responsable.

//      * @param string|null $responsable

//      * @return Convenio

    public function setResponsable($responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

//      * Get responsable.

//      * @return string|null

    public function getResponsable()
    {
        return $this->responsable;
    }

//      * Set email.

//      * @param string|null $email

//      * @return Convenio

    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

//      * Get email.

//      * @return string|null

    public function getEmail()
    {
        return $this->email;
    }

//      * Set telefono.

//      * @param string|null $telefono

//      * @return Convenio

    public function setTelefono($telefono = null)
    {
        $this->telefono = $telefono;

        return $this;
    }

//      * Get telefono.

//      * @return string|null

    public function getTelefono()
    {
        return $this->telefono;
    }

//      * Set fechaInicio.

//      * @param \DateTime|null $fechaInicio

//      * @return Convenio

    public function setFechaInicio($fechaInicio = null)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

//      * Get fechaInicio.

//      * @return \DateTime|null

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

//      * Set fechaTermino.

//      * @param \DateTime|null $fechaTermino

//      * @return Convenio

    public function setFechaTermino($fechaTermino = null)
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }

//      * Get fechaTermino.

//      * @return \DateTime|null

    public function getFechaTermino()
    {
        return $this->fechaTermino;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Convenio

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

//      * @return Convenio

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

//      * Add promocione.

//      * @param \App\Entity\Promocion $promocione

//      * @return Convenio

    public function addPromocione(\App\Entity\Promocion $promocione)
    {
        $this->promociones[] = $promocione;

        return $this;
    }

//      * Remove promocione.

//      * @param \App\Entity\Promocion $promocione

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removePromocione(\App\Entity\Promocion $promocione)
    {
        return $this->promociones->removeElement($promocione);
    }

//      * Get promociones.

//      * @return \Doctrine\Common\Collections\Collection

    public function getPromociones()
    {
        return $this->promociones;
    }
}
