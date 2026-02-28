<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class Tag
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcion;

    #[ORM\Column(type: 'boolean')]
    private $visible = true;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'tags')]
    protected $proveedor;
//
//    /** 
     */
//     * #[ORM\ManyToMany(targetEntity: 'Proveedor', mappedBy: 'tags')]
// //     */
//    protected $proveedores;

    #[ORM\ManyToMany(targetEntity: 'Actividad', mappedBy: 'tags')]
    protected $actividades;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __toString() {
        return $this->nombre;
    }

//      * Constructor

    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set nombre.

//      * @param string $nombre

//      * @return Tag

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

//      * Set descripcion.

//      * @param string|null $descripcion

//      * @return Tag

    public function setDescripcion($descripcion = null)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

//      * Get descripcion.

//      * @return string|null

    public function getDescripcion()
    {
        return $this->descripcion;
    }

//      * Set visible.

//      * @param bool $visible

//      * @return Tag

    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

//      * Get visible.

//      * @return bool

    public function getVisible()
    {
        return $this->visible;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Tag

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

//      * @return Tag

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

//      * Set proveedor.

//      * @param \App\Entity\Proveedor|null $proveedor

//      * @return Tag

    public function setProveedor(\App\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * Get proveedor.

//      * @return \App\Entity\Proveedor|null

    public function getProveedor()
    {
        return $this->proveedor;
    }

//      * Add actividade.

//      * @param \App\Entity\Actividad $actividade

//      * @return Tag

    public function addActividade(\App\Entity\Actividad $actividade)
    {
        $this->actividades[] = $actividade;

        return $this;
    }

//      * Remove actividade.

//      * @param \App\Entity\Actividad $actividade

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeActividade(\App\Entity\Actividad $actividade)
    {
        return $this->actividades->removeElement($actividade);
    }

//      * Get actividades.

//      * @return \Doctrine\Common\Collections\Collection

    public function getActividades()
    {
        return $this->actividades;
    }

//      * Set activo.

//      * @param bool $activo

//      * @return Tag

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

//      * Set deleted.

//      * @param \DateTime|null $deleted

//      * @return Tag

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
