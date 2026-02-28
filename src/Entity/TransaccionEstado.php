<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class TransaccionEstado
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\ManyToOne(targetEntity: 'Transaccion', inversedBy: 'estados')]
    protected $transaccion;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set estado.

//      * @param string $estado

//      * @return TransaccionEstado

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

//      * Get estado.

//      * @return string

    public function getEstado()
    {
        return $this->estado;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return TransaccionEstado

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

//      * Set transaccion.

//      * @param \App\Entity\Transaccion|null $transaccion

//      * @return TransaccionEstado

    public function setTransaccion(\App\Entity\Transaccion $transaccion = null)
    {
        $this->transaccion = $transaccion;

        return $this;
    }

//      * Get transaccion.

//      * @return \App\Entity\Transaccion|null

    public function getTransaccion()
    {
        return $this->transaccion;
    }

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
