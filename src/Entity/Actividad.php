<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OrderBy;
use Evence\Bundle\SoftDeleteableExtensionBundle\Mapping\Annotation as Evence;

//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="activo", columns={"activo"),
//  *     @ORM\Index(name="deleted", columns={"deleted"),
//  *     @ORM\Index(name="autorizable", columns={"autorizable"),
//  *     @ORM\Index(name="idx_fecha_visible", columns={"fecha_visible"),
//  *     @ORM\Index(name="idx_actividad_deleted_proveedor", columns={"deleted", "proveedor_id")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\ActividadRepository::class)]

class Actividad
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcionCorta;
    
    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcion;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cupos;
    
    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaInicio;
    
    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaTermino;

    #[ORM\Column(type: 'boolean')]
    private $omitirFechas = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $duracion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoOmision;
    
    #[ORM\Column(type: 'date', nullable: true)]
    private $omision;

    #[ORM\Column(type: 'boolean')]
    private $visible = true;
    
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaVisible;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $limiteReservas;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaTope;

    #[ORM\Column(type: 'integer')]
    private $cierreReservas = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cierreReservasUnidad;

    #[ORM\Column(type: 'boolean')]
    private $fullDay = false;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $programacion;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $programacionCada;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $sesionesMax;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $formatoDescuento;
//
//    /**
     */
//     * #[ORM\Column(type: 'integer')]
// //     */
//    private $cuposPlataforma;
//
//    /**
     */
//     * #[ORM\Column(type: 'integer', nullable: true)]
// //     */
//    private $cuposReserva;
//    
//    /**
     */
//     * #[ORM\Column(type: 'integer')]
// //     */
//    private $cuposTotales;
//    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cuidadores;
    
    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $edadDesde;
    
    #[ORM\Column(type: 'decimal', scale: 1, nullable: true)]
    private $edadHasta;
    
    #[ORM\Column(type: 'boolean')]
    private $todaEdad = false;
    
    #[ORM\Column(type: 'boolean')]
    private $preNatal = false;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lider;
    
    #[ORM\Column(type: 'boolean')]
    private $cancelable = false;
    
    #[ORM\Column(type: 'integer', nullable: true)]
    private $horasCancelacion;
    
    #[ORM\Column(type: 'array')]
    private $tipos;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sitioWeb;

    #[ORM\Column(type: 'text', nullable: true)]
    private $instrucciones;

    #[ORM\Column(type: 'text', nullable: true)]
    private $referencias;
    
    #[ORM\Column(type: 'integer')]
    private $cobroVariable = 0;
    
    #[ORM\Column(type: 'integer')]
    private $impresiones = 0;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\Column(type: 'boolean')]
    private $codigoExterno = false;

    #[ORM\Column(type: 'boolean')]
    private $codigoDoble = false;

    #[ORM\Column(type: 'boolean')]
    private $alfanumerico = false;

    #[ORM\Column(type: 'boolean')]
    private $codigoGrafico = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoCodigo;

    #[ORM\Column(type: 'boolean')]
    private $alfanumericoExterno = false;

    #[ORM\Column(type: 'boolean')]
    private $codigoGraficoExterno = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoCodigoExterno;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $allowed_only_in_start_activity_event = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $before_event_minutes = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $after_event_minutes = 0;

    #[ORM\Column(type: 'boolean')]
    private $entregaInformacion = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $pedirInformacion;

    #[ORM\Column(type: 'boolean')]
    private $entregaRut = false;

    #[ORM\Column(type: 'boolean')]
    private $entregaNombre = false;

    #[ORM\Column(type: 'boolean')]
    private $entregaTelefono = false;

    #[ORM\Column(type: 'boolean')]
    private $entregaEmail = false;

    #[ORM\Column(type: 'boolean')]
    private $entregaDireccion = false;

    #[ORM\Column(type: 'boolean')]
    private $entregaObservaciones = false;

    #[ORM\Column(type: 'boolean')]
    private $codigoRut = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $modeloVenta;

    #[ORM\Column(type: 'boolean')]
    private $entradasCaducadas = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionActividad = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionZona = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionTipoPrecio = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionInstancia = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionDias = false;

    #[ORM\Column(type: 'boolean')]
    private $validacionValor = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoCaducidad;

    #[ORM\Column(type: 'integer')]
    private $desdeCaducado = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $desdeCaducadoUnidad;

    #[ORM\Column(type: 'integer')]
    private $hastaCaducado = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hastaCaducadoUnidad;

    #[ORM\Column(type: 'boolean')]
    private $dependenciaTipoPrecio = false;

    #[ORM\Column(type: 'integer')]
    private $maximoEntradas = 0;

    #[ORM\Column(type: 'integer')]
    private $maximoValidaciones = 0;

    #[ORM\Column(type: 'boolean')]
    private $desactivarMapa = false;

    #[ORM\Column(type: 'boolean')]
    private $usarZonas = false;

    #[ORM\Column(type: 'array')]
    private $checksForm;

    #[ORM\Column(type: 'boolean')]
    private $autorizable = false;

    #[ORM\Column(type: 'text', nullable: true)]
    private $politicas;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estado = 'En Carga';

    #[ORM\Column(type: 'boolean')]
    private $emailCompra = true;

    #[ORM\Column(type: 'text', nullable: true)]
    private $urlResena;

    #[ORM\Column(type: 'text', nullable: true)]
    private $urlYoutube;

    #[ORM\Column(type: 'boolean')]
    private $urlYoutubeFotos = false;

    #[ORM\Column(type: 'text', nullable: true)]
    private $urlInstagram;

    #[ORM\Column(type: 'boolean')]
    private $urlInstagramFotos = false;

    #[ORM\OneToOne(targetEntity: 'Direccion', inversedBy: 'actividad')]
    protected $direccion;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'actividades')]
    protected $proveedor;
    
    #[ORM\ManyToOne(targetEntity: 'Categoria', inversedBy: 'actividadesPrincipales')]
    protected $categoria;

    #[ORM\ManyToOne(targetEntity: 'ProveedorRut', inversedBy: 'actividades')]
    protected $proveedorRut;

    
    #[ORM\ManyToOne(targetEntity: 'Mapa', inversedBy: 'actividades')]
