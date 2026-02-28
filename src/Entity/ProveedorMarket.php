<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ProveedorMarketRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @ORM\Table(
//  *     name="proveedor_market",
//  *     indexes={
//  *         @ORM\Index(name="idx_market_propio", columns={"market_propio"),
//  *         @ORM\Index(name="idx_activo", columns={"activo")

//  *     }
//  * )

class ProveedorMarket
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $cobroVariable;
    
    #[ORM\Column(type: 'integer')]
    private $cobroFijo = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroFijoAdministracion = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroEntrada = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroFijoBoleteria = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroFijoEntradaBoleteria = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cobroVariableEntradaBoleteria;

    #[ORM\Column(type: 'integer')]
    private $cobroFijoInvitaciones = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroFijoInvitacion = 0;

    #[ORM\Column(type: 'integer')]
    private $cobroVariableInvitacion = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $periodoFacturacion;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaTerminoEntrada;

    #[ORM\Column(type: 'boolean')]
    private $marketPropio = false;

    #[ORM\Column(type: 'boolean')]
    private $comisionAsistente = false;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'proveedorMarkets')]
    protected $proveedor;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Market', inversedBy: 'proveedorMarkets')]
    protected $market;
    
    #[ORM\ManyToOne(targetEntity: 'Plan', inversedBy: 'proveedores')]
    protected $plan;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Liquidacion', mappedBy: 'proveedorMarket')]
    protected $liquidaciones;

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
        $this->liquidaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCobroVariable(): ?int
    {
        return $this->cobroVariable;
    }

    public function setCobroVariable(?int $cobroVariable): self
    {
        $this->cobroVariable = $cobroVariable;

        return $this;
    }

    public function getCobroFijo(): ?int
    {
        return $this->cobroFijo;
    }

    public function setCobroFijo(?int $cobroFijo): self
    {
        $this->cobroFijo = $cobroFijo ?? 0;
        return $this;
    }

    public function getCobroFijoAdministracion(): ?int
    {
        return $this->cobroFijoAdministracion;
    }

    public function setCobroFijoAdministracion(?int $cobroFijoAdministracion): self
    {
        $this->cobroFijoAdministracion = $cobroFijoAdministracion ?? 0;
        return $this;
    }

    public function getCobroEntrada(): ?int
    {
        return $this->cobroEntrada;
    }

    public function setCobroEntrada(?int $cobroEntrada): self
    {
        $this->cobroEntrada = $cobroEntrada ?? 0;

        return $this;
    }

    public function getCobroFijoBoleteria(): ?int
    {
        return $this->cobroFijoBoleteria;
    }

    public function setCobroFijoBoleteria(?int $cobroFijoBoleteria): self
    {
        $this->cobroFijoBoleteria = $cobroFijoBoleteria ?? 0;

        return $this;
    }

    public function getCobroFijoEntradaBoleteria(): ?int
    {
        return $this->cobroFijoEntradaBoleteria;
    }

    public function setCobroFijoEntradaBoleteria(?int $cobroFijoEntradaBoleteria): self
    {
        $this->cobroFijoEntradaBoleteria = $cobroFijoEntradaBoleteria ?? 0;

        return $this;
    }

    public function getCobroVariableEntradaBoleteria(): ?int
    {
        return $this->cobroVariableEntradaBoleteria;
    }

    public function setCobroVariableEntradaBoleteria(?int $cobroVariableEntradaBoleteria): self
    {
        $this->cobroVariableEntradaBoleteria = $cobroVariableEntradaBoleteria;

        return $this;
    }

    public function getCobroFijoInvitaciones(): ?int
    {
        return $this->cobroFijoInvitaciones;
    }

    public function setCobroFijoInvitaciones(?int $cobroFijoInvitaciones): self
    {
        $this->cobroFijoInvitaciones = $cobroFijoInvitaciones ?? 0;

        return $this;
    }

    public function getCobroFijoInvitacion(): ?int
    {
        return $this->cobroFijoInvitacion;
    }

    public function setCobroFijoInvitacion(?int $cobroFijoInvitacion): self
    {
        $this->cobroFijoInvitacion = $cobroFijoInvitacion ?? 0;

        return $this;
    }

    public function getCobroVariableInvitacion(): ?int
    {
        return $this->cobroVariableInvitacion;
    }

    public function setCobroVariableInvitacion(?int $cobroVariableInvitacion): self
    {
        $this->cobroVariableInvitacion = $cobroVariableInvitacion;

        return $this;
    }

    public function getPeriodoFacturacion(): ?string
    {
        return $this->periodoFacturacion;
    }

    public function setPeriodoFacturacion(?string $periodoFacturacion): self
    {
        $this->periodoFacturacion = $periodoFacturacion;

        return $this;
    }

    public function getMarketPropio(): ?bool
    {
        return $this->marketPropio;
    }

    public function setMarketPropio(bool $marketPropio): self
    {
        $this->marketPropio = $marketPropio;

        return $this;
    }

    public function getComisionAsistente(): ?bool
    {
        return $this->comisionAsistente;
    }

    public function setComisionAsistente(bool $comisionAsistente): self
    {
        $this->comisionAsistente = $comisionAsistente;

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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

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

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getFechaTerminoEntrada(): ?\DateTimeInterface
    {
        return $this->fechaTerminoEntrada;
    }

    public function setFechaTerminoEntrada(?\DateTimeInterface $fechaTerminoEntrada): self
    {
        $this->fechaTerminoEntrada = $fechaTerminoEntrada;

        return $this;
    }

//      * @return Collection|Liquidacion[]
     
    public function getLiquidaciones(): Collection
    {
        return $this->liquidaciones;
    }

    public function addLiquidacione(Liquidacion $liquidacione): self
    {
        if (!$this->liquidaciones->contains($liquidacione)) {
            $this->liquidaciones[] = $liquidacione;
            $liquidacione->setProveedorMarket($this);
        }

        return $this;
    }

    public function removeLiquidacione(Liquidacion $liquidacione): self
    {
        if ($this->liquidaciones->removeElement($liquidacione)) {
            // set the owning side to null (unless already changed)
            if ($liquidacione->getProveedorMarket() === $this) {
                $liquidacione->setProveedorMarket(null);
            }
        }

        return $this;
    }

}
