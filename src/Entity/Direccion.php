<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\DireccionRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Direccion
{
    #[ORM\Column(type: 'integer')]
    protected $id;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $calle;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numero;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $local;
    
    #[ORM\Column(type: 'float', nullable: true)]
    private $lat = 0;

    #[ORM\Column(type: 'float', nullable: true)]
    private $lng = 0;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comunaNombre;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Comuna', inversedBy: 'direcciones')]
    protected $comuna;
    
    #[ORM\OneToOne(targetEntity: 'Cliente', mappedBy: 'direccion')]
    protected $cliente;

    #[ORM\ManyToMany(targetEntity: 'Cliente', mappedBy: 'direcciones')]
    protected $clientes;
    
    #[ORM\OneToOne(targetEntity: 'Proveedor', mappedBy: 'direccion')]
    protected $proveedor;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ProveedorRut', mappedBy: 'direccion')]
    protected $proveedorRut;
    
    #[ORM\OneToOne(targetEntity: 'Actividad', mappedBy: 'direccion')]
    protected $actividad;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Sucursal', mappedBy: 'direccion')]
    protected $sucursal;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Bodega', mappedBy: 'direccion')]
    protected $bodega;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Envio', mappedBy: 'direccion')]
    protected $envios;

    #[ORM\OneToOne(targetEntity: 'Cliente', mappedBy: 'ultimaDireccion')]
    protected $clienteUltimo;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

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
        $this->clientes = new ArrayCollection();
        $this->envios = new ArrayCollection();
    }
    
    public function __toString() {
        $comuna = $this->comuna;
        $direccion = $this->calle.' '.$this->numero;
        if($this->local){
            $direccion .= ' ('.$this->local.')';
        }
        
        if($comuna){
            $region = $comuna->getRegion();

            $direccion .= ', '.$comuna->__toString().', '.$region->__toString();
        }
        
        return $direccion;
    }
    
    public function getDireccionFull() {
        $comuna = $this->comuna;
        $region = $comuna->getRegion();
        $direccion = $this->calle.' '.$this->numero;
        if($this->local){
            $direccion .= ' ('.$this->local.')';
        }
        return $direccion.', '.$comuna->__toString().', '.$region->__toString();
    }
    
    public function getDireccionShort() {
        $comuna = $this->comuna;
        $direccion = $this->calle.' '.$this->numero;
        if($this->local){
            $direccion .= ' ('.$this->local.')';
        }
        return $direccion.', '.$comuna->__toString();
    }
    
    public function getRegion() {
        return $this->getComuna()->getRegion();
    }

    public function getDireccionString() {
        $direccion = $this->calle.' '.$this->numero;
        return $direccion;
    }

    public function getDireccionStringFull() {
        $direccion = $this->calle.' '.$this->numero;
        if($this->local){
            $direccion .= ' ('.$this->local.')';
        }

        return $direccion;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set calle.

//      * @param string|null $calle

//      * @return Direccion

    public function setCalle($calle = null)
    {
        $this->calle = $calle;

        return $this;
    }

//      * Get calle.

//      * @return string|null

    public function getCalle()
    {
        return $this->calle;
    }

//      * Set numero.

//      * @param string|null $numero

//      * @return Direccion

    public function setNumero($numero = null)
    {
        $this->numero = $numero;

        return $this;
    }

//      * Get numero.

//      * @return string|null

    public function getNumero()
    {
        return $this->numero;
    }

//      * Set local.

//      * @param string|null $local

//      * @return Direccion

    public function setLocal($local = null)
    {
        $this->local = $local;

        return $this;
    }

//      * Get local.

//      * @return string|null

    public function getLocal()
    {
        return $this->local;
    }

//      * Set lat.

//      * @param float $lat

//      * @return Direccion

    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

//      * Get lat.

//      * @return float

    public function getLat()
    {
        return $this->lat;
    }

//      * Set lng.

//      * @param float $lng

//      * @return Direccion

    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

//      * Get lng.

//      * @return float

    public function getLng()
    {
        return $this->lng;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Direccion

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

//      * @return Direccion

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

//      * Set comuna.

//      * @param \App\Entity\Comuna|null $comuna

//      * @return Direccion

    public function setComuna(\App\Entity\Comuna $comuna = null)
    {
        $this->comuna = $comuna;

        return $this;
    }

//      * Get comuna.

//      * @return \App\Entity\Comuna|null

    public function getComuna()
    {
        return $this->comuna;
    }

//      * Set cliente.

//      * @param \App\Entity\Cliente|null $cliente

//      * @return Direccion

    public function setCliente(\App\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

//      * Get cliente.

//      * @return \App\Entity\Cliente|null

    public function getCliente()
    {
        return $this->cliente;
    }

//      * Set proveedor.

//      * @param \App\Entity\Proveedor|null $proveedor

//      * @return Direccion

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

//      * Set actividad.

//      * @param \App\Entity\Actividad|null $actividad

//      * @return Direccion

    public function setActividad(\App\Entity\Actividad $actividad = null)
    {
        $this->actividad = $actividad;

        return $this;
    }

//      * Get actividad.

//      * @return \App\Entity\Actividad|null

    public function getActividad()
    {
        return $this->actividad;
    }

//      * Set proveedorRut.

//      * @param \App\Entity\ProveedorRut|null $proveedorRut

//      * @return Direccion

    public function setProveedorRut(\App\Entity\ProveedorRut $proveedorRut = null)
    {
        $this->proveedorRut = $proveedorRut;

        return $this;
    }

//      * Get proveedorRut.

//      * @return \App\Entity\ProveedorRut|null

    public function getProveedorRut()
    {
        return $this->proveedorRut;
    }

    public function getSucursal(): ?Sucursal
    {
        return $this->sucursal;
    }

    public function setSucursal(?Sucursal $sucursal): self
    {
        $this->sucursal = $sucursal;

        // set (or unset) the owning side of the relation if necessary
        $newDireccion = $sucursal === null ? null : $this;
        if ($newDireccion !== $sucursal->getDireccion()) {
            $sucursal->setDireccion($newDireccion);
        }

        return $this;
    }

    public function getBodega(): ?Bodega
    {
        return $this->bodega;
    }

    public function setBodega(?Bodega $bodega): self
    {
        $this->bodega = $bodega;

        // set (or unset) the owning side of the relation if necessary
        $newDireccion = $bodega === null ? null : $this;
        if ($newDireccion !== $bodega->getDireccion()) {
            $bodega->setDireccion($newDireccion);
        }

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

//      * @return Collection|Cliente[]
     
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->addDireccione($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->contains($cliente)) {
            $this->clientes->removeElement($cliente);
            $cliente->removeDireccione($this);
        }

        return $this;
    }

//      * @return Collection|Envio[]

    public function getEnvios(): Collection
    {
        return $this->envios;
    }

    public function addEnvio(Envio $envio): self
    {
        if (!$this->envios->contains($envio)) {
            $this->envios[] = $envio;
            $envio->setDireccion($this);
        }

        return $this;
    }

    public function removeEnvio(Envio $envio): self
    {
        if ($this->envios->contains($envio)) {
            $this->envios->removeElement($envio);
            // set the owning side to null (unless already changed)
            if ($envio->getDireccion() === $this) {
                $envio->setDireccion(null);
            }
        }

        return $this;
    }

    public function getClienteUltimo(): ?Cliente
    {
        return $this->clienteUltimo;
    }

    public function setClienteUltimo(?Cliente $clienteUltimo): self
    {
        $this->clienteUltimo = $clienteUltimo;

        // set (or unset) the owning side of the relation if necessary
        $newUltimaDireccion = null === $clienteUltimo ? null : $this;
        if ($clienteUltimo->getUltimaDireccion() !== $newUltimaDireccion) {
            $clienteUltimo->setUltimaDireccion($newUltimaDireccion);
        }

        return $this;
    }

    public function getComunaNombre(): ?string
    {
        return $this->comunaNombre;
    }

    public function setComunaNombre(?string $comunaNombre): self
    {
        $this->comunaNombre = $comunaNombre;

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
}
