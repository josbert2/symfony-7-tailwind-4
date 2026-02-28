<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class Cuidador
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $rut;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $email;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $telefono;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = true;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'VichFile', inversedBy: 'cuidador')]

    protected $imagen;

    #[ORM\ManyToOne(targetEntity: 'Cliente', inversedBy: 'cuidadores')]
    protected $cliente;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

//      * Set imagen.

//      * @param \App\Entity\VichFile|null $imagen

//      * @return Cuidador

    public function setImagen(\App\Entity\VichFile $imagen = null)
    {
        $imagen->setCuidador($this);
        $this->imagen = $imagen;

        return $this;
    }

    public function __toString() {
        return $this->nombre.' '.$this->apellido;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return Cuidador

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

//      * Set apellido.

//      * @param string $apellido

//      * @return Cuidador

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

//      * Get apellido.

//      * @return string

    public function getApellido()
    {
        return $this->apellido;
    }

//      * Set rut.

//      * @param string $rut

//      * @return Cuidador

    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

//      * Get rut.

//      * @return string

    public function getRut()
    {
        return $this->rut;
    }

//      * Set email.

//      * @param string $email

//      * @return Cuidador

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

//      * Get email.

//      * @return string

    public function getEmail()
    {
        return $this->email;
    }

//      * Set telefono.

//      * @param string $telefono

//      * @return Cuidador

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

//      * Get telefono.

//      * @return string

    public function getTelefono()
    {
        return $this->telefono;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Cuidador

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

//      * @return Cuidador

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

//      * Set cliente.

//      * @param \App\Entity\Cliente|null $cliente

//      * @return Cuidador

    public function setCliente(\App\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

//      * Get cliente.

//      * @return \App\Entity\Cliente|null

    public function getCliente()
    {
        return $this->cliente;
    }

//      * Get imagen.

//      * @return \App\Entity\VichFile|null

    public function getImagen()
    {
        return $this->imagen;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return Cuidador

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
}
