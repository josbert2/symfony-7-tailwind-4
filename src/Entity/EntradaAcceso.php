<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class EntradaAcceso
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaAcceso;

    #[ORM\ManyToOne(targetEntity: 'Entrada', inversedBy: 'accesos')]
    protected $entrada;

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

    public function getFechaAcceso(): ?\DateTimeInterface
    {
        return $this->fechaAcceso;
    }

    public function setFechaAcceso(?\DateTimeInterface $fechaAcceso): self
    {
        $this->fechaAcceso = $fechaAcceso;

        return $this;
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

    public function getEntrada(): ?Entrada
    {
        return $this->entrada;
    }

    public function setEntrada(?Entrada $entrada): self
    {
        $this->entrada = $entrada;

        return $this;
    }


}
