<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OrderBy;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


    #[ORM\Entity(repositoryClass: App\Repository\MarketRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]
//  * @Vich\Uploadable()
//  * @ORM\Table(
//  *     name="market",
//  *     indexes={
//  *         @ORM\Index(name="idx_mostrar_actividades_terminadas", columns={"mostrar_actividades_terminadas")
//  *     }
//  * )

class Market
{
    #[ORM\Id]
    #[ORM\GeneratedValue]()
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $urlInicio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $dominio;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sigla;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoComercioWebpay;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoComercioOneClick;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mercadoPagoAccessToken;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fpayClientId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fpayClientSecret;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bsaleToken;

    #[ORM\Column(type: 'json', nullable: true)]
    private $correos = [];

    #[ORM\Column(type: 'boolean')]
    private $correosDominio = false;

    #[ORM\Column(type: 'boolean')]
    private $dominioConectado = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $googleAnalyticsId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $facebookPixelId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $googleTagManagerId;

    #[ORM\Column(type: 'boolean')]
    private $googleLogin = false;

    #[ORM\Column(type: 'boolean')]
    private $googleRecaptcha = false;

    #[ORM\Column(type: 'boolean')]
    private $consentimientoCookies = false;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\Column(type: 'boolean')]
    private $productivo = false;

    #[ORM\Column(type: 'text', nullable: true)]
    private $contactanosCuadro;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $facebookUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $instagramUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tiktokUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $twitterUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $youtubeUrl;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $linkedinUrl;

    #[ORM\Column(type: 'text', nullable: true)]
    private $logoCuadro;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $logoName;

    #[ORM\Column(type: 'json', nullable: true)]
    private $variables = [];

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'App\Entity\VichFile', inversedBy: 'marketLogo')]
     
    protected $logo;

//      * @Assert\Valid
    #[ORM\OneToOne(targetEntity: 'App\Entity\VichFile', inversedBy: 'marketImagenRRSS')]

    protected $imagenRRSS;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Template', inversedBy: 'markets')]
    protected $template;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Categoria', inversedBy: 'markets')]
    protected $categorias;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Categoria', inversedBy: 'markets')]
    #[ORM\JoinTable(name: 'market_categoria_destacada')]
    protected $categoriasDestacadas;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Promocion', mappedBy: 'markets')]
    protected $promociones;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Proveedor', mappedBy: 'market')]
    protected $proveedor;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadEventoPrecio', mappedBy: 'market')]
    protected $eventoPrecios;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CodigoExterno', mappedBy: 'market')]
    protected $codigosExternos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ProveedorMarket', mappedBy: 'market')]
    protected $proveedorMarkets;

    #[ORM\OneToMany(targetEntity: 'App\Entity\MarketTemplate', mappedBy: 'market')]
    protected $marketTemplates;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadMarket', mappedBy: 'market')]
    protected $actividadMarkets;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadTipoPrecioMarket', mappedBy: 'market')]
    protected $actividadTipoPrecioMarkets;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Item', mappedBy: 'market')]
    protected $items;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Punto', mappedBy: 'market')]
    protected $puntos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Cliente', mappedBy: 'market')]
    protected $clientes;

    #[ORM\OneToMany(targetEntity: 'Lista', mappedBy: 'market')]
    protected $listas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\TransaccionDetalle', mappedBy: 'market')]
    protected $transaccionDetalles;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\ActividadEvento', mappedBy: 'markets')]
    protected $eventos;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'market', targetEntity: ActividadEstadistica::class)]
    private $actividadEstadisticas;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $timezone = 'America/Santiago';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 4, nullable: true)]
    private $iva_pais = 1.1900;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $easy_cancellation;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $money_back_insurance;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $easyCancellationHours;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $easyCancellationHoursWithoutPenalty;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $easyCancellationPercentage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $moneyBackInsurancePercentage;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $correoResenaSubject;

    #[ORM\Column(type: 'text', nullable: true)]
    private $correoResenaBody;

    #[ORM\Column(type: 'text', nullable: true)]
    private $ticketsTemplates;
    
    #[ORM\Column(type: 'text', nullable: true)]
    private $ticketsTemplateComentario;

    #[ORM\Column(type: 'string', length: 50)]
    private $configuracionMensajes = 'ambos';

    #[ORM\OneToMany(targetEntity: 'ActividadMensaje', mappedBy: 'market', orphanRemoval: true)]
    private $actividadMensajes;
    
    // Constructor removed to be merged into the primary one below

