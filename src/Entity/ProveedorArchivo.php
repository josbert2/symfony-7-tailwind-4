<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ProveedorArchivoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ProveedorArchivo
{
    #[ORM\Column(type: 'integer')]
    private $id;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'App\Entity\VichFile', inversedBy: 'proveedorArchivo')]
     
    protected $archivo;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'archivos')]
    protected $proveedor;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getArchivo(): ?VichFile
    {
        return $this->archivo;
    }

    public function setArchivo(?VichFile $archivo): self
    {
        $archivo->setProveedorArchivo($this);
        $this->archivo = $archivo;

        return $this;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

}
