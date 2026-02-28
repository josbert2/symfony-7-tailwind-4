<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\ClienteRepository::class)]
//  * @ORM\Table(indexes={
//  *      @ORM\Index(name="idx_cliente_market_deleted", columns={"market_id", "deleted"),
//  *      @ORM\Index(name="idx_cliente_usuario_market_deleted", columns={"market_id", "usuario_id", "deleted")
//  * )

class Cliente
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $apellido;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;
    
    #[ORM\Column(type: 'boolean')]
    private $recordatorios = true;
    
    #[ORM\Column(type: 'boolean')]
    private $noticias = true;
    
    #[ORM\Column(type: 'boolean')]
    private $promociones = true;
    
    #[ORM\Column(type: 'boolean')]
    private $perfilPublico = true;
    
    #[ORM\Column(type: 'integer')]
    private $saldo = 0;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nacionalidad;
    
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $codigo;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $referido;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rut;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ultimaTransaccion;
    
    #[ORM\Column(type: 'boolean')]
    private $inviteSent = false;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $notificacionCarroAbandonado;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $emailCarroAbandonado;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $confirmationToken;

    #[ORM\Column(name: 'session', type: 'string', length: 255, nullable: true)]
    private $session;

    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $password;

//      * @Assert\Valid
    #[ORM\ManyToOne(targetEntity: 'Usuario', inversedBy: 'clientes')]
     
    protected $usuario;

    #[ORM\OneToOne(targetEntity: 'Direccion', inversedBy: 'cliente')]
    protected $direccion;

    #[ORM\OneToOne(targetEntity: 'Direccion', inversedBy: 'clienteUltimo')]
    protected $ultimaDireccion;

    #[ORM\ManyToMany(targetEntity: 'Direccion', inversedBy: 'clientes')]
    protected $direcciones;

    #[ORM\ManyToOne(targetEntity: 'Market', inversedBy: 'clientes')]
    protected $market;
    
    #[ORM\ManyToMany(targetEntity: 'Actividad', inversedBy: 'clienteFavoritas')]
    protected $favoritas;
    
    #[ORM\ManyToMany(targetEntity: 'Proveedor', inversedBy: 'clienteFavoritos')]
    protected $favoritos;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Staff', mappedBy: 'cliente')]
    protected $staff;
    
    #[ORM\OneToMany(targetEntity: 'Transaccion', mappedBy: 'cliente')]
    protected $transacciones;
    
    #[ORM\OneToMany(targetEntity: 'Nino', mappedBy: 'cliente', orphanRemoval: true)]
    protected $ninos;
    
    #[ORM\OneToMany(targetEntity: 'Cuidador', mappedBy: 'cliente', orphanRemoval: true)]
    protected $cuidadores;
    
    #[ORM\OneToMany(targetEntity: 'Punto', mappedBy: 'cliente')]
    protected $puntos;
    
    #[ORM\OneToMany(targetEntity: 'OneClick', mappedBy: 'cliente')]
    protected $oneClicks;

    #[ORM\OneToMany(targetEntity: 'Item', mappedBy: 'cliente')]
    protected $items;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: ClienteDatoBancario::class)]
    private $clienteDatoBancarios;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: DevolucionDinero::class)]
    private $devolucionDineros;

    #[ORM\OneToMany(targetEntity: 'Acompanante', mappedBy: 'cliente', orphanRemoval: true)]
    private $acompanantes;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ClienteGeolocalizacion', mappedBy: 'cliente')]
    private $geolocalizaciones;


    public function getUsuario(): ?Usuario
    {
        $usuario = $this->usuario;
        if (!$usuario) {
            $staff = $this->getStaff();
            if ($staff) {
                $usuario = $staff->getUsuario();
            }
        }
        return $usuario;
    }

    public function __construct()
    {
        $this->favoritas = new ArrayCollection();
        $this->favoritos = new ArrayCollection();
        $this->transacciones = new ArrayCollection();
        $this->ninos = new ArrayCollection();
        $this->cuidadores = new ArrayCollection();
        $this->puntos = new ArrayCollection();
        $this->oneClicks = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->direcciones = new ArrayCollection();
        $this->clienteDatoBancarios = new ArrayCollection();
        $this->devolucionDineros = new ArrayCollection();
        $this->paqueteEstados = new ArrayCollection();
        $this->acompanantes = new ArrayCollection();
    }

    public function getComunas()
    {
        $comunas = [];
        foreach($this->getDirecciones() as $direccion){
            $comunas[] = $direccion->getComuna();
        }
        return $comunas;
    }
    
    public function getCompletitud()
    {
        $completitud = 0;
        
        if($this->usuario->getTelefono()){
            $completitud += 25;
        }
        
        if($this->direccion){
            $completitud += 25;
        }
//        dump($this->ninos->count());
        
        foreach($this->ninos as $nino){
            if($nino->getActivo()){
                $completitud += 25;
                break;
            }
        }
        
        foreach($this->oneClicks as $oneClick){
            if($oneClick->getActivo()){
                $completitud += 25;
                break;
            }
        }
//        dump($completitud);
        
        return $completitud;
    }
    
    public function getOneClick()
    {
        $oneClick = NULL;
        
        $oneClicks = $this->oneClicks->toArray();
        if($oneClicks){
            $oneClicks = array_reverse($oneClicks);
            foreach($oneClicks as $cOneClick){
                if($cOneClick->getActivo()){
                    $oneClicks = $cOneClick;
                    break;
                }
            }
        }

        if(is_array($oneClicks)){
            $oneClicks = NULL;
        }

        return $oneClicks;
    }

