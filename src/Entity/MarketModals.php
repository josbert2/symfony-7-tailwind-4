<?php

namespace App\Entity;

use App\Repository\MarketModalsRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: MarketModalsRepository::class)]
//  * @ORM\Table(
//  *     name="market_modals",
//  *     indexes={
//  *         @ORM\Index(name="idx_modal_url_active", columns={"url_path", "is_active")
//  *     }
//  * )
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class MarketModals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Market', inversedBy: 'marketModals')]
    #[ORM\JoinTable(name: 'market_modals_markets')]
    private $markets;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor')]
    #[ORM\JoinColumn(name: 'proveedor_id', referencedColumnName: 'id', nullable: true)]
    private $proveedor;

    #[ORM\Column(type: 'string', message: 'El nombre es requerido', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', message: 'La URL debe comenzar con /', pattern: '/^\/.*$/', length: 255)]
    private $urlPath;

    #[ORM\Column(type: 'string', message: 'El tipo debe ser 'image', 'html' o 'json'', length: 50)]
    private $contentType;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imagePath;

    #[ORM\Column(type: 'string', message: 'El link debe ser una URL válida', length: 500, nullable: true)]
    private $imageLink;

    #[ORM\Column(type: 'text', nullable: true)]
    private $contentHtml;

    #[ORM\Column(type: 'text', nullable: true)]
    private $contentJson;

    #[ORM\Column(type: 'date', nullable: true)]
    private $expirationDate;
    
    #[ORM\Column(type: 'boolean')]
    private $isActive = true;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;


    public function __construct()
    {
        $this->isActive = true;
        $this->markets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

//      * @return \Doctrine\Common\Collections\Collection

    public function getMarkets()
    {
        return $this->markets;
    }

    public function addMarket(Market $market): self
    {
        if (!$this->markets->contains($market)) {
            $this->markets[] = $market;
        }

        return $this;
    }

    public function removeMarket(Market $market): self
    {
        if ($this->markets->contains($market)) {
            $this->markets->removeElement($market);
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrlPath(): ?string
    {
        return $this->urlPath;
    }

    public function setUrlPath(string $urlPath): self
    {
        // Normalizar URL path
        $urlPath = trim($urlPath);
        if (!str_starts_with($urlPath, '/')) {
            $urlPath = '/' . $urlPath;
        }
        $this->urlPath = $urlPath;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getImageLink(): ?string
    {
        return $this->imageLink;
    }

    public function setImageLink(?string $imageLink): self
    {
        $this->imageLink = $imageLink;

        return $this;
    }

    public function getContentHtml(): ?string
    {
        return $this->contentHtml;
    }

    public function setContentHtml(?string $contentHtml): self
    {
        $this->contentHtml = $contentHtml;

        return $this;
    }

    public function getContentJson(): ?string
    {
        return $this->contentJson;
    }

    public function setContentJson(?string $contentJson): self
    {
        $this->contentJson = $contentJson;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * Validate that required fields are set based on content_type

    public function isValid(): bool
    {
        if ($this->contentType === 'image' && !$this->imagePath) {
            return false;
        }

        if ($this->contentType === 'html' && !$this->contentHtml) {
            return false;
        }

        if ($this->contentType === 'json' && !$this->contentJson) {
            return false;
        }

        return true;
    }

    public function __toString(): string
    {
        return $this->name ?? 'Modal';
    }
}
