<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deletedAt')]

class Nino
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido;
    
    #[ORM\Column(type: 'date', length: 255, nullable: true)]
    private $fechaNacimiento;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = true;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'VichFile', inversedBy: 'nino')]
     
    protected $imagen;

    #[ORM\ManyToOne(targetEntity: 'Cliente', inversedBy: 'ninos')]
    protected $cliente;
    
    #[ORM\OneToMany(targetEntity: 'Entrada', mappedBy: 'nino')]
    protected $entradas;
    
    #[ORM\ManyToMany(targetEntity: 'Item', mappedBy: 'ninos')]
    protected $items;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deletedAt;

    public function __toString() {
        return $this->nombre.' '.$this->apellido;
    }

//      * Set imagen.

//      * @param \App\Entity\VichFile|null $imagen

//      * @return Nino

    public function setImagen(\App\Entity\VichFile $imagen = null)
    {
        $imagen->setNino($this);
        $this->imagen = $imagen;

        return $this;
    }

//      * Constructor

    public function __construct()
    {
        $this->entradas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return Nino

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

//      * @return Nino

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

//      * Set fechaNacimiento.

//      * @param \DateTime|null $fechaNacimiento

//      * @return Nino

    public function setFechaNacimiento($fechaNacimiento = null)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

//      * Get fechaNacimiento.

//      * @return \DateTime|null

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return Nino

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

//      * @return Nino

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

//      * @return Nino

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

//      * Get imagen.

//      * @return \App\Entity\VichFile|null

    public function getImagen()
    {
        return $this->imagen;
    }

//      * Set cliente.

//      * @param \App\Entity\Cliente|null $cliente

//      * @return Nino

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

//      * Add entrada.

//      * @param \App\Entity\Entrada $entrada

//      * @return Nino

    public function addEntrada(\App\Entity\Entrada $entrada)
    {
        $this->entradas[] = $entrada;

        return $this;
    }

//      * Remove entrada.

//      * @param \App\Entity\Entrada $entrada

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeEntrada(\App\Entity\Entrada $entrada)
    {
        return $this->entradas->removeElement($entrada);
    }

//      * Get entradas.

//      * @return \Doctrine\Common\Collections\Collection

    public function getEntradas()
    {
        return $this->entradas;
    }

//      * Add item.

//      * @param \App\Entity\Item $item

//      * @return Nino

    public function addItem(\App\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

//      * Remove item.

//      * @param \App\Entity\Item $item

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeItem(\App\Entity\Item $item)
    {
        return $this->items->removeElement($item);
    }

//      * Get items.

//      * @return \Doctrine\Common\Collections\Collection

    public function getItems()
    {
        return $this->items;
    }

//      * Set deletedAt.

//      * @param \DateTime|null $deletedAt

//      * @return Nino

    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

//      * Get deletedAt.

//      * @return \DateTime|null

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