//      * @return Collection|ActividadMensaje[]

    public function getActividadMensajes(): Collection
    {
        return $this->actividadMensajes;
    }

    public function addActividadMensaje(ActividadMensaje $actividadMensaje): self
    {
        if (!$this->actividadMensajes->contains($actividadMensaje)) {
            $this->actividadMensajes[] = $actividadMensaje;
            $actividadMensaje->setMarket($this);
        }

        return $this;
    }

    public function removeActividadMensaje(ActividadMensaje $actividadMensaje): self
    {
        if ($this->actividadMensajes->contains($actividadMensaje)) {
            $this->actividadMensajes->removeElement($actividadMensaje);
            // set the owning side to null (unless already changed)
            if ($actividadMensaje->getMarket() === $this) {
                // $actividadMensaje->setMarket(null); // Not nullable in entity, so orphanRemoval handles it
            }
        }

        return $this;
    }

    #[ORM\Column(type: 'text', nullable: true)]
    private $mensajeCorreo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $terminosYCondiciones;  

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $mostrarActividadesTerminadas;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\MarketModals', mappedBy: 'markets')]
    protected $marketModals;

    public function getFromEmail()
    {
        $dominio = ($this->getCorreosDominio() || !$this->getProveedor()) ? $this->getDominio() : 'bookforce.io';
        return 'no-reply@' . $dominio;
    }

    public function getReplyToEmail()
    {
        return $this->getProveedor() && !$this->getDominio() ? $this->getProveedor()->getEmail() : NULL;
    }

    public function __construct()
    {
        $this->actividadMensajes = new ArrayCollection();
        $this->categorias = new ArrayCollection();
        $this->promociones = new ArrayCollection();
        $this->eventoPrecios = new ArrayCollection();
        $this->codigosExternos = new ArrayCollection();
        $this->proveedorMarkets = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->eventos = new ArrayCollection();
        $this->puntos = new ArrayCollection();
        $this->clientes = new ArrayCollection();
        $this->actividadMarkets = new ArrayCollection();
        $this->listas = new ArrayCollection();
        $this->transaccionDetalles = new ArrayCollection();
        $this->actividadTipoPrecioMarkets = new ArrayCollection();
        $this->actividadEstadisticas = new ArrayCollection();
        $this->marketTemplates = new ArrayCollection();
        $this->categoriasDestacadas = new ArrayCollection();
        $this->marketModals = new ArrayCollection();
    }

    public function getClass()
    {
        return strtolower((new \ReflectionClass($this))->getShortName());
    }

    public function setLogo(?VichFile $logo): self
    {
        $logo->setMarketLogo($this);
        $this->logo = $logo;

        return $this;
    }

    public function setImagenRRSS(?VichFile $imagenRRSS): self
    {
        $imagenRRSS->setMarketImagenRRSS($this);
        $this->imagenRRSS = $imagenRRSS;

        return $this;
    }

    public function __toString()
    {
        return $this->getNombre();
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getConsentimientoCookies(): ?bool
    {
        return $this->consentimientoCookies;
    }

    public function setConsentimientoCookies(bool $consentimientoCookies): self
    {
        $this->consentimientoCookies = $consentimientoCookies;

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

//      * @return Collection|Categoria[]

    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
            $categoria->addMarket($this);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->contains($categoria)) {
            $this->categorias->removeElement($categoria);
            $categoria->removeMarket($this);
        }

        return $this;
    }

