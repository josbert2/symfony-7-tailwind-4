<?php

namespace App\Entity;

use App\Entity\Usuario;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


    #[ORM\Entity(repositoryClass: App\Repository\BannerRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @Vich\Uploadable()

class Banner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]()
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titulo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orden;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'App\Entity\VichFile', inversedBy: 'bannerWeb')]
     
    protected $imagenWeb;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'App\Entity\VichFile', inversedBy: 'bannerMobile')]

    protected $imagenMobile;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\MarketTemplate', inversedBy: 'banners')]
    protected $marketTemplate;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function setImagenWeb(?VichFile $imagenWeb): self
    {
        $imagenWeb->setBannerWeb($this);
        $this->imagenWeb = $imagenWeb;

        return $this;
    }

    public function setImagenMobile(?VichFile $imagenMobile): self
    {
        $imagenMobile->setBannerMobile($this);
        $this->imagenMobile = $imagenMobile;

        return $this;
    }

    public function __toString()
    {
        return $this->getId() . '';
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMarketTemplate(): ?MarketTemplate
    {
        return $this->marketTemplate;
    }

    public function setMarketTemplate(?MarketTemplate $marketTemplate): self
    {
        $this->marketTemplate = $marketTemplate;

        return $this;
    }

    public function getImagenWeb(): ?VichFile
    {
        return $this->imagenWeb;
    }

    public function getImagenMobile(): ?VichFile
    {
        return $this->imagenMobile;
    }


}
