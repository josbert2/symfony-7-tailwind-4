<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\ResenaRepository::class)]
//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="resena_activo_idx", columns={"activo"),
//  *     @ORM\Index(name="resena_created_idx", columns={"created")
//  * )

class Resena
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $calificacion;
    
    #[ORM\Column(type: 'text', nullable: true)]
    private $comentarios;
    
    #[ORM\Column(type: 'text', nullable: true)]
    private $comentariosPrivados;

    #[ORM\Column(type: 'text', nullable: true)]
    private $comentariosProveedor;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\OneToOne(targetEntity: 'Entrada', inversedBy: 'resena')]
    protected $entrada;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Item', inversedBy: 'resenas')]
    protected $item;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Actividad', inversedBy: 'resenas')]
    protected $actividad;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function getProveedor()
    {
        return $this->getItem()->getProveedor();
    }
    
    public function getActividad()
    {
        return $this->getItem()->getActividad();
    }
    
    public function getEvento()
    {
        return $this->getItem()->getEvento();
    }
    
    public function getCliente()
    {
        return $this->getItem() && $this->getItem()->getTransaccion() ? $this->getItem()->getTransaccion()->getCliente() : NULL;
    }

    public function getMarket()
    {
        return $this->getItem()->getMarket();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set calificacion.

//      * @param int $calificacion

//      * @return Resena

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

//      * Get calificacion.

//      * @return int

    public function getCalificacion()
    {
        return $this->calificacion;
    }

//      * Set comentarios.

//      * @param string|null $comentarios

//      * @return Resena

    public function setComentarios($comentarios = null)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

//      * Get comentarios.

//      * @return string|null

    public function getComentarios()
    {
        return $this->comentarios;
    }

//      * Set comentariosPrivados.

//      * @param string|null $comentariosPrivados

//      * @return Resena

    public function setComentariosPrivados($comentariosPrivados = null)
    {
        $this->comentariosPrivados = $comentariosPrivados;

        return $this;
    }

//      * Get comentariosPrivados.

//      * @return string|null

    public function getComentariosPrivados()
    {
        return $this->comentariosPrivados;
    }

//      * Set comentariosProveedor.

//      * @param string|null $comentariosProveedor

//      * @return Resena

    public function setComentariosProveedor($comentariosProveedor = null)
    {
        $this->comentariosProveedor = $comentariosProveedor;

        return $this;
    }

//      * Get comentariosProveedor.

//      * @return string|null

    public function getComentariosProveedor()
    {
        return $this->comentariosProveedor;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Resena

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

//      * @return Resena

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

//      * Set entrada.

//      * @param \App\Entity\Entrada|null $entrada

//      * @return Resena

    public function setEntrada(\App\Entity\Entrada $entrada = null)
    {
        $this->entrada = $entrada;

        return $this;
    }

//      * Get entrada.

//      * @return \App\Entity\Entrada|null

    public function getEntrada()
    {
        return $this->entrada;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return Resena

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

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function setActividad(?Actividad $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }
}
