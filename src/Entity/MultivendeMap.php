<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="proveedor_entity", columns={"proveedor_id", "entity"),
//  *     @ORM\Index(name="proveedor_entity_deleted", columns={"proveedor_id", "entity", "deleted"),
//  *     @ORM\Index(name="entity_extra_data", columns={"entity", "extra_data", "deleted")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\MultivendeMapRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class MultivendeMap
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $multivendeId;

    #[ORM\Column(type: 'string', length: 255)]
    private $entity;

    #[ORM\Column(type: 'string', length: 255)]
    private $entityId;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $sync;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $extraData;

    #[ORM\Column(type: 'json', nullable: true)]
    private $dataArray;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'multivendeMaps')]
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

    public function getMultivendeId(): ?string
    {
        return $this->multivendeId;
    }

    public function setMultivendeId(string $multivendeId): self
    {
        $this->multivendeId = $multivendeId;

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getSync(): ?bool
    {
        return $this->sync;
    }

    public function setSync(?bool $sync): self
    {
        $this->sync = $sync;

        return $this;
    }

    public function getExtraData(): ?string
    {
        return $this->extraData;
    }

    public function setExtraData(?string $extraData): self
    {
        $this->extraData = $extraData;

        return $this;
    }

    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    public function setEntityId(string $entityId): self
    {
        $this->entityId = $entityId;

        return $this;
    }

    public function getDataArray(): ?array
    {
        return $this->dataArray;
    }

    public function setDataArray(?array $dataArray): self
    {
        $this->dataArray = $dataArray;

        return $this;
    }

}
