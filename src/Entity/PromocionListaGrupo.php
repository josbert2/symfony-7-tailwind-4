<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: App\Repository\PromocionListaGrupoRepository::class)]
    #[ORM\Table(name: 'promotions_promotionlistgroup')]

class PromocionListaGrupo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'PromocionLista', inversedBy: 'promocionListaGrupos')]
    #[ORM\JoinColumn(name: 'promotion_list_id', referencedColumnName: 'id', onDelete: 'RESTRICT', nullable: true)]
    private $promocionLista;

    #[ORM\ManyToOne(targetEntity: 'Promocion', inversedBy: 'promocionListaGrupos')]
    #[ORM\JoinColumn(name: 'promotion_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    private $promocion;

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

    public function getPromocion(): ?Promocion
    {
        return $this->promocion;
    }

    public function setPromocion(Promocion $promocion): self
    {
        $this->promocion = $promocion;
        return $this;
    }
}
