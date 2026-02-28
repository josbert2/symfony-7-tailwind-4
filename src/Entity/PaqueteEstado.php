<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: App\Repository\PaqueteEstadoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class PaqueteEstado
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Paquete', inversedBy: 'estados')]
    protected $paquete;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razon;

    #[ORM\ManyToOne(inversedBy: 'paqueteEstados', targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $responsableCambio;

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set estado.

//      * @param string $estado

//      * @return PaqueteEstado

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

//      * @return PaqueteEstado

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

//      * Set paquete.

//      * @param \App\Entity\Paquete|null $paquete

//      * @return PaqueteEstado

    public function setPaquete(\App\Entity\Paquete $paquete = null)
    {
        $this->paquete = $paquete;

        return $this;
    }

//      * Get paquete.

//      * @return \App\Entity\Paquete|null

    public function getPaquete()
    {
        return $this->paquete;
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

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getRazon(): ?string
    {
        return $this->razon;
    }

    public function setRazon(?string $razon): self
    {
        $this->razon = $razon;

        return $this;
    }

    public function getResponsableCambio(): ?Usuario
    {
        return $this->responsableCambio;
    }

    public function setResponsableCambio(?Usuario $responsableCambio): self
    {
        $this->responsableCambio = $responsableCambio;

        return $this;
    }
}