//      * @return Collection|Promocion[]

    public function getPromociones(): Collection
    {
        return $this->promociones;
    }

    public function addPromocione(Promocion $promocione): self
    {
        if (!$this->promociones->contains($promocione)) {
            $this->promociones[] = $promocione;
            $promocione->addMarket($this);
        }

        return $this;
    }

    public function removePromocione(Promocion $promocione): self
    {
        if ($this->promociones->contains($promocione)) {
            $this->promociones->removeElement($promocione);
            $promocione->removeMarket($this);
        }

        return $this;
    }

//      * @return Collection|ActividadEventoPrecio[]

    public function getEventoPrecios(): Collection
    {
        return $this->eventoPrecios;
    }

    public function addEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if (!$this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios[] = $eventoPrecio;
            $eventoPrecio->setMarket($this);
        }

        return $this;
    }

    public function removeEventoPrecio(ActividadEventoPrecio $eventoPrecio): self
    {
        if ($this->eventoPrecios->contains($eventoPrecio)) {
            $this->eventoPrecios->removeElement($eventoPrecio);
            // set the owning side to null (unless already changed)
            if ($eventoPrecio->getMarket() === $this) {
                $eventoPrecio->setMarket(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|CodigoExterno[]

    public function getCodigosExternos(): Collection
    {
        return $this->codigosExternos;
    }

    public function addCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if (!$this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos[] = $codigosExterno;
            $codigosExterno->setMarket($this);
        }

        return $this;
    }

    public function removeCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if ($this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos->removeElement($codigosExterno);
            // set the owning side to null (unless already changed)
            if ($codigosExterno->getMarket() === $this) {
                $codigosExterno->setMarket(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|ProveedorMarket[]

    public function getProveedorMarkets(): Collection
    {
        return $this->proveedorMarkets;
    }

    public function addProveedorMarket(ProveedorMarket $proveedorMarket): self
    {
        if (!$this->proveedorMarkets->contains($proveedorMarket)) {
            $this->proveedorMarkets[] = $proveedorMarket;
            $proveedorMarket->setMarket($this);
        }

        return $this;
    }

    public function removeProveedorMarket(ProveedorMarket $proveedorMarket): self
    {
        if ($this->proveedorMarkets->contains($proveedorMarket)) {
            $this->proveedorMarkets->removeElement($proveedorMarket);
            // set the owning side to null (unless already changed)
            if ($proveedorMarket->getMarket() === $this) {
                $proveedorMarket->setMarket(NULL);
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
            $item->setMarket($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getMarket() === $this) {
                $item->setMarket(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadEvento[]

    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(ActividadEvento $evento): self
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos[] = $evento;
            $evento->addMarket($this);
        }

        return $this;
    }

    public function removeEvento(ActividadEvento $evento): self
    {
        if ($this->eventos->contains($evento)) {
            $this->eventos->removeElement($evento);
            $evento->removeMarket($this);
        }

        return $this;
    }

//      * @return Collection|Punto[]

    public function getPuntos(): Collection
    {
        return $this->puntos;
    }

    public function addPunto(Punto $punto): self
    {
        if (!$this->puntos->contains($punto)) {
            $this->puntos[] = $punto;
            $punto->setMarket($this);
        }

        return $this;
    }

    public function removePunto(Punto $punto): self
    {
        if ($this->puntos->contains($punto)) {
            $this->puntos->removeElement($punto);
            // set the owning side to null (unless already changed)
            if ($punto->getMarket() === $this) {
                $punto->setMarket(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|Cliente[]

    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setMarket($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->contains($cliente)) {
            $this->clientes->removeElement($cliente);
            // set the owning side to null (unless already changed)
            if ($cliente->getMarket() === $this) {
                $cliente->setMarket(NULL);
            }
        }

        return $this;
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
            $actividadMarket->setMarket($this);
        }

        return $this;
    }

    public function removeActividadMarket(ActividadMarket $actividadMarket): self
    {
        if ($this->actividadMarkets->contains($actividadMarket)) {
            $this->actividadMarkets->removeElement($actividadMarket);
            // set the owning side to null (unless already changed)
            if ($actividadMarket->getMarket() === $this) {
                $actividadMarket->setMarket(NULL);
            }
        }

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
            $lista->setMarket($this);
        }

        return $this;
    }

    public function removeLista(Lista $lista): self
    {
        if ($this->listas->contains($lista)) {
            $this->listas->removeElement($lista);
            // set the owning side to null (unless already changed)
            if ($lista->getMarket() === $this) {
                $lista->setMarket(NULL);
            }
        }

        return $this;
    }

    public function getUrlInicio(): ?string
    {
        return $this->urlInicio;
    }

    public function setUrlInicio(?string $urlInicio): self
    {
        $this->urlInicio = $urlInicio;

        return $this;
    }

    public function getProductivo(): ?bool
    {
        return $this->productivo;
    }

    public function setProductivo(bool $productivo): self
    {
        $this->productivo = $productivo;

        return $this;
    }

    public function getSigla(): ?string
    {
        return $this->sigla;
    }

    public function setSigla(?string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
    }

    public function getDominio(): ?string
    {
        return $this->dominio;
    }

    public function setDominio(?string $dominio): self
    {
        $this->dominio = $dominio;

        return $this;
    }

    public function getCodigoComercioWebpay(): ?string
    {
        return $this->codigoComercioWebpay;
    }

    public function setCodigoComercioWebpay(?string $codigoComercioWebpay): self
    {
        $this->codigoComercioWebpay = $codigoComercioWebpay;

        return $this;
    }

    public function getCodigoComercioOneClick(): ?string
    {
        return $this->codigoComercioOneClick;
    }

    public function setCodigoComercioOneClick(?string $codigoComercioOneClick): self
    {
        $this->codigoComercioOneClick = $codigoComercioOneClick;

        return $this;
    }

//      * @return Collection|TransaccionDetalle[]

    public function getTransaccionDetalles(): Collection
    {
        return $this->transaccionDetalles;
    }

    public function addTransaccionDetalle(TransaccionDetalle $transaccionDetalle): self
    {
        if (!$this->transaccionDetalles->contains($transaccionDetalle)) {
            $this->transaccionDetalles[] = $transaccionDetalle;
            $transaccionDetalle->setMarket($this);
        }

        return $this;
    }

    public function removeTransaccionDetalle(TransaccionDetalle $transaccionDetalle): self
    {
        if ($this->transaccionDetalles->removeElement($transaccionDetalle)) {
            // set the owning side to null (unless already changed)
            if ($transaccionDetalle->getMarket() === $this) {
                $transaccionDetalle->setMarket(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadTipoPrecioMarket[]

    public function getActividadTipoPrecioMarkets(): Collection
    {
        return $this->actividadTipoPrecioMarkets;
    }

    public function addActividadTipoPrecioMarket(ActividadTipoPrecioMarket $actividadTipoPrecioMarket): self
    {
        if (!$this->actividadTipoPrecioMarkets->contains($actividadTipoPrecioMarket)) {
            $this->actividadTipoPrecioMarkets[] = $actividadTipoPrecioMarket;
            $actividadTipoPrecioMarket->setMarket($this);
        }

        return $this;
    }

    public function removeActividadTipoPrecioMarket(ActividadTipoPrecioMarket $actividadTipoPrecioMarket): self
    {
        if ($this->actividadTipoPrecioMarkets->removeElement($actividadTipoPrecioMarket)) {
            // set the owning side to null (unless already changed)
            if ($actividadTipoPrecioMarket->getMarket() === $this) {
                $actividadTipoPrecioMarket->setMarket(NULL);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadEstadistica[]

    public function getActividadEstadisticas(): Collection
    {
        return $this->actividadEstadisticas;
    }

    public function addActividadEstadistica(ActividadEstadistica $actividadEstadistica): self
    {
        if (!$this->actividadEstadisticas->contains($actividadEstadistica)) {
            $this->actividadEstadisticas[] = $actividadEstadistica;
            $actividadEstadistica->setMarket($this);
        }

        return $this;
    }

    public function removeActividadEstadistica(ActividadEstadistica $actividadEstadistica): self
    {
        if ($this->actividadEstadisticas->removeElement($actividadEstadistica)) {
            // set the owning side to null (unless already changed)
            if ($actividadEstadistica->getMarket() === $this) {
                $actividadEstadistica->setMarket(NULL);
            }
        }

        return $this;
    }

    public function getMercadoPagoAccessToken(): ?string
    {
        return $this->mercadoPagoAccessToken;
    }

    public function setMercadoPagoAccessToken(?string $mercadoPagoAccessToken): self
    {
        $this->mercadoPagoAccessToken = $mercadoPagoAccessToken;

        return $this;
    }

    public function getFpayClientId(): ?string
    {
        return $this->fpayClientId;
    }

    public function setFpayClientId(?string $fpayClientId): self
    {
        $this->fpayClientId = $fpayClientId;

        return $this;
    }

    public function getFpayClientSecret(): ?string
    {
        return $this->fpayClientSecret;
    }

    public function setFpayClientSecret(?string $fpayClientSecret): self
    {
        $this->fpayClientSecret = $fpayClientSecret;

        return $this;
    }

    public function getBsaleToken(): ?string
    {
        return $this->bsaleToken;
    }

    public function setBsaleToken(?string $bsaleToken): self
    {
        $this->bsaleToken = $bsaleToken;

        return $this;
    }

    public function getCorreos(): ?array
    {
        return $this->correos;
    }

    public function setCorreos(?array $correos): self
    {
        $this->correos = $correos;

        return $this;
    }

    public function getCorreosDominio(): ?bool
    {
        return $this->correosDominio;
    }

    public function setCorreosDominio(bool $correosDominio): self
    {
        $this->correosDominio = $correosDominio;

        return $this;
    }

    public function getDominioConectado(): ?bool
    {
        return $this->dominioConectado;
    }

    public function setDominioConectado(bool $dominioConectado): self
    {
        $this->dominioConectado = $dominioConectado;

        return $this;
    }

    public function getGoogleAnalyticsId(): ?string
    {
        return $this->googleAnalyticsId;
    }

    public function setGoogleAnalyticsId(?string $googleAnalyticsId): self
    {
        $this->googleAnalyticsId = $googleAnalyticsId;

        return $this;
    }

    public function getFacebookPixelId(): ?string
    {
        return $this->facebookPixelId;
    }

    public function setFacebookPixelId(?string $facebookPixelId): self
    {
        $this->facebookPixelId = $facebookPixelId;

        return $this;
    }

    public function getGoogleTagManagerId(): ?string
    {
        return $this->googleTagManagerId;
    }

    public function setGoogleTagManagerId(?string $googleTagManagerId): self
    {
        $this->googleTagManagerId = $googleTagManagerId;

        return $this;
    }

    public function getGoogleLogin(): ?bool
    {
        return $this->googleLogin;
    }

    public function setGoogleLogin(bool $googleLogin): self
    {
        $this->googleLogin = $googleLogin;

        return $this;
    }

    public function getGoogleRecaptcha(): ?bool
    {
        return $this->googleRecaptcha;
    }

    public function setGoogleRecaptcha(bool $googleRecaptcha): self
    {
        $this->googleRecaptcha = $googleRecaptcha;

        return $this;
    }

    public function getContactanosCuadro(): ?string
    {
        return $this->contactanosCuadro;
    }

    public function setContactanosCuadro(?string $contactanosCuadro): self
    {
        $this->contactanosCuadro = $contactanosCuadro;

        return $this;
    }

    public function getFacebookUrl(): ?string
    {
        return $this->facebookUrl;
    }

    public function setFacebookUrl(?string $facebookUrl): self
    {
        $this->facebookUrl = $facebookUrl;

        return $this;
    }

    public function getInstagramUrl(): ?string
    {
        return $this->instagramUrl;
    }

    public function setInstagramUrl(?string $instagramUrl): self
    {
        $this->instagramUrl = $instagramUrl;

        return $this;
    }

    public function getTiktokUrl(): ?string
    {
        return $this->tiktokUrl;
    }

    public function setTiktokUrl(?string $tiktokUrl): self
    {
        $this->tiktokUrl = $tiktokUrl;

        return $this;
    }

    public function getTwitterUrl(): ?string
    {
        return $this->twitterUrl;
    }

    public function setTwitterUrl(?string $twitterUrl): self
    {
        $this->twitterUrl = $twitterUrl;

        return $this;
    }

    public function getYoutubeUrl(): ?string
    {
        return $this->youtubeUrl;
    }

    public function setYoutubeUrl(?string $youtubeUrl): self
    {
        $this->youtubeUrl = $youtubeUrl;

        return $this;
    }

    public function getLinkedinUrl(): ?string
    {
        return $this->linkedinUrl;
    }

    public function setLinkedinUrl(?string $linkedinUrl): self
    {
        $this->linkedinUrl = $linkedinUrl;

        return $this;
    }

    public function getLogoCuadro(): ?string
    {
        return $this->logoCuadro;
    }

    public function setLogoCuadro(?string $logoCuadro): self
    {
        $this->logoCuadro = $logoCuadro;

        return $this;
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        // unset the owning side of the relation if necessary
        if ($proveedor === NULL && $this->proveedor !== NULL) {
            $this->proveedor->setMarket(NULL);
        }

        // set the owning side of the relation if necessary
        if ($proveedor !== NULL && $proveedor->getMarket() !== $this) {
            $proveedor->setMarket($this);
        }

        $this->proveedor = $proveedor;

        return $this;
    }

//      * @return Collection|MarketTemplate[]

    public function getMarketTemplates(): Collection
    {
        return $this->marketTemplates;
    }

    public function addMarketTemplate(MarketTemplate $marketTemplate): self
    {
        if (!$this->marketTemplates->contains($marketTemplate)) {
            $this->marketTemplates[] = $marketTemplate;
            $marketTemplate->setMarket($this);
        }

        return $this;
    }

    public function removeMarketTemplate(MarketTemplate $marketTemplate): self
    {
        if ($this->marketTemplates->removeElement($marketTemplate)) {
            // set the owning side to null (unless already changed)
            if ($marketTemplate->getMarket() === $this) {
                $marketTemplate->setMarket(NULL);
            }
        }

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getVariables(): ?array
    {
        return $this->variables;
    }

    public function setVariables(?array $variables): self
    {
        $this->variables = $variables;

        return $this;
    }

    public function getLogo(): ?VichFile
    {
        return $this->logo;
    }

    public function getImagenRRSS(): ?VichFile
    {
        return $this->imagenRRSS;
    }

    public function getLogoName(): ?string
    {
        return $this->logoName;
    }

    public function setLogoName(?string $logoName): self
    {
        $this->logoName = $logoName;

        return $this;
    }

//      * @return Collection|Categoria[]

    public function getCategoriasDestacadas(): Collection
    {
        return $this->categoriasDestacadas;
    }

    public function addCategoriasDestacada(Categoria $categoriasDestacada): self
    {
        if (!$this->categoriasDestacadas->contains($categoriasDestacada)) {
            $this->categoriasDestacadas[] = $categoriasDestacada;
        }

        return $this;
    }

    public function removeCategoriasDestacada(Categoria $categoriasDestacada): self
    {
        $this->categoriasDestacadas->removeElement($categoriasDestacada);

        return $this;
    }

    public function getIva(): ?float
    {
        return $this->iva_pais;
    }

    public function gettimezone(): ?string
    {
        return $this->timezone;
    }

    public function setEasyCancellation(bool $easy_cancellation): self
    {
        $this->easy_cancellation = $easy_cancellation;

        return $this;
    }

    public function getEasyCancellation(): ?bool
    {
        return $this->easy_cancellation;
    }

    public function setMoneyBackInsurance(bool $money_back_insurance): self
    {
        $this->money_back_insurance = $money_back_insurance;

        return $this;
    }

    public function getMoneyBackInsurance(): ?bool
    {
        return $this->money_back_insurance;
    }

    public function setTimezone(?string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getIvaPais(): ?float
    {
        return $this->iva_pais;
    }

    public function setIvaPais(?float $iva_pais): self
    {
        $this->iva_pais = $iva_pais;

        return $this;
    }

    public function getEasyCancellationHours()
    {
        return $this->easyCancellationHours;
    }

    public function setEasyCancellationHours($easyCancellationHours)
    {
        $this->easyCancellationHours = $easyCancellationHours;
    }

    public function getEasyCancellationHoursWithoutPenalty()
    {
        return $this->easyCancellationHoursWithoutPenalty;
    }

    public function setEasyCancellationHoursWithoutPenalty($value)
    {
        $this->easyCancellationHoursWithoutPenalty = $value;
    }

    public function getEasyCancellationPercentage()
    {
        return $this->easyCancellationPercentage;
    }

    public function setEasyCancellationPercentage($value)
    {
        $this->easyCancellationPercentage = $value;
    }

    public function getMoneyBackInsurancePercentage()
    {
        return $this->moneyBackInsurancePercentage;
    }

    public function setMoneyBackInsurancePercentage($value)
    {
        $this->moneyBackInsurancePercentage = $value;
    }
    
    public function getCorreoResenaSubject(): ?string
    {
        return $this->correoResenaSubject;
    }

    public function setCorreoResenaSubject(?string $correoResenaSubject): self
    {
        $this->correoResenaSubject = $correoResenaSubject;

        return $this;
    }

    public function getCorreoResenaBody(): ?string
    {
        return $this->correoResenaBody;
    }

    public function setCorreoResenaBody(?string $correoResenaBody): self
    {
        $this->correoResenaBody = $correoResenaBody;

        return $this;
    }

    public function getTicketsTemplates(): ?string
    {
        return $this->ticketsTemplates;
    }

    public function setTicketsTemplates(?string $ticketsTemplates): self
    {
        $this->ticketsTemplates = $ticketsTemplates;

        return $this;
    }

    public function getTicketsTemplateComentario(): ?string
    {
        return $this->ticketsTemplateComentario;
    }

    public function setTicketsTemplateComentario(?string $ticketsTemplateComentario): self
    {
        $this->ticketsTemplateComentario = $ticketsTemplateComentario;
    
        return $this;
    }

    public function getMensajeCorreo(): ?string
    {
        return $this->mensajeCorreo;
    }

    public function setMensajeCorreo(?string $mensajeCorreo): self
    {
        $this->mensajeCorreo = $mensajeCorreo;

        return $this;
    }
  
    public function getTerminosYCondiciones(): ?string
    {
        return $this->terminosYCondiciones;
    }

    public function setTerminosYCondiciones(?string $terminosYCondiciones): self
    {
        $this->terminosYCondiciones = $terminosYCondiciones;

        return $this;
    }

    public function getMostrarActividadesTerminadas(): ?bool
    {
        return $this->mostrarActividadesTerminadas;
    }


    public function setMostrarActividadesTerminadas(?bool $mostrarActividadesTerminadas): self
    {
        $this->mostrarActividadesTerminadas = $mostrarActividadesTerminadas;

        return $this;
    }

//      * @return Collection|MarketModals[]

    public function getMarketModals(): Collection
    {
        return $this->marketModals;
    }

    public function addMarketModal(MarketModals $marketModal): self
    {
        if (!$this->marketModals->contains($marketModal)) {
            $this->marketModals[] = $marketModal;
            $marketModal->setMarket($this);
        }

        return $this;
    }

    public function removeMarketModal(MarketModals $marketModal): self
    {
        if ($this->marketModals->removeElement($marketModal)) {
            // set the owning side to null (unless already changed)
            if ($marketModal->getMarket() === $this) {
                $marketModal->setMarket(null);
            }
        }

        return $this;
    }
    public function getConfiguracionMensajes(): string
    {
        return $this->configuracionMensajes;
    }

    public function setConfiguracionMensajes(string $configuracionMensajes): self
    {
        $this->configuracionMensajes = $configuracionMensajes;

        return $this;
    }
}

