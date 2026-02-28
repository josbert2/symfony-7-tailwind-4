<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Evence\Bundle\SoftDeleteableExtensionBundle\Mapping\Annotation as Evence;

//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="disponible", columns={"disponible"),
//  *     @ORM\Index(name="idx_aep_evento_market_disponible", columns={"actividad_evento_id", "market_id", "disponible")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\ActividadEventoPrecioRepository::class)]
//  * @ORM\HasLifecycleCallbacks

class ActividadEventoPrecio
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $cupos = 0;

    #[ORM\Column(type: 'integer')]
    private $precio = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioOld;

    #[ORM\Column(type: 'integer')]
    private $descuento = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $descuentoOld;

    #[ORM\Column(type: 'integer')]
    private $entradas = 0;

    #[ORM\Column(type: 'integer')]
    private $disponible = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoDescuento;

    #[ORM\Column(type: 'boolean')]
    private $bloqueado = false;

    #[ORM\ManyToOne(targetEntity: 'ActividadEvento', inversedBy: 'precios')]
    protected $actividadEvento;

    
    #[ORM\ManyToOne(targetEntity: 'Market', inversedBy: 'eventoPrecios')]
//      * @Evence\onSoftDelete(type="CASCADE")

    protected $market;

    #[ORM\ManyToOne(targetEntity: 'ActividadZona', inversedBy: 'eventoPrecios')]
//      * @Evence\onSoftDelete(type="CASCADE")

    protected $actividadZona;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\ActividadZonaPrecio', inversedBy: 'eventoPrecios')]
//      * @Evence\onSoftDelete(type="CASCADE")

    protected $actividadZonaPrecio;

    #[ORM\ManyToOne(targetEntity: 'Butaca', inversedBy: 'eventoPrecios')]
//      * @Evence\onSoftDelete(type="CASCADE")

    protected $butaca;

    #[ORM\ManyToOne(targetEntity: 'ActividadTipoPrecio', inversedBy: 'eventoPrecios')]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    protected $tipoPrecio;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ActividadEventoPrecioDescuento', mappedBy: 'actividadEventoPrecio')]
    protected $actividadEventoPrecioDescuento;

    #[ORM\OneToMany(targetEntity: 'Item', mappedBy: 'eventoPrecio')]
    protected $items;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Lista', mappedBy: 'actividadEventoPrecio')]
    protected $listas;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'actividadEventoPrecio')]
    protected $invitaciones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

