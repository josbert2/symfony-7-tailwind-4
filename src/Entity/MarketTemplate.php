<?php

namespace App\Entity;

use App\Repository\MarketTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: MarketTemplateRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class MarketTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titulo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'marketTemplates')]
    protected $market;
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Template', inversedBy: 'marketTemplates')]
    protected $template;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Banner', mappedBy: 'marketTemplate')]
//      * @OrderBy({"orden" = "ASC")

    protected $banners;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __construct()
    {
        $this->banners = new ArrayCollection();
    }

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

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        $this->market = $market;

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

//      * @return Collection|Banner[]
     
    public function getBanners(): Collection
    {
        return $this->banners;
    }

    public function addBanner(Banner $banner): self
    {
        if (!$this->banners->contains($banner)) {
            $this->banners[] = $banner;
            $banner->setMarketTemplate($this);
        }

        return $this;
    }

    public function removeBanner(Banner $banner): self
    {
        if ($this->banners->removeElement($banner)) {
            // set the owning side to null (unless already changed)
            if ($banner->getMarketTemplate() === $this) {
                $banner->setMarketTemplate(null);
            }
        }

        return $this;
    }

    public function getTicketsTemplates(): ?string
    {
        return $this->ticketsTemplates;
    }

    public function setTicketsTemplates(?string $ticketsTemplates): self
    {
        $this->ticketsTemplates = $ticketsTemplates;

        return $this;
    }
}
