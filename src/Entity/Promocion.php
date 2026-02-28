<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


    #[ORM\Entity(repositoryClass: App\Repository\PromocionRepository::class)]
//  * @ORM\Table(
//  *     name="promocion",
//  *     uniqueConstraints={
//  *         @ORM\UniqueConstraint(
//  *             name="UNIQ_PROMOCION_CODIGO_PROVEEDOR",
//  *             columns={"proveedor_id", "codigo"}
//  *         )
//  *     }
//  * )

class Promocion
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;
    
    #[ORM\Column(type: 'string', length: 100)]
    private $codigo;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $monto;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $porcentaje;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoDescuento;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $topeDescuento;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $usosCliente;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $usosTotales;

    #[ORM\Column(type: 'boolean')]
    private $clientesNuevos = true;

    #[ORM\Column(type: 'boolean')]
    private $checkCategorias = false;

    #[ORM\Column(type: 'boolean')]
    private $checkActividades = false;

    #[ORM\Column(type: 'boolean')]
    private $checkVencimiento = false;

    #[ORM\Column(type: 'boolean')]
    private $checkConvenios = false;

    #[ORM\Column(type: 'boolean')]
    private $checkMarkets = false;

    #[ORM\Column(type: 'boolean')]
    private $admin = false;
    
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaVencimiento;
    
    #[ORM\Column(type: 'text', nullable: true)]
    private $estado;

    #[ORM\Column(type: 'boolean')]
    private $despachoGratis = false;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\Column(type: 'integer')]
    private $descuentoFijo = 0;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'promociones')]
    protected $proveedor;

    #[ORM\ManyToMany(targetEntity: 'Categoria', inversedBy: 'promociones')]
    protected $categorias;
    
    #[ORM\ManyToMany(targetEntity: 'Actividad', inversedBy: 'promociones')]
    protected $actividades;

    #[ORM\ManyToMany(targetEntity: 'Convenio', inversedBy: 'promociones')]
    protected $convenios;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Comuna', inversedBy: 'promociones')]
    protected $comunas;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Market', inversedBy: 'promociones')]
    protected $markets;
    
    #[ORM\OneToMany(targetEntity: 'Transaccion', mappedBy: 'promocion')]
    protected $transacciones;
    

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(targetEntity: 'PromocionListaGrupo', mappedBy: 'promocion')]
    private $promocionListaGrupos;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
        $this->actividades = new ArrayCollection();
        $this->convenios = new ArrayCollection();
        $this->markets = new ArrayCollection();
        $this->transacciones = new ArrayCollection();
        $this->comunas = new ArrayCollection();
        $this->promocionListaGrupos = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->codigo;
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

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(?int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getPorcentaje(): ?int
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(?int $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    public function getUsosCliente(): ?int
    {
        return $this->usosCliente;
    }

    public function setUsosCliente(?int $usosCliente): self
    {
        $this->usosCliente = $usosCliente;

        return $this;
    }

    public function getUsosTotales(): ?int
    {
        return $this->usosTotales;
    }

    public function setUsosTotales(?int $usosTotales): self
    {
        $this->usosTotales = $usosTotales;

        return $this;
    }

    public function getClientesNuevos(): ?bool
    {
        return $this->clientesNuevos;
    }

    public function setClientesNuevos(bool $clientesNuevos): self
    {
        $this->clientesNuevos = $clientesNuevos;

        return $this;
    }

    public function getCheckCategorias(): ?bool
    {
        return $this->checkCategorias;
    }

    public function setCheckCategorias(bool $checkCategorias): self
    {
        $this->checkCategorias = $checkCategorias;

        return $this;
    }

    public function getCheckActividades(): ?bool
    {
        return $this->checkActividades;
    }

    public function setCheckActividades(bool $checkActividades): self
    {
        $this->checkActividades = $checkActividades;

        return $this;
    }

    public function getCheckVencimiento(): ?bool
    {
        return $this->checkVencimiento;
    }

    public function setCheckVencimiento(bool $checkVencimiento): self
    {
        $this->checkVencimiento = $checkVencimiento;

        return $this;
    }

    public function getCheckConvenios(): ?bool
    {
        return $this->checkConvenios;
    }

    public function setCheckConvenios(bool $checkConvenios): self
    {
        $this->checkConvenios = $checkConvenios;

        return $this;
    }

    public function getCheckMarkets(): ?bool
    {
        return $this->checkMarkets;
    }

    public function setCheckMarkets(bool $checkMarkets): self
    {
        $this->checkMarkets = $checkMarkets;

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getFechaVencimiento(): ?\DateTimeInterface
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento(?\DateTimeInterface $fechaVencimiento): self
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

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

//      * @return Collection|Categoria[]
     
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->contains($categoria)) {
            $this->categorias->removeElement($categoria);
        }

        return $this;
    }

//      * @return Collection|Actividad[]

    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividad $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
        }

        return $this;
    }

    public function removeActividade(Actividad $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
        }

        return $this;
    }

