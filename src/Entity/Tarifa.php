<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\TarifaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Tarifa
{
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $peso;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioEntrekids;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioEnviame;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sla;

    #[ORM\Column(type: 'json', nullable: true)]
    private $carriers;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Comuna', inversedBy: 'tarifasOrigen')]
    protected $comunaOrigen;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Comuna', inversedBy: 'tarifasDestino')]
    protected $comunaDestino;

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

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getPrecioEntrekids(): ?int
    {
        return $this->precioEntrekids;
    }

    public function setPrecioEntrekids(?int $precioEntrekids): self
    {
        $this->precioEntrekids = $precioEntrekids;

        return $this;
    }

    public function getPrecioEnviame(): ?int
    {
        return $this->precioEnviame;
    }

    public function setPrecioEnviame(?int $precioEnviame): self
    {
        $this->precioEnviame = $precioEnviame;

        return $this;
    }

    public function getCarriers(): ?array
    {
        return $this->carriers;
    }

    public function setCarriers(?array $carriers): self
    {
        $this->carriers = $carriers;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

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

    public function getComunaOrigen(): ?Comuna
    {
        return $this->comunaOrigen;
    }

    public function setComunaOrigen(?Comuna $comunaOrigen): self
    {
        $this->comunaOrigen = $comunaOrigen;

        return $this;
    }

    public function getComunaDestino(): ?Comuna
    {
        return $this->comunaDestino;
    }

    public function setComunaDestino(?Comuna $comunaDestino): self
    {
        $this->comunaDestino = $comunaDestino;

        return $this;
    }

    public function getSla(): ?int
    {
        return $this->sla;
    }

    public function setSla(?int $sla): self
    {
        $this->sla = $sla;

        return $this;
    }

}
