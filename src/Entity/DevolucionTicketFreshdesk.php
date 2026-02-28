<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
//  * @ORM\Table(
//  *     name="devolucion_ticket_freshdesk",
//  *     uniqueConstraints={
//  *         @ORM\UniqueConstraint(name="uniq_devolucion", columns={"devolucion_dinero_id")
//  *     }
//  * )

class DevolucionTicketFreshdesk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

//      * Relación con devolución

    #[ORM\ManyToOne(targetEntity: 'App\Entity\DevolucionDinero')]
    #[ORM\JoinColumn(name: 'devolucion_dinero_id', referencedColumnName: 'id', onDelete: 'CASCADE', nullable: false)]
     
    private $devolucionDinero;

    #[ORM\Column(type: 'text', nullable: true)]
    private $tags;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $type;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $status;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $priority;

    #[ORM\Column(name: 'group_id', type: 'bigint', nullable: true)]
    private $groupId;

    #[ORM\Column(name: 'responder_id', type: 'bigint', nullable: true)]
    private $responderId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cfUnidadDeNegocio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cfEk;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cfSellerRetail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cfSellerExperiencias;

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDevolucionDinero()
    {
        return $this->devolucionDinero;
    }

    public function setDevolucionDinero($devolucionDinero): self
    {
        $this->devolucionDinero = $devolucionDinero;
        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function getGroupId(): ?int
    {
        return $this->groupId;
    }

    public function setGroupId(?int $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    public function getResponderId(): ?int
    {
        return $this->responderId;
    }

    public function setResponderId(?int $responderId): self
    {
        $this->responderId = $responderId;
        return $this;
    }

    public function getCfUnidadDeNegocio(): ?string
    {
        return $this->cfUnidadDeNegocio;
    }

    public function setCfUnidadDeNegocio(?string $value): self
    {
        $this->cfUnidadDeNegocio = $value;
        return $this;
    }

    public function getCfEk(): ?string
    {
        return $this->cfEk;
    }

    public function setCfEk(?string $value): self
    {
        $this->cfEk = $value;
        return $this;
    }

    public function getCfSellerRetail(): ?string
    {
        return $this->cfSellerRetail;
    }

    public function setCfSellerRetail(?string $value): self
    {
        $this->cfSellerRetail = $value;
        return $this;
    }

    public function getCfSellerExperiencias(): ?string
    {
        return $this->cfSellerExperiencias;
    }

    public function setCfSellerExperiencias(?string $value): self
    {
        $this->cfSellerExperiencias = $value;
        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