//      * @return Collection|Convenio[]

    public function getConvenios(): Collection
    {
        return $this->convenios;
    }

    public function addConvenio(Convenio $convenio): self
    {
        if (!$this->convenios->contains($convenio)) {
            $this->convenios[] = $convenio;
        }

        return $this;
    }

    public function removeConvenio(Convenio $convenio): self
    {
        if ($this->convenios->contains($convenio)) {
            $this->convenios->removeElement($convenio);
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

//      * @return Collection|Transaccion[]

    public function getTransacciones(): Collection
    {
        return $this->transacciones;
    }

    public function addTransaccione(Transaccion $transaccione): self
    {
        if (!$this->transacciones->contains($transaccione)) {
            $this->transacciones[] = $transaccione;
            $transaccione->setPromocion($this);
        }

        return $this;
    }

    public function removeTransaccione(Transaccion $transaccione): self
    {
        if ($this->transacciones->contains($transaccione)) {
            $this->transacciones->removeElement($transaccione);
            // set the owning side to null (unless already changed)
            if ($transaccione->getPromocion() === $this) {
                $transaccione->setPromocion(null);
            }
        }

        return $this;
    }

    public function getDespachoGratis(): ?bool
    {
        return $this->despachoGratis;
    }

    public function setDespachoGratis(bool $despachoGratis): self
    {
        $this->despachoGratis = $despachoGratis;

        return $this;
    }

    public function getTopeDescuento(): ?int
    {
        return $this->topeDescuento;
    }

    public function setTopeDescuento(?int $topeDescuento): self
    {
        $this->topeDescuento = $topeDescuento;

        return $this;
    }

//      * @return Collection|Comuna[]

    public function getComunas(): Collection
    {
        return $this->comunas;
    }

    public function addComuna(Comuna $comuna): self
    {
        if (!$this->comunas->contains($comuna)) {
            $this->comunas[] = $comuna;
        }

        return $this;
    }

    public function removeComuna(Comuna $comuna): self
    {
        $this->comunas->removeElement($comuna);

        return $this;
    }

    public function getTipoDescuento(): ?string
    {
        return $this->tipoDescuento;
    }

    public function setTipoDescuento(?string $tipoDescuento): self
    {
        $this->tipoDescuento = $tipoDescuento;

        return $this;
    }

    public function getPromocionListaGrupos(): Collection
    {
        return $this->promocionListaGrupos;
    }

    public function addPromocionListaGrupo(PromocionListaGrupo $promocionListaGrupo): self
    {
        if (!$this->promocionListaGrupos->contains($promocionListaGrupo)) {
            $this->promocionListaGrupos[] = $promocionListaGrupo;
            $promocionListaGrupo->setPromocion($this);
        }

        return $this;
    }

    public function removePromocionListaGrupo(PromocionListaGrupo $promocionListaGrupo): self
    {
        if ($this->promocionListaGrupos->removeElement($promocionListaGrupo)) {
            // set the owning side to null (unless already changed)
            if ($promocionListaGrupo->getPromocion() === $this) {
                $promocionListaGrupo->setPromocion(null);
            }
        }

        return $this;
    }

    public function getDescuentoFijo(): ?int
    {
        return $this->descuentoFijo;
    }

    public function setDescuentoFijo(?int $descuentoFijo): self
    {
        $this->descuentoFijo = $descuentoFijo;

        return $this;
    }
    
}