//      * Add nino.

//      * @param \App\Entity\Nino $nino

//      * @return Cliente

    public function addNino(\App\Entity\Nino $nino)
    {
        $nino->setCliente($this);
        $this->ninos[] = $nino;

        return $this;
    }

//      * Add cuidadore.

//      * @param \App\Entity\Cuidador $cuidadore

//      * @return Cliente

    public function addCuidadore(\App\Entity\Cuidador $cuidadore)
    {
        $cuidadore->setCliente($this);
        $this->cuidadores[] = $cuidadore;

        return $this;
    }

//      * Add punto.

//      * @param \App\Entity\Punto $punto

//      * @return Cliente

    public function addPunto(\App\Entity\Punto $punto)
    {
        $punto->setCliente($this);
        $this->puntos[] = $punto;

        $this->setSaldo($this->getSaldo() + $punto->getMonto());

        return $this;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->getUsuario() ? $this->getUsuario()->getEmail() : NULL;
    }

//      * @return Collection|Item[]

    public function getItems($boleteria = false): Collection
    {
        $items = new ArrayCollection;

        foreach($this->items as $item){
            if($boleteria == $item->getBoleteria()){
                $items->add($item);
            }
        }

        return $items;

    }

    public function getNombreCompleto()
    {
        if($this->getNombre()){
            $nombre = $this->getNombre().' '.$this->getApellido();
        } else{
            $nombre =  $this->getUsuario()->getNombre().' '.$this->getUsuario()->getApellido();
        }

        if($nombre){
            $nombre = $this->getUsuario()->getEmail();
        }

        return trim($nombre);
    }
    
    public function __toString()
    {
        return $this->getNombreCompleto();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecordatorios(): ?bool
    {
        return $this->recordatorios;
    }

    public function setRecordatorios(bool $recordatorios): self
    {
        $this->recordatorios = $recordatorios;

        return $this;
    }

    public function getNoticias(): ?bool
    {
        return $this->noticias;
    }

    public function setNoticias(bool $noticias): self
    {
        $this->noticias = $noticias;

        return $this;
    }

    public function getPromociones(): ?bool
    {
        return $this->promociones;
    }

    public function setPromociones(bool $promociones): self
    {
        $this->promociones = $promociones;

        return $this;
    }

    public function getPerfilPublico(): ?bool
    {
        return $this->perfilPublico;
    }

    public function setPerfilPublico(bool $perfilPublico): self
    {
        $this->perfilPublico = $perfilPublico;

        return $this;
    }

    public function getSaldo(): ?int
    {
        return $this->saldo;
    }

    public function setSaldo(int $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getNacionalidad(): ?string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(?string $nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

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

    public function getReferido(): ?string
    {
        return $this->referido;
    }

    public function setReferido(?string $referido): self
    {
        $this->referido = $referido;

        return $this;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(?string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getInviteSent(): ?bool
    {
        return $this->inviteSent;
    }

    public function setInviteSent(bool $inviteSent): self
    {
        $this->inviteSent = $inviteSent;

        return $this;
    }

    public function getNotificacionCarroAbandonado(): ?\DateTimeInterface
    {
        return $this->notificacionCarroAbandonado;
    }

    public function setNotificacionCarroAbandonado(?\DateTimeInterface $notificacionCarroAbandonado): self
    {
        $this->notificacionCarroAbandonado = $notificacionCarroAbandonado;

        return $this;
    }

    public function getEmailCarroAbandonado(): ?\DateTimeInterface
    {
        return $this->emailCarroAbandonado;
    }

    public function setEmailCarroAbandonado(?\DateTimeInterface $emailCarroAbandonado): self
    {
        $this->emailCarroAbandonado = $emailCarroAbandonado;

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

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

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

//      * @return Collection|Actividad[]

    public function getFavoritas(): Collection
    {
        return $this->favoritas;
    }

    public function addFavorita(Actividad $favorita): self
    {
        if (!$this->favoritas->contains($favorita)) {
            $this->favoritas[] = $favorita;
        }

        return $this;
    }

    public function removeFavorita(Actividad $favorita): self
    {
        if ($this->favoritas->contains($favorita)) {
            $this->favoritas->removeElement($favorita);
        }

        return $this;
    }

//      * @return Collection|Proveedor[]

    public function getFavoritos(): Collection
    {
        return $this->favoritos;
    }

    public function addFavorito(Proveedor $favorito): self
    {
        if (!$this->favoritos->contains($favorito)) {
            $this->favoritos[] = $favorito;
        }

        return $this;
    }

    public function removeFavorito(Proveedor $favorito): self
    {
        if ($this->favoritos->contains($favorito)) {
            $this->favoritos->removeElement($favorito);
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
            $transaccione->setCliente($this);
        }

        return $this;
    }

    public function removeTransaccione(Transaccion $transaccione): self
    {
        if ($this->transacciones->contains($transaccione)) {
            $this->transacciones->removeElement($transaccione);
            // set the owning side to null (unless already changed)
            if ($transaccione->getCliente() === $this) {
                $transaccione->setCliente(null);
            }
        }

        return $this;
    }

//      * @return Collection|Nino[]

    public function getNinos(): Collection
    {
        return $this->ninos;
    }

    public function removeNino(Nino $nino): self
    {
        if ($this->ninos->contains($nino)) {
            $this->ninos->removeElement($nino);
            // set the owning side to null (unless already changed)
            if ($nino->getCliente() === $this) {
                $nino->setCliente(null);
            }
        }

        return $this;
    }

//      * @return Collection|Cuidador[]

    public function getCuidadores(): Collection
    {
        return $this->cuidadores;
    }

    public function removeCuidadore(Cuidador $cuidadore): self
    {
        if ($this->cuidadores->contains($cuidadore)) {
            $this->cuidadores->removeElement($cuidadore);
            // set the owning side to null (unless already changed)
            if ($cuidadore->getCliente() === $this) {
                $cuidadore->setCliente(null);
            }
        }

        return $this;
    }

//      * @return Collection|Punto[]

    public function getPuntos(): Collection
    {
        return $this->puntos;
    }

    public function removePunto(Punto $punto): self
    {
        if ($this->puntos->contains($punto)) {
            $this->puntos->removeElement($punto);
            // set the owning side to null (unless already changed)
            if ($punto->getCliente() === $this) {
                $punto->setCliente(null);
            }
        }

        return $this;
    }

//      * @return Collection|OneClick[]

    public function getOneClicks(): Collection
    {
        return $this->oneClicks;
    }

    public function addOneClick(OneClick $oneClick): self
    {
        if (!$this->oneClicks->contains($oneClick)) {
            $this->oneClicks[] = $oneClick;
            $oneClick->setCliente($this);
        }

        return $this;
    }

    public function removeOneClick(OneClick $oneClick): self
    {
        if ($this->oneClicks->contains($oneClick)) {
            $this->oneClicks->removeElement($oneClick);
            // set the owning side to null (unless already changed)
            if ($oneClick->getCliente() === $this) {
                $oneClick->setCliente(null);
            }
        }

        return $this;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setCliente($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getCliente() === $this) {
                $item->setCliente(null);
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

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getSession(): ?string
    {
        return $this->session;
    }

    public function setSession(?string $session): self
    {
        $this->session = $session;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

//      * @return Collection|Direccion[]

    public function getDirecciones(): Collection
    {
        return $this->direcciones;
    }

    public function addDireccione(Direccion $direccione): self
    {
        if (!$this->direcciones->contains($direccione)) {
            $this->direcciones[] = $direccione;
        }

        return $this;
    }

    public function removeDireccione(Direccion $direccione): self
    {
        if ($this->direcciones->contains($direccione)) {
            $this->direcciones->removeElement($direccione);
        }

        return $this;
    }

    public function getUltimaTransaccion(): ?string
    {
        return $this->ultimaTransaccion;
    }

    public function setUltimaTransaccion(?string $ultimaTransaccion): self
    {
        $this->ultimaTransaccion = $ultimaTransaccion;

        return $this;
    }

    public function getUltimaDireccion(): ?Direccion
    {
        return $this->ultimaDireccion;
    }

    public function setUltimaDireccion(?Direccion $ultimaDireccion): self
    {
        $this->ultimaDireccion = $ultimaDireccion;

        return $this;
    }

//      * @return Collection|ClienteDatoBancario[]

    public function getClienteDatoBancarios(): Collection
    {
        return $this->clienteDatoBancarios;
    }

    public function addClienteDatoBancario(ClienteDatoBancario $clienteDatoBancario): self
    {
        if (!$this->clienteDatoBancarios->contains($clienteDatoBancario)) {
            $this->clienteDatoBancarios[] = $clienteDatoBancario;
            $clienteDatoBancario->setCliente($this);
        }

        return $this;
    }

    public function removeClienteDatoBancario(ClienteDatoBancario $clienteDatoBancario): self
    {
        if ($this->clienteDatoBancarios->removeElement($clienteDatoBancario)) {
            // set the owning side to null (unless already changed)
            if ($clienteDatoBancario->getCliente() === $this) {
                $clienteDatoBancario->setCliente(null);
            }
        }

        return $this;
    }

//      * @return Collection|DevolucionDinero[]

    public function getDevolucionDineros(): Collection
    {
        return $this->devolucionDineros;
    }

    public function addDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if (!$this->devolucionDineros->contains($devolucionDinero)) {
            $this->devolucionDineros[] = $devolucionDinero;
            $devolucionDinero->setCliente($this);
        }

        return $this;
    }

    public function removeDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if ($this->devolucionDineros->removeElement($devolucionDinero)) {
            // set the owning side to null (unless already changed)
            if ($devolucionDinero->getCliente() === $this) {
                $devolucionDinero->setCliente(null);
            }
        }

        return $this;
    }

//      * @return Collection|Acompanante[]

    public function getAcompanantes(): Collection
    {
        return $this->acompanantes;
    }

    public function addAcompanante(Acompanante $acompanante): self
    {
        if (!$this->acompanantes->contains($acompanante)) {
            $this->acompanantes[] = $acompanante;
            $acompanante->setCliente($this);
        }

        return $this;
    }

    public function removeAcompanante(Acompanante $acompanante): self
    {
        if ($this->acompanantes->removeElement($acompanante)) {
            // set the owning side to null (unless already changed)
            if ($acompanante->getCliente() === $this) {
                $acompanante->setCliente(null);
            }
        }

        return $this;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(?Staff $staff): self
    {
        // unset the owning side of the relation if necessary
        if ($staff === null && $this->staff !== null) {
            $this->staff->setCliente(null);
        }

        // set the owning side of the relation if necessary
        if ($staff !== null && $staff->getCliente() !== $this) {
            $staff->setCliente($this);
        }

        $this->staff = $staff;

        return $this;
    }
    
    public function getGeolocalizaciones()
    {
        return $this->geolocalizaciones;
    }
}
