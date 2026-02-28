<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Market;

    #[ORM\Entity(repositoryClass: App\Repository\BannerSliderRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class BannerSlider {

    #[ORM\Id]
    #[ORM\GeneratedValue]()
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $urlImagenDesk;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $urlImagenMobile;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $titulo;

    #[ORM\Column(type: 'integer', nullable: true)]
    protected $orden;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $fechaInicio;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $fechaFin;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected $activo;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market')]
    #[ORM\JoinColumn(name: 'market_id', referencedColumnName: 'id', onDelete: 'SET NULL', nullable: true)]
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

    public function getUrlImagenDesk(): ?string
    {
        return $this->urlImagenDesk;
    }

    public function setUrlImagenDesk(?string $urlImagenDesk): self
    {
        $this->urlImagenDesk = $urlImagenDesk;

        return $this;
    }

    public function getUrlImagenMobile(): ?string
    {
        return $this->urlImagenMobile;
    }

    public function setUrlImagenMobile(?string $urlImagenMobile): self
    {
        $this->urlImagenMobile = $urlImagenMobile;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    
    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getMarketId(): ?int
    {
        return $this->market ? $this->market->getId() : null;
    }

    public function setMarket($market): self
    {
        if (is_int($market)) {
            $this->market = new Market();
            $this->market->setId($market);
        } else {
            $this->market = $market;
        }

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

    public function setDeleted(?
    \DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}