//      * @ORM\PrePersist
//      * @ORM\PreUpdate

    public function setData()
    {
        $this->setDisponible($this->getCupos() - $this->getEntradas());
    }

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->listas = new ArrayCollection();
        $this->invitaciones = new ArrayCollection();
        $this->bodegaStocks = new ArrayCollection();
    }

    public function getActividad()
    {
        return $this->getActividadEvento()->getActividad();
    }

    public function getProveedor()
    {
        return $this->getActividadEvento()->getProveedor();
    }

    public function getPrecioFinal()
    {
        $precioFinal = $this->getPrecio() - $this->getDescuento();

        return $precioFinal;
    }

    public function getPorcentajeDescuento()
    {
        $porc = 0;

        if ($this->precio != 0) {
            $porc = $this->descuento / $this->precio * 100;
        }

        return $porc;
    }

    public function getDescuentoPromocion($promocion = NULL, $comuna = NULL)
    {
        /** @var Promocion $promocion */

        $precio = $this->getPrecio();
        $descuento = $this->getDescuento();
        $precioFinal = $this->getPrecioFinal();
        $descuentoPromocion = 0;

        if ($promocion) {
            $tipo = $promocion->getTipoDescuento();
            $monto = $promocion->getMonto();

            if (!$monto) {
                $proveedor = $promocion->getProveedor();
                $categorias = $promocion->getCategorias();
                $actividades = $promocion->getActividades();
                $comunas = $promocion->getComunas();

                if ($comuna && $comunas->count() > 0 && !$comunas->contains($comuna)) {
                    return $descuentoPromocion;
                }

                if (!$proveedor || $proveedor->getId() == $this->getProveedor()->getId()) {
                    $actividad = $this->getActividad();
                    $pCategoria = false;

                    if ($promocion->getCheckCategorias()) {
                        if ($categorias->contains($actividad->getCategoria())) {
                            $pCategoria = true;
                        } else {
                            foreach ($actividad->getCategorias() as $categoria) {
                                if ($categorias->contains($categoria)) {
                                    $pCategoria = true;
                                    break;
                                }
                            }

                            if (!$pCategoria) {
                                foreach ($actividad->getCategoriasArray() as $categoria) {
                                    if ($categorias->contains($categoria)) {
                                        $pCategoria = true;
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        $pCategoria = true;
                    }

                    $pActividad = !$promocion->getCheckActividades() || $actividades->contains($actividad);

                    if ((count($categorias) == 0 && count($actividades) == 0) || ($pActividad && $pCategoria)) {
                        $porcentaje = $promocion->getPorcentaje();
                        if ($porcentaje) {
                            if ($tipo == 'El mejor descuento') {
                                $descuentoCupon = $precio * $porcentaje / 100;
                                if ($descuentoCupon > $descuento) {
                                    $descuentoPromocion = $descuentoCupon - $descuento;
                                }
                            } else {
                                $descuentoPromocion = $precioFinal * $porcentaje / 100;
                            }
                        }
                    }
                }
            }

        }

        return $descuentoPromocion;
    }

    public function getCosto()
    {
        $costo = 0;
        if ($this->getTipoPrecio() && $this->getTipoPrecio()->getProducto()) {
            $costo = $this->getTipoPrecio()->getProducto()->getCosto();
        }

        return $costo;
    }

    public function getDisponible()
    {
        $disponible = $this->getCupos() - $this->getEntradas();

        return $disponible;
    }

    public function getActividadMarket()
    {
        foreach ($this->getActividad()->getActividadMarkets() as $actividadMarket) {
            if ($actividadMarket->getMarket() == $this->getMarket()) {
                return $actividadMarket;
            }
        }

        return NULL;
    }

    public function getProveedorMarket()
    {
        foreach ($this->getProveedor()->getProveedorMarkets() as $proveedorMarket) {
            if ($proveedorMarket->getMarket() == $this->getMarket()) {
                return $proveedorMarket;
            }
        }

        return NULL;
    }

    public function setCupos(int $cupos): self
    {
        $this->cupos = $cupos;
        $this->setDisponible($this->getCupos() - $this->getEntradas());

        return $this;
    }

    public function __toString()
    {
        return $this->cupos;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCupos(): ?int
    {
        return $this->cupos;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(int $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getEntradas(): ?int
    {
        return $this->entradas;
    }

    public function setEntradas(int $entradas): self
    {
        $this->entradas = $entradas;

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

    public function getActividadEvento(): ?ActividadEvento
    {
        return $this->actividadEvento;
    }

    public function setActividadEvento(?ActividadEvento $actividadEvento): self
    {
        $this->actividadEvento = $actividadEvento;

        return $this;
    }

    public function getTipoPrecio(): ?ActividadTipoPrecio
    {
        return $this->tipoPrecio;
    }

    public function setTipoPrecio(?ActividadTipoPrecio $tipoPrecio): self
    {
        $this->tipoPrecio = $tipoPrecio;

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
            $item->setEventoPrecio($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getEventoPrecio() === $this) {
                $item->setEventoPrecio(NULL);
            }
        }

        return $this;
    }

    public function getActividadZona(): ?ActividadZona
    {
        return $this->actividadZona;
    }

    public function setActividadZona(?ActividadZona $actividadZona): self
    {
        $this->actividadZona = $actividadZona;

        return $this;
    }

    public function getButaca(): ?Butaca
    {
        return $this->butaca;
    }

    public function setButaca(?Butaca $butaca): self
    {
        $this->butaca = $butaca;

        return $this;
    }

    public function getBloqueado(): ?bool
    {
        return $this->bloqueado;
    }

    public function setBloqueado(bool $bloqueado): self
    {
        $this->bloqueado = $bloqueado;

        return $this;
    }

//      * @return Collection|Lista[]

    public function getListas(): Collection
    {
        return $this->listas;
    }

    public function addLista(Lista $lista): self
    {
        if (!$this->listas->contains($lista)) {
            $this->listas[] = $lista;
            $lista->setActividadEventoPrecio($this);
        }

        return $this;
    }

    public function removeLista(Lista $lista): self
    {
        if ($this->listas->contains($lista)) {
            $this->listas->removeElement($lista);
            // set the owning side to null (unless already changed)
            if ($lista->getActividadEventoPrecio() === $this) {
                $lista->setActividadEventoPrecio(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|Invitacion[]

    public function getInvitaciones(): Collection
    {
        return $this->invitaciones;
    }

    public function addInvitacione(Invitacion $invitacione): self
    {
        if (!$this->invitaciones->contains($invitacione)) {
            $this->invitaciones[] = $invitacione;
            $invitacione->setActividadEventoPrecio($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->contains($invitacione)) {
            $this->invitaciones->removeElement($invitacione);
            // set the owning side to null (unless already changed)
            if ($invitacione->getActividadEventoPrecio() === $this) {
                $invitacione->setActividadEventoPrecio(NULL);
            }
        }

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

    public function getActividadEventoPrecioDescuento(): ?ActividadEventoPrecioDescuento
    {
        return $this->actividadEventoPrecioDescuento;
    }

    public function setActividadEventoPrecioDescuento(?ActividadEventoPrecioDescuento $actividadEventoPrecioDescuento): self
    {
        $this->actividadEventoPrecioDescuento = $actividadEventoPrecioDescuento;

        // set (or unset) the owning side of the relation if necessary
        $newActividadEventoPrecio = $actividadEventoPrecioDescuento === NULL ? NULL : $this;
        if ($newActividadEventoPrecio !== $actividadEventoPrecioDescuento->getActividadEventoPrecio()) {
            $actividadEventoPrecioDescuento->setActividadEventoPrecio($newActividadEventoPrecio);
        }

        return $this;
    }

    public function getActividadZonaPrecio(): ?ActividadZonaPrecio
    {
        return $this->actividadZonaPrecio;
    }

    public function setActividadZonaPrecio(?ActividadZonaPrecio $actividadZonaPrecio): self
    {
        $this->actividadZonaPrecio = $actividadZonaPrecio;

        return $this;
    }

    public function setDisponible(int $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getDescuentoOld(): ?int
    {
        return $this->descuentoOld;
    }

    public function setDescuentoOld(?int $descuentoOld): self
    {
        $this->descuentoOld = $descuentoOld;

        return $this;
    }

    public function getPrecioOld(): ?int
    {
        return $this->precioOld;
    }

    public function setPrecioOld(?int $precioOld): self
    {
        $this->precioOld = $precioOld;

        return $this;
    }

}
