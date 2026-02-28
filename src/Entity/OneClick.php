<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\OneClickRepository::class)]
class OneClick
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'id_transbank', type: 'string', length: 255)]
    private $idTransbank;
    
    #[ORM\Column(name: 'digitos', type: 'string', length: 255)]
    private $digitos;
    
    #[ORM\Column(name: 'tipo', type: 'string', length: 255)]
    private $tipo;
    
    #[ORM\Column(name: 'codigo', type: 'string', length: 255)]
    private $codigo;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = true;
    
    #[ORM\ManyToOne(targetEntity: 'Cliente', inversedBy: 'oneClicks')]
    protected $cliente;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __toString()
    {
        return $this->tipo.' XXXX '.$this->digitos;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set idTransbank.

//      * @param string $idTransbank

//      * @return OneClick

    public function setIdTransbank($idTransbank)
    {
        $this->idTransbank = $idTransbank;

        return $this;
    }

//      * Get idTransbank.

//      * @return string

    public function getIdTransbank()
    {
        return $this->idTransbank;
    }

//      * Set digitos.

//      * @param string $digitos

//      * @return OneClick

    public function setDigitos($digitos)
    {
        $this->digitos = $digitos;

        return $this;
    }

//      * Get digitos.

//      * @return string

    public function getDigitos()
    {
        return $this->digitos;
    }

//      * Set tipo.

//      * @param string $tipo

//      * @return OneClick

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

//      * Set codigo.

//      * @param string $codigo

//      * @return OneClick

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

//      * Get codigo.

//      * @return string

    public function getCodigo()
    {
        return $this->codigo;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return OneClick

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

//      * @return OneClick

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

//      * @return OneClick

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

//      * @return OneClick

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

//      * Set deleted.

//      * @param \DateTime|null $deleted

//      * @return OneClick

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
}
