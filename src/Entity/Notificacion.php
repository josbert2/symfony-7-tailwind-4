<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class Notificacion
{
    #[ORM\Column(type: 'integer')]
    protected $id;
    
    #[ORM\Column(type: 'text')]
    private $mensaje;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;
    
    #[ORM\Column(type: 'boolean')]
    private $leida = false;

    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'notificaciones')]
    protected $usuario;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function __toString()
    {
        return $this->mensaje;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set mensaje.

//      * @param string $mensaje

//      * @return Notificacion

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

//      * Get mensaje.

//      * @return string

    public function getMensaje()
    {
        return $this->mensaje;
    }

//      * Set tipo.

//      * @param string $tipo

//      * @return Notificacion

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

//      * Get tipo.

//      * @return string

    public function getTipo()
    {
        return $this->tipo;
    }

//      * Set leida.

//      * @param bool $leida

//      * @return Notificacion

    public function setLeida($leida)
    {
        $this->leida = $leida;

        return $this;
    }

//      * Get leida.

//      * @return bool

    public function getLeida()
    {
        return $this->leida;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Notificacion

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

//      * @return Notificacion

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

//      * Set usuario.

//      * @param \App\Entity\Usuario|null $usuario

//      * @return Notificacion

    public function setUsuario(\App\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

//      * Get usuario.

//      * @return \App\Entity\Usuario|null

    public function getUsuario()
    {
        return $this->usuario;
    }
}