//      *  @Evence\onSoftDelete(type="SET NULL")

    protected $mapa;
    
    #[ORM\ManyToMany(targetEntity: 'Categoria', inversedBy: 'actividades')]
    protected $categorias;
    
    #[ORM\ManyToMany(targetEntity: 'Tag', inversedBy: 'actividades')]
    protected $tags;
    
    #[ORM\ManyToMany(targetEntity: 'Staff', inversedBy: 'actividades')]
    protected $lideres;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Ficha', mappedBy: 'actividad')]
    protected $ficha;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadMarket', mappedBy: 'actividad')]
    protected $actividadMarkets;

    #[ORM\OneToMany(targetEntity: 'ActividadHorario', mappedBy: 'actividad', orphanRemoval: true)]
    protected $horarios;
    
    #[ORM\OneToMany(targetEntity: 'ActividadOmision', mappedBy: 'actividad', orphanRemoval: true)]
    protected $omisiones;

    #[ORM\OneToMany(targetEntity: 'ActividadEvento', mappedBy: 'actividad', orphanRemoval: true)]
//      * @OrderBy({"fechaInicio" = "ASC")

    protected $eventos;
    
    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadFoto', mappedBy: 'actividad', orphanRemoval: true)]
    protected $fotos;

    #[ORM\OneToMany(targetEntity: 'ActividadTipoPrecio', mappedBy: 'actividad', orphanRemoval: true)]
    protected $tiposPrecio;

    #[ORM\OneToMany(targetEntity: 'CodigoExterno', mappedBy: 'actividad')]
    protected $codigosExternos;

    #[ORM\OneToMany(targetEntity: 'Lista', mappedBy: 'actividad')]
    protected $listas;

    #[ORM\OneToMany(targetEntity: 'Grupo', mappedBy: 'actividad')]
    protected $grupos;

    #[ORM\OneToMany(targetEntity: 'ActividadDiasValidacion', mappedBy: 'actividad', orphanRemoval: true)]
    protected $diasValidaciones;

    #[ORM\OneToMany(targetEntity: 'ActividadDependencia', mappedBy: 'actividad', orphanRemoval: true)]
    protected $dependencias;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadZona', mappedBy: 'actividad', orphanRemoval: true)]
    protected $zonas;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'actividad')]
    protected $invitaciones;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Resena', mappedBy: 'actividad')]
    protected $resenas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadReglaValidacion', mappedBy: 'actividad')]
    protected $reglaValidaciones;

    #[ORM\ManyToMany(targetEntity: 'Cliente', mappedBy: 'favoritas')]
    protected $clienteFavoritas;
    
    #[ORM\ManyToMany(targetEntity: 'Promocion', mappedBy: 'actividades')]
    protected $promociones;
    
    #[Gedmo\Slug()]
    #[ORM\Column(length: 128, unique: true)]
    private $slug;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'actividad', targetEntity: ActividadEstadistica::class)]
    private $actividadEstadisticas;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $acompanante;

    #[ORM\ManyToOne(inversedBy: 'actividads', targetEntity: Local::class)]
    private $local;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $localActivo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fila;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoTiempo = 'Primario';

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoTiempoInicio = 'Reserva';

    #[ORM\OneToMany(mappedBy: 'actividad', targetEntity: ActividadBloque::class)]
    private $bloques;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $entregaFechaNacimiento;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $easyCancellation = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $easyCancellationHours = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $easyCancellationHoursWithoutPenalty = 0;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $easyCancellationPercentage = 0;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $moneyBackInsurance = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $moneyBackInsurancePercentage = 0;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $customFieldsOn = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tipoTicket = 'ticket';

    #[ORM\Column(type: 'boolean', nullable: false)]
    private $mostrarDesdePrecio = true;

    #[ORM\Column(type: 'decimal', precision: 2, scale: 1, nullable: true)]
    private $sitemapPriority;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $usarStockLocal;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->lideres = new ArrayCollection();
        $this->horarios = new ArrayCollection();
        $this->omisiones = new ArrayCollection();
        $this->eventos = new ArrayCollection();
        $this->fotos = new ArrayCollection();
        $this->tiposPrecio = new ArrayCollection();
        $this->codigosExternos = new ArrayCollection();
        $this->listas = new ArrayCollection();
        $this->grupos = new ArrayCollection();
        $this->diasValidaciones = new ArrayCollection();
        $this->dependencias = new ArrayCollection();
        $this->zonas = new ArrayCollection();
        $this->clienteFavoritas = new ArrayCollection();
        $this->promociones = new ArrayCollection();
        $this->invitaciones = new ArrayCollection();
        $this->actividadMarkets = new ArrayCollection();
        $this->resenas = new ArrayCollection();
        $this->reglaValidaciones = new ArrayCollection();
        $this->actividadEstadisticas = new ArrayCollection();
        $this->bloques = new ArrayCollection();
    }
    
    public function getPortada()
    {
//        foreach($this->fotos as $foto){
//            return $foto;
//        }
        return $this->getFotos()->first();
    }
    
    public function getEvento()
    {
        return $this->getEventos()->first();
    }
    
    public function getPlan($mId)
    {
        return $this->getProveedor()->getPlanMarket($mId);
    }
    
    public function getAcuerdoComercial($mId)
    {
        return $this->getPlan($mId) ? $this->getPlan($mId)->getAcuerdoComercial() : false;
    }
    
    public function getGratuito($mId)
    {
        return $this->getPlan($mId) ? $this->getPlan($mId)->getGratuito() : false;
    }
    
    public function getValorEsperado()
    {
        $venta = 0;
        
        foreach($this->eventos as $evento){
            foreach($evento->getPrecios() as $ePrecio){
                $cupos = $ePrecio->getCupos();
                $precio = $ePrecio->getPrecio();
                
                $venta += ($precio - $ePrecio->getDescuento()) * $cupos;
            }
        }
        
        return $venta;
    }
    
    public function getDescuentoPromedio()
    {
        $pond1 = 0;
        $pond2 = 0;
        
        foreach($this->eventos as $evento){
            foreach($evento->getPrecios() as $ePrecio){
                $cupos = $ePrecio->getCupos();
                $precio = $ePrecio->getPrecio();
                
                $pond1 += ($precio - $ePrecio->getDescuento()) * $cupos;
                $pond2 += $precio * $cupos;
            }
        }
        
        if($pond2 > 0){
            $prom = 1 - $pond1/$pond2;
        }
        else{
            $prom = 0;
        }
        
        
        return $prom;
    }
    
    public function getEdades()
    {
        if($this->todaEdad){
            $edades = 'Todas las edades';
        }
        elseif($this->edadHasta == 100){
            $edades = 'Desde '.(int)($this->edadDesde).' años';
        }
        elseif($this->edadHasta == 1000){
            $edades = 'Mayores '.(int)($this->edadDesde).' años';
        }
        elseif($this->edadHasta <= 2){
            $edades = (int)($this->edadDesde*12).' - '.(int)($this->edadHasta*12).' meses';
        }
        else{
            $edades = (int)($this->edadDesde).' - '.(int)($this->edadHasta).' años';
        }
        return $edades;
    }
    
    public function getIcono()
    {
        $icono = 'acuaticas.svg';
        
        $categoria = $this->categoria;
        if($categoria && $categoria->getIcono()){
            $icono = $categoria->getIcono();
        }
        
        return $icono;
    }
    
    public function getPrecio()
    {
        return $this->getEvento()->getPrecio();
    }

    public function getMarkets()
    {
        $markets = new ArrayCollection();
        foreach($this->getActividadMarkets() as $actividadMarket){
            if($actividadMarket->getActivo()){
                $markets->add($actividadMarket->getMarket());
            }
        }

        return $markets;
    }

    public function addEvento(ActividadEvento $evento): self
    {
        if (!$evento->getActividad()) {
            $evento->setActividad($this);
        }
        $this->eventos[] = $evento;

        return $this;
    }

    public function removeEvento(ActividadEvento $evento): self
    {
        if ($evento->getActividad() == $this){
            $this->eventos->removeElement($evento);
            // set the owning side to null (unless already changed)
            if ($evento->getActividad() === $this) {
                $evento->setActividad(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }

    public function getCategoriasArray()
    {
        $categorias = [];
        $categoria = $this->getCategoria();

        while($categoria){
//            if($categoria->getNombre() != 'Productos'){
                $categorias[] = $categoria;
//            }
            $categoria = $categoria->getCategoria();
        }

        $categorias = array_reverse($categorias);

        return $categorias;
    }

    public function getLinkOption()
    {
        $option = 'actividad-evento';
        if($this->getFicha()){
            $option = 'producto';
        }

        return $option;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCupos(): ?int
    {
        return $this->cupos;
    }

    public function setCupos(?int $cupos): self
    {
        $this->cupos = $cupos;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaTermino(): ?\DateTimeInterface
    {
        return $this->fechaTermino;
    }

    public function setFechaTermino(?\DateTimeInterface $fechaTermino): self
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(?int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getTipoOmision(): ?string
    {
        return $this->tipoOmision;
    }

    public function setTipoOmision(?string $tipoOmision): self
    {
        $this->tipoOmision = $tipoOmision;

        return $this;
    }

    public function getOmision(): ?\DateTimeInterface
    {
        return $this->omision;
    }

    public function setOmision(?\DateTimeInterface $omision): self
    {
        $this->omision = $omision;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getFechaVisible(): ?\DateTimeInterface
    {
        return $this->fechaVisible;
    }

    public function setFechaVisible(?\DateTimeInterface $fechaVisible): self
    {
        $this->fechaVisible = $fechaVisible;

        return $this;
    }

    public function getFechaTope(): ?\DateTimeInterface
    {
        return $this->fechaTope;
    }

    public function setFechaTope(?\DateTimeInterface $fechaTope): self
    {
        $this->fechaTope = $fechaTope;

        return $this;
    }

    public function getCierreReservas(): ?int
    {
        return $this->cierreReservas;
    }

    public function setCierreReservas(int $cierreReservas): self
    {
        $this->cierreReservas = $cierreReservas;

        return $this;
    }

    public function getCierreReservasUnidad(): ?string
    {
        return $this->cierreReservasUnidad;
    }

    public function setCierreReservasUnidad(?string $cierreReservasUnidad): self
    {
        $this->cierreReservasUnidad = $cierreReservasUnidad;

        return $this;
    }

    public function getFullDay(): ?bool
    {
        return $this->fullDay;
    }

    public function setFullDay(bool $fullDay): self
    {
        $this->fullDay = $fullDay;

        return $this;
    }

    public function getProgramacion(): ?string
    {
        return $this->programacion;
    }

    public function setProgramacion(?string $programacion): self
    {
        $this->programacion = $programacion;

        return $this;
    }

    public function getProgramacionCada(): ?int
    {
        return $this->programacionCada;
    }

    public function setProgramacionCada(?int $programacionCada): self
    {
        $this->programacionCada = $programacionCada;

        return $this;
    }

    public function getSesionesMax(): ?int
    {
        return $this->sesionesMax;
    }

    public function setSesionesMax(?int $sesionesMax): self
    {
        $this->sesionesMax = $sesionesMax;

        return $this;
    }

    public function getFormatoDescuento(): ?string
    {
        return $this->formatoDescuento;
    }

    public function setFormatoDescuento(?string $formatoDescuento): self
    {
        $this->formatoDescuento = $formatoDescuento;

        return $this;
    }

    public function getCuidadores(): ?string
    {
        return $this->cuidadores;
    }

    public function setCuidadores(?string $cuidadores): self
    {
        $this->cuidadores = $cuidadores;

        return $this;
    }

    public function getEdadDesde(): ?string
    {
        return $this->edadDesde;
    }

    public function setEdadDesde(?string $edadDesde): self
    {
        $this->edadDesde = $edadDesde;

        return $this;
    }

    public function getEdadHasta(): ?string
    {
        return $this->edadHasta;
    }

    public function setEdadHasta(?string $edadHasta): self
    {
        $this->edadHasta = $edadHasta;

        return $this;
    }

    public function getTodaEdad(): ?bool
    {
        return $this->todaEdad;
    }

    public function setTodaEdad(bool $todaEdad): self
    {
        $this->todaEdad = $todaEdad;

        return $this;
    }

    public function getPreNatal(): ?bool
    {
        return $this->preNatal;
    }

    public function setPreNatal(bool $preNatal): self
    {
        $this->preNatal = $preNatal;

        return $this;
    }

    public function getLider(): ?string
    {
        return $this->lider;
    }

    public function setLider(?string $lider): self
    {
        $this->lider = $lider;

        return $this;
    }

    public function getCancelable(): ?bool
    {
        return $this->cancelable;
    }

    public function setCancelable(bool $cancelable): self
    {
        $this->cancelable = $cancelable;

        return $this;
    }

    public function getHorasCancelacion(): ?int
    {
        return $this->horasCancelacion;
    }

    public function setHorasCancelacion(?int $horasCancelacion): self
    {
        $this->horasCancelacion = $horasCancelacion;

        return $this;
    }

    public function getTipos(): ?array
    {
        return $this->tipos;
    }

    public function setTipos(array $tipos): self
    {
        $this->tipos = $tipos;

        return $this;
    }

    public function getSitioWeb(): ?string
    {
        return $this->sitioWeb;
    }

    public function setSitioWeb(?string $sitioWeb): self
    {
        $this->sitioWeb = $sitioWeb;

        return $this;
    }

    public function getInstrucciones(): ?string
    {
        return $this->instrucciones;
    }

    public function setInstrucciones(?string $instrucciones): self
    {
        $this->instrucciones = $instrucciones;

        return $this;
    }

    public function getReferencias(): ?string
    {
        return $this->referencias;
    }

    public function setReferencias(?string $referencias): self
    {
        $this->referencias = $referencias;

        return $this;
    }

    public function getCobroVariable(): ?int
    {
        return $this->cobroVariable;
    }

    public function setCobroVariable(int $cobroVariable): self
    {
        $this->cobroVariable = $cobroVariable;

        return $this;
    }

    public function getImpresiones(): ?int
    {
        return $this->impresiones;
    }

    public function setImpresiones(int $impresiones): self
    {
        $this->impresiones = $impresiones;

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

    public function getCodigoExterno(): ?bool
    {
        return $this->codigoExterno;
    }

    public function setCodigoExterno(bool $codigoExterno): self
    {
        $this->codigoExterno = $codigoExterno;

        return $this;
    }

    public function getCodigoDoble(): ?bool
    {
        return $this->codigoDoble;
    }

    public function setCodigoDoble(bool $codigoDoble): self
    {
        $this->codigoDoble = $codigoDoble;

        return $this;
    }

    public function getBeforeEventMinutes(): ?int
    {
        return $this->before_event_minutes;
    }

    public function setBeforeEventMinutes(int $before_event_minutes): self
    {
        $this->before_event_minutes = $before_event_minutes;

        return $this;
    }

    public function getAfterEventMinutes(): ?int
    {
        return $this->after_event_minutes;
    }

    public function setAfterEventMinutes(int $after_event_minutes): self
    {
        $this->after_event_minutes = $after_event_minutes;

        return $this;
    }

    public function getAllowedOnlyInStartActivityEvent(): ?bool
    {
        return $this->allowed_only_in_start_activity_event;
    }

    public function setAllowedOnlyInStartActivityEvent(bool $allowed_only_in_start_activity_event): self
    {
        $this->allowed_only_in_start_activity_event = $allowed_only_in_start_activity_event;

        return $this;
    }

    public function getEntregaInformacion(): ?bool
    {
        return $this->entregaInformacion;
    }

    public function setEntregaInformacion(bool $entregaInformacion): self
    {
        $this->entregaInformacion = $entregaInformacion;

        return $this;
    }

    public function getEntregaRut(): ?bool
    {
        return $this->entregaRut;
    }

    public function setEntregaRut(bool $entregaRut): self
    {
        $this->entregaRut = $entregaRut;

        return $this;
    }

    public function getEntregaNombre(): ?bool
    {
        return $this->entregaNombre;
    }

    public function setEntregaNombre(bool $entregaNombre): self
    {
        $this->entregaNombre = $entregaNombre;

        return $this;
    }

    public function getEntregaTelefono(): ?bool
    {
        return $this->entregaTelefono;
    }

    public function setEntregaTelefono(bool $entregaTelefono): self
    {
        $this->entregaTelefono = $entregaTelefono;

        return $this;
    }

    public function getEntregaEmail(): ?bool
    {
        return $this->entregaEmail;
    }

    public function setEntregaEmail(bool $entregaEmail): self
    {
        $this->entregaEmail = $entregaEmail;

        return $this;
    }

    public function getModeloVenta(): ?string
    {
        return $this->modeloVenta;
    }

    public function setModeloVenta(?string $modeloVenta): self
    {
        $this->modeloVenta = $modeloVenta;

        return $this;
    }

    public function getEntradasCaducadas(): ?bool
    {
        return $this->entradasCaducadas;
    }

    public function setEntradasCaducadas(bool $entradasCaducadas): self
    {
        $this->entradasCaducadas = $entradasCaducadas;

        return $this;
    }

    public function getDesdeCaducado(): ?int
    {
        return $this->desdeCaducado;
    }

    public function setDesdeCaducado(int $desdeCaducado): self
    {
        $this->desdeCaducado = $desdeCaducado;

        return $this;
    }

    public function getDesdeCaducadoUnidad(): ?string
    {
        return $this->desdeCaducadoUnidad;
    }

    public function setDesdeCaducadoUnidad(?string $desdeCaducadoUnidad): self
    {
        $this->desdeCaducadoUnidad = $desdeCaducadoUnidad;

        return $this;
    }

    public function getHastaCaducado(): ?int
    {
        return $this->hastaCaducado;
    }

    public function setHastaCaducado(int $hastaCaducado): self
    {
        $this->hastaCaducado = $hastaCaducado;

        return $this;
    }

    public function getHastaCaducadoUnidad(): ?string
    {
        return $this->hastaCaducadoUnidad;
    }

    public function setHastaCaducadoUnidad(?string $hastaCaducadoUnidad): self
    {
        $this->hastaCaducadoUnidad = $hastaCaducadoUnidad;

        return $this;
    }

    public function getDependenciaTipoPrecio(): ?bool
    {
        return $this->dependenciaTipoPrecio;
    }

    public function setDependenciaTipoPrecio(bool $dependenciaTipoPrecio): self
    {
        $this->dependenciaTipoPrecio = $dependenciaTipoPrecio;

        return $this;
    }

    public function getMaximoEntradas(): ?int
    {
        return $this->maximoEntradas;
    }

    public function setMaximoEntradas(int $maximoEntradas): self
    {
        $this->maximoEntradas = $maximoEntradas;

        return $this;
    }

    public function getMaximoValidaciones(): ?int
    {
        return $this->maximoValidaciones;
    }

    public function setMaximoValidaciones(int $maximoValidaciones): self
    {
        $this->maximoValidaciones = $maximoValidaciones;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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

    public function getDireccion(): ?Direccion
    {
        return $this->direccion;
    }

    public function setDireccion(?Direccion $direccion): self
    {
        $this->direccion = $direccion;

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

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getProveedorRut(): ?ProveedorRut
    {
        return $this->proveedorRut;
    }

    public function setProveedorRut(?ProveedorRut $proveedorRut): self
    {
        $this->proveedorRut = $proveedorRut;

        return $this;
    }

    public function getMapa(): ?Mapa
    {
        return $this->mapa;
    }

    public function setMapa(?Mapa $mapa): self
    {
        $this->mapa = $mapa;

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

//      * @return Collection|Tag[]

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

//      * @return Collection|Staff[]

    public function getLideres(): Collection
    {
        return $this->lideres;
    }

    public function addLidere(Staff $lidere): self
    {
        if (!$this->lideres->contains($lidere)) {
            $this->lideres[] = $lidere;
        }

        return $this;
    }

    public function removeLidere(Staff $lidere): self
    {
        if ($this->lideres->contains($lidere)) {
            $this->lideres->removeElement($lidere);
        }

        return $this;
    }

//      * @return Collection|ActividadHorario[]

    public function getHorarios(): Collection
    {
        return $this->horarios;
    }

    public function addHorario(ActividadHorario $horario): self
    {
        if (!$this->horarios->contains($horario)) {
            $this->horarios[] = $horario;
            $horario->setActividad($this);
        }

        return $this;
    }

    public function removeHorario(ActividadHorario $horario): self
    {
        if ($this->horarios->contains($horario)) {
            $this->horarios->removeElement($horario);
            // set the owning side to null (unless already changed)
            if ($horario->getActividad() === $this) {
                $horario->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadOmision[]

    public function getOmisiones(): Collection
    {
        return $this->omisiones;
    }

    public function addOmisione(ActividadOmision $omisione): self
    {
        if (!$this->omisiones->contains($omisione)) {
            $this->omisiones[] = $omisione;
            $omisione->setActividad($this);
        }

        return $this;
    }

    public function removeOmisione(ActividadOmision $omisione): self
    {
        if ($this->omisiones->contains($omisione)) {
            $this->omisiones->removeElement($omisione);
            // set the owning side to null (unless already changed)
            if ($omisione->getActividad() === $this) {
                $omisione->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadEvento[]

    public function getEventos(): Collection
    {
        return $this->eventos;
    }

//      * @return Collection|ActividadFoto[]

    public function getFotos(): Collection
    {
        return $this->fotos;
    }

    public function addFoto(ActividadFoto $foto): self
    {
        if (!$this->fotos->contains($foto)) {
            $this->fotos[] = $foto;
            $foto->setActividad($this);
        }

        return $this;
    }

    public function removeFoto(ActividadFoto $foto): self
    {
        if ($this->fotos->contains($foto)) {
            $this->fotos->removeElement($foto);
            // set the owning side to null (unless already changed)
            if ($foto->getActividad() === $this) {
                $foto->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadTipoPrecio[]

    public function getTiposPrecio(): Collection
    {
        return $this->tiposPrecio;
    }

    public function addTiposPrecio(ActividadTipoPrecio $tiposPrecio): self
    {
        if (!$this->tiposPrecio->contains($tiposPrecio)) {
            $this->tiposPrecio[] = $tiposPrecio;
            $tiposPrecio->setActividad($this);
        }

        return $this;
    }

    public function removeTiposPrecio(ActividadTipoPrecio $tiposPrecio): self
    {
        if ($this->tiposPrecio->contains($tiposPrecio)) {
            $this->tiposPrecio->removeElement($tiposPrecio);
            // set the owning side to null (unless already changed)
            if ($tiposPrecio->getActividad() === $this) {
                $tiposPrecio->setActividad(null);
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
            $codigosExterno->setActividad($this);
        }

        return $this;
    }

    public function removeCodigosExterno(CodigoExterno $codigosExterno): self
    {
        if ($this->codigosExternos->contains($codigosExterno)) {
            $this->codigosExternos->removeElement($codigosExterno);
            // set the owning side to null (unless already changed)
            if ($codigosExterno->getActividad() === $this) {
                $codigosExterno->setActividad(null);
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
            $lista->setActividad($this);
        }

        return $this;
    }

    public function removeLista(Lista $lista): self
    {
        if ($this->listas->contains($lista)) {
            $this->listas->removeElement($lista);
            // set the owning side to null (unless already changed)
            if ($lista->getActividad() === $this) {
                $lista->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|Grupo[]

    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): self
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos[] = $grupo;
            $grupo->setActividad($this);
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->contains($grupo)) {
            $this->grupos->removeElement($grupo);
            // set the owning side to null (unless already changed)
            if ($grupo->getActividad() === $this) {
                $grupo->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadDiasValidacion[]

    public function getDiasValidaciones(): Collection
    {
        return $this->diasValidaciones;
    }

    public function addDiasValidacione(ActividadDiasValidacion $diasValidacione): self
    {
        if (!$this->diasValidaciones->contains($diasValidacione)) {
            $this->diasValidaciones[] = $diasValidacione;
            $diasValidacione->setActividad($this);
        }

        return $this;
    }

    public function removeDiasValidacione(ActividadDiasValidacion $diasValidacione): self
    {
        if ($this->diasValidaciones->contains($diasValidacione)) {
            $this->diasValidaciones->removeElement($diasValidacione);
            // set the owning side to null (unless already changed)
            if ($diasValidacione->getActividad() === $this) {
                $diasValidacione->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadDependencia[]

    public function getDependencias(): Collection
    {
        return $this->dependencias;
    }

    public function addDependencia(ActividadDependencia $dependencia): self
    {
        if (!$this->dependencias->contains($dependencia)) {
            $this->dependencias[] = $dependencia;
            $dependencia->setActividad($this);
        }

        return $this;
    }

    public function removeDependencia(ActividadDependencia $dependencia): self
    {
        if ($this->dependencias->contains($dependencia)) {
            $this->dependencias->removeElement($dependencia);
            // set the owning side to null (unless already changed)
            if ($dependencia->getActividad() === $this) {
                $dependencia->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadZona[]

    public function getZonas(): Collection
    {
        return $this->zonas;
    }

    public function addZona(ActividadZona $zona): self
    {
        if (!$this->zonas->contains($zona)) {
            $this->zonas[] = $zona;
            $zona->setActividad($this);
        }

        return $this;
    }

    public function removeZona(ActividadZona $zona): self
    {
        if ($this->zonas->contains($zona)) {
            // set the owning side to null (unless already changed)
            if ($zona->getActividad() === $this) {
                $zona->setActividad(null);
            }
            $this->zonas->removeElement($zona);
        }

        return $this;
    }

//      * @return Collection|Cliente[]

    public function getClienteFavoritas(): Collection
    {
        return $this->clienteFavoritas;
    }

    public function addClienteFavorita(Cliente $clienteFavorita): self
    {
        if (!$this->clienteFavoritas->contains($clienteFavorita)) {
            $this->clienteFavoritas[] = $clienteFavorita;
            $clienteFavorita->addFavorita($this);
        }

        return $this;
    }

    public function removeClienteFavorita(Cliente $clienteFavorita): self
    {
        if ($this->clienteFavoritas->contains($clienteFavorita)) {
            $this->clienteFavoritas->removeElement($clienteFavorita);
            $clienteFavorita->removeFavorita($this);
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
            $promocione->addActividade($this);
        }

        return $this;
    }

    public function removePromocione(Promocion $promocione): self
    {
        if ($this->promociones->contains($promocione)) {
            $this->promociones->removeElement($promocione);
            $promocione->removeActividade($this);
        }

        return $this;
    }

    public function getLimiteReservas(): ?string
    {
        return $this->limiteReservas;
    }

    public function setLimiteReservas(?string $limiteReservas): self
    {
        $this->limiteReservas = $limiteReservas;

        return $this;
    }

    public function getDesactivarMapa(): ?bool
    {
        return $this->desactivarMapa;
    }

    public function setDesactivarMapa(bool $desactivarMapa): self
    {
        $this->desactivarMapa = $desactivarMapa;

        return $this;
    }

    public function getChecksForm(): ?array
    {
        return $this->checksForm;
    }

    public function setChecksForm(array $checksForm): self
    {
        $this->checksForm = $checksForm;

        return $this;
    }

    public function getTipoCaducidad(): ?string
    {
        return $this->tipoCaducidad;
    }

    public function setTipoCaducidad(?string $tipoCaducidad): self
    {
        $this->tipoCaducidad = $tipoCaducidad;

        return $this;
    }

    public function getPedirInformacion(): ?string
    {
        return $this->pedirInformacion;
    }

    public function setPedirInformacion(?string $pedirInformacion): self
    {
        $this->pedirInformacion = $pedirInformacion;

        return $this;
    }

    public function getEntregaDireccion(): ?bool
    {
        return $this->entregaDireccion;
    }

    public function setEntregaDireccion(bool $entregaDireccion): self
    {
        $this->entregaDireccion = $entregaDireccion;

        return $this;
    }

    public function getCodigoRut(): ?bool
    {
        return $this->codigoRut;
    }

    public function setCodigoRut(bool $codigoRut): self
    {
        $this->codigoRut = $codigoRut;

        return $this;
    }

    public function getTipoCodigo(): ?string
    {
        return $this->tipoCodigo;
    }

    public function setTipoCodigo(?string $tipoCodigo): self
    {
        $this->tipoCodigo = $tipoCodigo;

        return $this;
    }

    public function getUsarZonas(): ?bool
    {
        return $this->usarZonas;
    }

    public function setUsarZonas(bool $usarZonas): self
    {
        $this->usarZonas = $usarZonas;

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
            $invitacione->setActividad($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->contains($invitacione)) {
            $this->invitaciones->removeElement($invitacione);
            // set the owning side to null (unless already changed)
            if ($invitacione->getActividad() === $this) {
                $invitacione->setActividad(null);
            }
        }

        return $this;
    }

    public function getAlfanumerico(): ?bool
    {
        return $this->alfanumerico;
    }

    public function setAlfanumerico(bool $alfanumerico): self
    {
        $this->alfanumerico = $alfanumerico;

        return $this;
    }

    public function getAlfanumericoExterno(): ?bool
    {
        return $this->alfanumericoExterno;
    }

    public function setAlfanumericoExterno(bool $alfanumericoExterno): self
    {
        $this->alfanumericoExterno = $alfanumericoExterno;

        return $this;
    }

    public function getAutorizable(): ?bool
    {
        return $this->autorizable;
    }

    public function setAutorizable(bool $autorizable): self
    {
        $this->autorizable = $autorizable;

        return $this;
    }

    public function getValidacionActividad(): ?bool
    {
        return $this->validacionActividad;
    }

    public function setValidacionActividad(bool $validacionActividad): self
    {
        $this->validacionActividad = $validacionActividad;

        return $this;
    }

    public function getValidacionZona(): ?bool
    {
        return $this->validacionZona;
    }

    public function setValidacionZona(bool $validacionZona): self
    {
        $this->validacionZona = $validacionZona;

        return $this;
    }

    public function getValidacionTipoPrecio(): ?bool
    {
        return $this->validacionTipoPrecio;
    }

    public function setValidacionTipoPrecio(bool $validacionTipoPrecio): self
    {
        $this->validacionTipoPrecio = $validacionTipoPrecio;

        return $this;
    }

    public function getValidacionInstancia(): ?bool
    {
        return $this->validacionInstancia;
    }

    public function setValidacionInstancia(bool $validacionInstancia): self
    {
        $this->validacionInstancia = $validacionInstancia;

        return $this;
    }

    public function getValidacionDias(): ?bool
    {
        return $this->validacionDias;
    }

    public function setValidacionDias(bool $validacionDias): self
    {
        $this->validacionDias = $validacionDias;

        return $this;
    }

    public function getValidacionValor(): ?bool
    {
        return $this->validacionValor;
    }

    public function setValidacionValor(bool $validacionValor): self
    {
        $this->validacionValor = $validacionValor;

        return $this;
    }

    public function getCodigoGrafico(): ?bool
    {
        return $this->codigoGrafico;
    }

    public function setCodigoGrafico(bool $codigoGrafico): self
    {
        $this->codigoGrafico = $codigoGrafico;

        return $this;
    }

    public function getCodigoGraficoExterno(): ?bool
    {
        return $this->codigoGraficoExterno;
    }

    public function setCodigoGraficoExterno(bool $codigoGraficoExterno): self
    {
        $this->codigoGraficoExterno = $codigoGraficoExterno;

        return $this;
    }

    public function getTipoCodigoExterno(): ?string
    {
        return $this->tipoCodigoExterno;
    }

    public function setTipoCodigoExterno(?string $tipoCodigoExterno): self
    {
        $this->tipoCodigoExterno = $tipoCodigoExterno;

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
            $actividadMarket->setActividad($this);
        }

        return $this;
    }

    public function removeActividadMarket(ActividadMarket $actividadMarket): self
    {
        if ($this->actividadMarkets->contains($actividadMarket)) {
            $this->actividadMarkets->removeElement($actividadMarket);
            // set the owning side to null (unless already changed)
            if ($actividadMarket->getActividad() === $this) {
                $actividadMarket->setActividad(null);
            }
        }

        return $this;
    }

    public function getFicha(): ?Ficha
    {
        return $this->ficha;
    }

    public function setFicha(?Ficha $ficha): self
    {
        $this->ficha = $ficha;

        // set (or unset) the owning side of the relation if necessary
        $newActividad = $ficha === null ? null : $this;
        if ($newActividad !== $ficha->getActividad()) {
            $ficha->setActividad($newActividad);
        }

        return $this;
    }

    public function getDescripcionCorta(): ?string
    {
        return $this->descripcionCorta;
    }

    public function setDescripcionCorta(?string $descripcionCorta): self
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    public function getOmitirFechas(): ?bool
    {
        return $this->omitirFechas;
    }

    public function setOmitirFechas(bool $omitirFechas): self
    {
        $this->omitirFechas = $omitirFechas;

        return $this;
    }

    public function getPoliticas(): ?string
    {
        return $this->politicas;
    }

    public function setPoliticas(?string $politicas): self
    {
        $this->politicas = $politicas;

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

    public function getEntregaObservaciones(): ?bool
    {
        return $this->entregaObservaciones;
    }

    public function setEntregaObservaciones(bool $entregaObservaciones): self
    {
        $this->entregaObservaciones = $entregaObservaciones;

        return $this;
    }

    public function getEmailCompra(): ?bool
    {
        return $this->emailCompra;
    }

    public function setEmailCompra(bool $emailCompra): self
    {
        $this->emailCompra = $emailCompra;

        return $this;
    }

//      * @return Collection|Resena[]

    public function getResenas(): Collection
    {
        return $this->resenas;
    }

    public function addResena(Resena $resena): self
    {
        if (!$this->resenas->contains($resena)) {
            $this->resenas[] = $resena;
            $resena->setActividad($this);
        }

        return $this;
    }

    public function removeResena(Resena $resena): self
    {
        if ($this->resenas->contains($resena)) {
            $this->resenas->removeElement($resena);
            // set the owning side to null (unless already changed)
            if ($resena->getActividad() === $this) {
                $resena->setActividad(null);
            }
        }

        return $this;
    }

//      * @return Collection|ActividadReglaValidacion[]

    public function getReglaValidaciones(): Collection
    {
        return $this->reglaValidaciones;
    }

    public function addReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if (!$this->reglaValidaciones->contains($reglaValidacione)) {
            $this->reglaValidaciones[] = $reglaValidacione;
            $reglaValidacione->setActividad($this);
        }

        return $this;
    }

    public function removeReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if ($this->reglaValidaciones->removeElement($reglaValidacione)) {
            // set the owning side to null (unless already changed)
            if ($reglaValidacione->getActividad() === $this) {
                $reglaValidacione->setActividad(null);
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
            $actividadEstadistica->setActividad($this);
        }

        return $this;
    }

    public function removeActividadEstadistica(ActividadEstadistica $actividadEstadistica): self
    {
        if ($this->actividadEstadisticas->removeElement($actividadEstadistica)) {
            // set the owning side to null (unless already changed)
            if ($actividadEstadistica->getActividad() === $this) {
                $actividadEstadistica->setActividad(null);
            }
        }

        return $this;
    }

    public function getAcompanante(): ?bool
    {
        return $this->acompanante;
    }

    public function setAcompanante(?bool $acompanante): self
    {
        $this->acompanante = $acompanante;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getLocalActivo(): ?bool
    {
        return $this->localActivo;
    }

    public function setLocalActivo(?bool $localActivo): self
    {
        $this->localActivo = $localActivo;

        return $this;
    }

    public function getFila(): ?string
    {
        return $this->fila;
    }

    public function setFila(?string $fila): self
    {
        $this->fila = $fila;

        return $this;
    }

    public function getTipoTiempo(): ?string
    {
        return $this->tipoTiempo;
    }

    public function setTipoTiempo(?string $tipoTiempo): self
    {
        $this->tipoTiempo = $tipoTiempo;

        return $this;
    }

    public function getTipoTiempoInicio(): ?string
    {
        return $this->tipoTiempoInicio;
    }

    public function setTipoTiempoInicio(?string $tipoTiempoInicio): self
    {
        $this->tipoTiempoInicio = $tipoTiempoInicio;

        return $this;
    }

//      * @return Collection|ActividadBloque[]

    public function getBloques(): Collection
    {
        return $this->bloques;
    }

    public function addBloque(ActividadBloque $bloques): self
    {
        if (!$this->bloques->contains($bloques)) {
            $this->bloques[] = $bloques;
            $bloques->setActividad($this);
        }

        return $this;
    }

    public function removeBloque(ActividadBloque $bloques): self
    {
        if ($this->bloques->removeElement($bloques)) {
            // set the owning side to null (unless already changed)
            if ($bloques->getActividad() === $this) {
                $bloques->setActividad(null);
            }
        }

        return $this;
    }

    public function getEntregaFechaNacimiento(): ?bool
    {
        return $this->entregaFechaNacimiento;
    }

    public function setEntregaFechaNacimiento(?bool $entregaFechaNacimiento): self
    {
        $this->entregaFechaNacimiento = $entregaFechaNacimiento;

        return $this;
    }

    public function getUrlResena(): ?string
    {
        return $this->urlResena;
    }

    public function setUrlResena(?string $urlResena): self
    {
        $this->urlResena = $urlResena;

        return $this;
    }

    public function getUrlYoutube(): ?string
    {
        return $this->urlYoutube;
    }

    public function setUrlYoutube(?string $urlYoutube): self
    {
        $this->urlYoutube = $urlYoutube;

        return $this;
    }

    public function getUrlInstagram(): ?string
    {
        return $this->urlInstagram;
    }

    public function setUrlInstagram(?string $urlInstagram): self
    {
        $this->urlInstagram = $urlInstagram;

        return $this;
    }

    public function getUrlYoutubeFotos(): ?bool
    {
        return $this->urlYoutubeFotos;
    }

    public function setUrlYoutubeFotos(bool $urlYoutubeFotos): self
    {
        $this->urlYoutubeFotos = $urlYoutubeFotos;

        return $this;
    }

    public function getUrlInstagramFotos(): ?bool
    {
        return $this->urlInstagramFotos;
    }

    public function setUrlInstagramFotos(bool $urlInstagramFotos): self
    {
        $this->urlInstagramFotos = $urlInstagramFotos;

        return $this;
    }

    public function getEasyCancellation()
    {
        return $this->easyCancellation;
    }

    public function setEasyCancellation($easyCancellation)
    {
        $this->easyCancellation = $easyCancellation;
        return $this;
    }

    public function getEasyCancellationHours()
    {
        return $this->easyCancellationHours;
    }

    public function setEasyCancellationHours($easyCancellationHours)
    {
        $this->easyCancellationHours = $easyCancellationHours;
        return $this;
    }

    public function getEasyCancellationHoursWithoutPenalty()
    {
        return $this->easyCancellationHoursWithoutPenalty;
    }

    public function setEasyCancellationHoursWithoutPenalty($easyCancellationHoursWithoutPenalty)
    {
        $this->easyCancellationHoursWithoutPenalty = $easyCancellationHoursWithoutPenalty;
        return $this;
    }

    public function getEasyCancellationPercentage()
    {
        return $this->easyCancellationPercentage;
    }

    public function setEasyCancellationPercentage($easyCancellationPercentage)
    {
        $this->easyCancellationPercentage = $easyCancellationPercentage;
        return $this;
    }

    public function getMoneyBackInsurance()
    {
        return $this->moneyBackInsurance;
    }

    public function setMoneyBackInsurance($moneyBackInsurance)
    {
        $this->moneyBackInsurance = $moneyBackInsurance;
        return $this;
    }

    public function getMoneyBackInsurancePercentage()
    {
        return $this->moneyBackInsurancePercentage;
    }

    public function setMoneyBackInsurancePercentage($moneyBackInsurancePercentage)
    {
        $this->moneyBackInsurancePercentage = $moneyBackInsurancePercentage;
        return $this;
    }

    public function getCustomFieldsOn()
    {
        return $this->customFieldsOn;
    }

    public function setCustomFieldsOn($customFieldsOn)
    {
        $this->customFieldsOn = $customFieldsOn;
        return $this;
    }

    public function getTipoTicket()
    {
        return $this->tipoTicket;
    }

    public function setTipoTicket($tipoTicket)
    {
        $this->tipoTicket = $tipoTicket;
        return $this;
    }

    public function getMostrarDesdePrecio()
    {
        return $this->mostrarDesdePrecio;
    }

    public function setMostrarDesdePrecio($mostrarDesdePrecio)
    {
        $this->MostrarDesdePrecio = $mostrarDesdePrecio;
        return $this;
    }

    public function getSitemapPriority()
    {
        return $this->sitemapPriority;
    }

    public function setSitemapPriority($sitemapPriority)
    {
        $this->sitemapPriority = $sitemapPriority;
        return $this;
    }

    public function getUsarStockLocal()
    {
        return $this->usarStockLocal;
    }

    public function setUsarStockLocal($usarStockLocal)
    {
        $this->usarStockLocal = $usarStockLocal;
        return $this;
    }
}
