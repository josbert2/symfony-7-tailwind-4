<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
 
class TransaccionPromocionListaCodigo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(targetEntity: 'Transaccion', inversedBy: 'transaccionPromocionListaCodigos')]
    #[ORM\JoinColumn(onDelete: 'CASCADE', nullable: false)]
    private $transaccion;

    #[ORM\ManyToOne(targetEntity: 'PromocionListaCodigo', inversedBy: 'transaccionPromocionListaCodigos')]
    #[ORM\JoinColumn(onDelete: 'CASCADE', nullable: false)]
    private $promocionListaCodigo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransaccion(): ?Transaccion
    {
        return $this->transaccion;
    }

    public function setTransaccion(?Transaccion $transaccion): self
    {
        $this->transaccion = $transaccion;

        return $this;
    }

    public function getPromocionListaCodigo(): ?PromocionListaCodigo
    {
        return $this->promocionListaCodigo;
    }

    public function setPromocionListaCodigo(?PromocionListaCodigo $promocionListaCodigo): self
    {
        $this->promocionListaCodigo = $promocionListaCodigo;

        return $this;
    }
}