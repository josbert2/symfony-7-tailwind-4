<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

    #[ORM\Entity(repositoryClass: App\Repository\PromocionListaCodigoRepository::class)]
    #[ORM\Table(name: 'promotions_promotionlistcode')]
class PromocionListaCodigo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'PromocionLista', inversedBy: 'promocionListaCodigo')]
    #[ORM\JoinColumn(name: 'promotion_list_id', referencedColumnName: 'id', onDelete: 'RESTRICT', nullable: true)]
    private $promocionLista;

    #[ORM\OneToMany(targetEntity: 'App\Entity\TransaccionPromocionListaCodigo', mappedBy: 'promocionListaCodigo')]
    private $transaccionPromocionListaCodigos;
    
    #[ORM\Column(type: 'string', length: 100)]
    private $code;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateExpired;

    #[ORM\Column(type: 'string')]
    private $vecesUtilizable;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromocionLista(): ?PromocionLista
    {
        return $this->promocionLista;
    }

    public function setPromocionLista(?PromocionLista $promocionLista): self
    {
        $this->promocionLista = $promocionLista;
        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getDateExpired(): ?\DateTime
    {
        return $this->dateExpired;
    }

    public function setDateExpired(?\DateTime $dateExpired): self
    {
        if ($dateExpired !== null) {
            $dateExpired->setTime(0, 0, 0);
        }
        $this->dateExpired = $dateExpired;
        return $this;
    }

    public function getVecesUtilizable(): ?string
    {
        return $this->vecesUtilizable;
    }

    public function setVecesUtilizable(string $vecesUtilizable): self
    {
        $this->vecesUtilizable = $vecesUtilizable;
        return $this;
    }

    public function getDeleted(): ?\DateTime
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTime $deleted): self
    {
        $this->deleted = $deleted;
        return $this;
    }
}
