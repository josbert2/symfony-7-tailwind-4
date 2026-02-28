<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: TemplateRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Template
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titulo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcion;

    #[ORM\OneToMany(targetEntity: 'App\Entity\MarketTemplate', mappedBy: 'template')]
    protected $marketTemplates;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Market', mappedBy: 'template')]
    protected $markets;

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
        $this->marketTemplates = new ArrayCollection();
        $this->banners = new ArrayCollection();
        $this->markets = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

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

//      * @return Collection|MarketTemplate[]
     
    public function getMarketTemplates(): Collection
    {
        return $this->marketTemplates;
    }

    public function addMarketTemplate(MarketTemplate $marketTemplate): self
    {
        if (!$this->marketTemplates->contains($marketTemplate)) {
            $this->marketTemplates[] = $marketTemplate;
            $marketTemplate->setMarket($this);
        }

        return $this;
    }

    public function removeMarketTemplate(MarketTemplate $marketTemplate): self
    {
        if ($this->marketTemplates->removeElement($marketTemplate)) {
            // set the owning side to null (unless already changed)
            if ($marketTemplate->getMarket() === $this) {
                $marketTemplate->setMarket(null);
            }
        }

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
            $banner->setTemplate($this);
        }

        return $this;
    }

    public function removeBanner(Banner $banner): self
    {
        if ($this->banners->removeElement($banner)) {
            // set the owning side to null (unless already changed)
            if ($banner->getTemplate() === $this) {
                $banner->setTemplate(null);
            }
        }

        return $this;
    }

//      * @return Collection|Market[]

    public function getMarkets(): Collection
    {
        return $this->markets;
    }

    public function addMarket(Market $market): self
    {
        if (!$this->markets->contains($market)) {
            $this->markets[] = $market;
            $market->setTemplate($this);
        }

        return $this;
    }

    public function removeMarket(Market $market): self
    {
        if ($this->markets->removeElement($market)) {
            // set the owning side to null (unless already changed)
            if ($market->getTemplate() === $this) {
                $market->setTemplate(null);
            }
        }

        return $this;
    }
}
