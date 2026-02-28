<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ProveedorRutRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class ProveedorRut
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipo;

    #[ORM\Column(type: 'string', length: 255)]
    private $razonSocial;

    #[ORM\Column(type: 'string', length: 255)]
    private $rut;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoServicios;

    #[ORM\Column(type: 'boolean')]
    private $emitirFacturacion = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $ultimaFacturacion;

    #[ORM\OneToOne(targetEntity: 'Direccion', inversedBy: 'proveedorRut')]
    protected $direccion;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Cuenta', inversedBy: 'proveedorRut')]
    protected $cuenta;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'ruts')]
    protected $proveedor;

    #[ORM\OneToMany(targetEntity: 'Actividad', mappedBy: 'proveedorRut')]
    protected $actividades;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadMarket', mappedBy: 'proveedorRut')]
    protected $actividadMarkets;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadTipoPrecio', mappedBy: 'proveedorRut')]
    protected $actividadTipoPrecios;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Item', mappedBy: 'proveedorRut')]
    protected $items;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Liquidacion', mappedBy: 'proveedorRut')]
    protected $liquidaciones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

//      * Constructor

    public function __construct()
    {
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actividadMarkets = new ArrayCollection();
        $this->actividadTipoPrecios = new ArrayCollection();
        $this->liquidaciones = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getRazonSocial();
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set tipo.

//      * @param string $tipo

//      * @return ProveedorRut

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

//      * Get tipo.

//      * @return string

    public function getTipo()
    {
        return $this->tipo;
    }

//      * Set razonSocial.

//      * @param string $razonSocial

//      * @return ProveedorRut

    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

//      * Get razonSocial.

//      * @return string

    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

//      * Set rut.

//      * @param string $rut

//      * @return ProveedorRut

    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

//      * Get rut.

//      * @return string

    public function getRut()
    {
        return $this->rut;
    }

//      * Set tipoServicios.

//      * @param string $tipoServicios

//      * @return ProveedorRut

    public function setTipoServicios($tipoServicios)
    {
        $this->tipoServicios = $tipoServicios;

        return $this;
    }

//      * Get tipoServicios.

//      * @return string

    public function getTipoServicios()
    {
        return $this->tipoServicios;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return ProveedorRut

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

//      * Get created.

//      * @return \DateTime

    public function getCreated()
    {
        return $this->created;
    }

//      * Set updated.

//      * @param \DateTime $updated

//      * @return ProveedorRut

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

//      * Get updated.

//      * @return \DateTime

    public function getUpdated()
    {
        return $this->updated;
    }

//      * Set deleted.

//      * @param \DateTime|null $deleted

//      * @return ProveedorRut

    public function setDeleted($deleted = null)
    {
        $this->deleted = $deleted;

        return $this;
    }

//      * Get deleted.

//      * @return \DateTime|null

    public function getDeleted()
    {
        return $this->deleted;
    }

//      * Set direccion.

//      * @param \App\Entity\Direccion|null $direccion

//      * @return ProveedorRut

    public function setDireccion(\App\Entity\Direccion $direccion = null)
    {
        $this->direccion = $direccion;

        return $this;
    }

//      * Get direccion.

//      * @return \App\Entity\Direccion|null

    public function getDireccion()
    {
        return $this->direccion;
    }

//      * Set proveedor.

//      * @param \App\Entity\Proveedor|null $proveedor

//      * @return ProveedorRut

    public function setProveedor(\App\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * Get proveedor.

//      * @return \App\Entity\Proveedor|null

    public function getProveedor()
    {
        return $this->proveedor;
    }

//      * Add actividade.

//      * @param \App\Entity\Actividad $actividade

//      * @return ProveedorRut

    public function addActividade(\App\Entity\Actividad $actividade)
    {
        $this->actividades[] = $actividade;

        return $this;
    }

//      * Remove actividade.

//      * @param \App\Entity\Actividad $actividade

//      * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.

    public function removeActividade(\App\Entity\Actividad $actividade)
    {
        return $this->actividades->removeElement($actividade);
    }

//      * Get actividades.

//      * @return \Doctrine\Common\Collections\Collection

    public function getActividades()
    {
        return $this->actividades;
    }

//      * Set emitirFacturacion.

//      * @param bool $emitirFacturacion

//      * @return ProveedorRut

    public function setEmitirFacturacion($emitirFacturacion)
    {
        $this->emitirFacturacion = $emitirFacturacion;

        return $this;
    }

//      * Get emitirFacturacion.

//      * @return bool

    public function getEmitirFacturacion()
    {
        return $this->emitirFacturacion;
    }

//      * Set ultimaFacturacion.

//      * @param \DateTime $ultimaFacturacion

//      * @return ProveedorRut

    public function setUltimaFacturacion($ultimaFacturacion)
    {
        $this->ultimaFacturacion = $ultimaFacturacion;

        return $this;
    }

//      * Get ultimaFacturacion.

//      * @return \DateTime

    public function getUltimaFacturacion()
    {
        return $this->ultimaFacturacion;
    }

//      * @return Collection|ActividadMarket[]
     
    public function getActividadMarkets(): Collection
    {
        return $this->actividadMarkets;
    }

    public function addActividadMarket(ActividadMarket $actividadMarket): self
    {
        if (!$this->actividadMarkets->contains($actividadMarket)) {
            $this->actividadMarkets[] = $actividadMarket;
            $actividadMarket->setProveedorRut($this);
        }

        return $this;
    }

    public function removeActividadMarket(ActividadMarket $actividadMarket): self
    {
        if ($this->actividadMarkets->contains($actividadMarket)) {
            $this->actividadMarkets->removeElement($actividadMarket);
            // set the owning side to null (unless already changed)
            if ($actividadMarket->getProveedorRut() === $this) {
                $actividadMarket->setProveedorRut(null);
            }
        }

        return $this;
    }

    public function getCuenta(): ?Cuenta
    {
        return $this->cuenta;
    }

    public function setCuenta(?Cuenta $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

//      * @return Collection|ActividadTipoPrecio[]

    public function getActividadTipoPrecios(): Collection
    {
        return $this->actividadTipoPrecios;
    }

    public function addActividadTipoPrecio(ActividadTipoPrecio $actividadTipoPrecio): self
    {
        if (!$this->actividadTipoPrecios->contains($actividadTipoPrecio)) {
            $this->actividadTipoPrecios[] = $actividadTipoPrecio;
            $actividadTipoPrecio->setProveedorRut($this);
        }

        return $this;
    }

    public function removeActividadTipoPrecio(ActividadTipoPrecio $actividadTipoPrecio): self
    {
        if ($this->actividadTipoPrecios->removeElement($actividadTipoPrecio)) {
            // set the owning side to null (unless already changed)
            if ($actividadTipoPrecio->getProveedorRut() === $this) {
                $actividadTipoPrecio->setProveedorRut(null);
            }
        }

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
            $liquidacione->setProveedorRut($this);
        }

        return $this;
    }

    public function removeLiquidacione(Liquidacion $liquidacione): self
    {
        if ($this->liquidaciones->removeElement($liquidacione)) {
            // set the owning side to null (unless already changed)
            if ($liquidacione->getProveedorRut() === $this) {
                $liquidacione->setProveedorRut(null);
            }
        }

        return $this;
    }

//      * @return Collection|Item[]

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setProveedorRut($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getProveedorRut() === $this) {
                $item->setProveedorRut(null);
            }
        }

        return $this;
    }
}
