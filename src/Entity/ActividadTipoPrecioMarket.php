<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\ActividadTipoPrecioMarketRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ActividadTipoPrecioMarket
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $cobroVariable;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ActividadTipoPrecio', inversedBy: 'actividadTipoPrecioMarkets')]
    protected $actividadTipoPrecio;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'actividadTipoPrecioMarkets')]
    protected $market;

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

    public function getCobroVariable(): ?int
    {
        return $this->cobroVariable;
    }

    public function setCobroVariable(?int $cobroVariable): self
    {
        $this->cobroVariable = $cobroVariable;

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

    public function getActividadTipoPrecio(): ?ActividadTipoPrecio
    {
        return $this->actividadTipoPrecio;
    }

    public function setActividadTipoPrecio(?ActividadTipoPrecio $actividadTipoPrecio): self
    {
        $this->actividadTipoPrecio = $actividadTipoPrecio;

        return $this;
    }

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        $this->market = $market;

        return $this;
    }


}
