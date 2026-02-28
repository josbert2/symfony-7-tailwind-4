<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Dispositivo
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
	
    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;
	
    #[ORM\Column(type: 'boolean')]
    private $activo = true;
    
    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'dispositivos')]
    protected $usuario;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set tipo.

//      * @param string $tipo

//      * @return Dispositivo

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

//      * Set token.

//      * @param string|null $token

//      * @return Dispositivo

    public function setToken($token = null)
    {
        $this->token = $token;

        return $this;
    }

//      * Get token.

//      * @return string|null

    public function getToken()
    {
        return $this->token;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return Dispositivo

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

//      * @return Dispositivo

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

//      * @return Dispositivo

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

//      * Set deleted.

//      * @param \DateTime|null $deleted

//      * @return Dispositivo

    public function setDeleted($deleted = null)
    {
        $this->deleted = $deleted;

        return $this;
    }

//      * Get deleted.

//      * @return \DateTime|null

    public function getDeleted()
    {
        return $this->deleted;
    }

//      * Set usuario.

//      * @param \App\Entity\Usuario|null $usuario

//      * @return Dispositivo

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
