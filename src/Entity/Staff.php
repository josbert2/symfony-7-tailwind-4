<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\StaffRepository::class)]
//  * @ORM\Table(
//  *     name="staff",
//  *     indexes={
//  *         @ORM\Index(name="idx_staff_deleted", columns={"deleted"),
//  *         @ORM\Index(name="idx_staff_id_deleted_proveedor", columns={"id", "deleted", "proveedor_id")
//  *     }
//  * ) 
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Staff
{
    #[ORM\Column(type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rut;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $cargo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $has_active_attendance=false;

    #[ORM\Column(type: 'array')]
    private $permisos = [];

    #[ORM\OneToOne(targetEntity: 'App\Entity\Usuario', inversedBy: 'staff')]
//      * @Assert\Valid

    protected $usuario;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Cliente', inversedBy: 'staff')]
    protected $cliente;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'staffs')]
    protected $proveedor;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Sucursal', inversedBy: 'staffs')]
    protected $sucursal;

    #[ORM\OneToMany(targetEntity: 'Proveedor', mappedBy: 'staff')]
    protected $proveedores;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Cuadratura', mappedBy: 'staff')]
    protected $cuadraturas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CajaIngreso', mappedBy: 'staff')]
    protected $ingresos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CajaEgreso', mappedBy: 'staff')]
    protected $egresos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Transaccion', mappedBy: 'staff')]
    protected $transacciones;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Local', mappedBy: 'administrador')]
    protected $locales;

    #[ORM\ManyToMany(targetEntity: 'Actividad', mappedBy: 'lideres')]
    protected $actividades;

//      * @ORM\ManyToMany (targetEntity="App\Entity\ActividadReglaValidacion", mappedBy="staffs")

    protected $reglaValidaciones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\OneToMany(mappedBy: 'encargado', targetEntity: Bodega::class)]
    private $bodegas;

    #[ORM\OneToMany(mappedBy: 'administrador', targetEntity: Local::class)]
    private $locals;

    #[ORM\OneToMany(targetEntity: 'Caja', mappedBy: 'staff')]
    private $cajas;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $enrolled = false;


    public function __construct()
    {
        $this->proveedores = new ArrayCollection();
        $this->actividades = new ArrayCollection();
        $this->cuadraturas = new ArrayCollection();
        $this->transacciones = new ArrayCollection();
        $this->ingresos = new ArrayCollection();
        $this->egresos = new ArrayCollection();
        $this->reglaValidaciones = new ArrayCollection();
        $this->bodegas = new ArrayCollection();
        $this->locals = new ArrayCollection();
        $this->locales = new ArrayCollection();
        $this->cajas = new ArrayCollection();
    }

    public function getEmail() {
        return $this->usuario->getEmail();
    }
    
    public function __toString() {
        if($this->usuario){
        return $this->usuario->__toString();
        }
        else{
            return 'error';
        }
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getPermisos(): ?array
    {
        return $this->permisos;
    }

    public function setPermisos(array $permisos): self
    {
        $this->permisos = $permisos;

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

    public function getHasActiveAttendance(): ?bool
    {
        return $this->has_active_attendance;
    }

    public function setHasActiveAttendance(bool $has_active_attendance): self
    {
        $this->has_active_attendance = $has_active_attendance;

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

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

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

//      * @return Collection|Proveedor[]
     
    public function getProveedores(): Collection
    {
        return $this->proveedores;
    }

    public function addProveedore(Proveedor $proveedore): self
    {
        if (!$this->proveedores->contains($proveedore)) {
            $this->proveedores[] = $proveedore;
            $proveedore->setStaff($this);
        }

        return $this;
    }

    public function removeProveedore(Proveedor $proveedore): self
    {
        if ($this->proveedores->contains($proveedore)) {
            $this->proveedores->removeElement($proveedore);
            // set the owning side to null (unless already changed)
            if ($proveedore->getStaff() === $this) {
                $proveedore->setStaff(null);
            }
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
            $actividade->addLidere($this);
        }

        return $this;
    }

    public function removeActividade(Actividad $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
            $actividade->removeLidere($this);
        }

        return $this;
    }

//      * @return Collection|Cuadratura[]

    public function getCuadraturas(): Collection
    {
        return $this->cuadraturas;
    }

    public function addCuadratura(Cuadratura $cuadratura): self
    {
        if (!$this->cuadraturas->contains($cuadratura)) {
            $this->cuadraturas[] = $cuadratura;
            $cuadratura->setStaff($this);
        }

        return $this;
    }

    public function removeCuadratura(Cuadratura $cuadratura): self
    {
        if ($this->cuadraturas->contains($cuadratura)) {
            $this->cuadraturas->removeElement($cuadratura);
            // set the owning side to null (unless already changed)
            if ($cuadratura->getStaff() === $this) {
                $cuadratura->setStaff(null);
            }
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
            $transaccione->setStaff($this);
        }

        return $this;
    }

    public function removeTransaccione(Transaccion $transaccione): self
    {
        if ($this->transacciones->contains($transaccione)) {
            $this->transacciones->removeElement($transaccione);
            // set the owning side to null (unless already changed)
            if ($transaccione->getStaff() === $this) {
                $transaccione->setStaff(null);
            }
        }

        return $this;
    }

//      * @return Collection|CajaIngreso[]

    public function getIngresos(): Collection
    {
        return $this->ingresos;
    }

    public function addIngreso(CajaIngreso $ingreso): self
    {
        if (!$this->ingresos->contains($ingreso)) {
            $this->ingresos[] = $ingreso;
            $ingreso->setStaff($this);
        }

        return $this;
    }

    public function removeIngreso(CajaIngreso $ingreso): self
    {
        if ($this->ingresos->contains($ingreso)) {
            $this->ingresos->removeElement($ingreso);
            // set the owning side to null (unless already changed)
            if ($ingreso->getStaff() === $this) {
                $ingreso->setStaff(null);
            }
        }

        return $this;
    }

//      * @return Collection|CajaEgreso[]

    public function getEgresos(): Collection
    {
        return $this->egresos;
    }

    public function addEgreso(CajaEgreso $egreso): self
    {
        if (!$this->egresos->contains($egreso)) {
            $this->egresos[] = $egreso;
            $egreso->setStaff($this);
        }

        return $this;
    }

    public function removeEgreso(CajaEgreso $egreso): self
    {
        if ($this->egresos->contains($egreso)) {
            $this->egresos->removeElement($egreso);
            // set the owning side to null (unless already changed)
            if ($egreso->getStaff() === $this) {
                $egreso->setStaff(null);
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
            $reglaValidacione->addStaff($this);
        }

        return $this;
    }

    public function removeReglaValidacione(ActividadReglaValidacion $reglaValidacione): self
    {
        if ($this->reglaValidaciones->removeElement($reglaValidacione)) {
            $reglaValidacione->removeStaff($this);
        }

        return $this;
    }

//      * @return Collection|Bodega[]

    public function getBodegas(): Collection
    {
        return $this->bodegas;
    }

    public function addBodega(Bodega $bodega): self
    {
        if (!$this->bodegas->contains($bodega)) {
            $this->bodegas[] = $bodega;
            $bodega->setEncargado($this);
        }

        return $this;
    }

    public function removeBodega(Bodega $bodega): self
    {
        if ($this->bodegas->removeElement($bodega)) {
            // set the owning side to null (unless already changed)
            if ($bodega->getEncargado() === $this) {
                $bodega->setEncargado(null);
            }
        }

        return $this;
    }

//      * @return Collection|Local[]

    public function getLocals(): Collection
    {
        return $this->locals;
    }

    public function addLocal(Local $local): self
    {
        if (!$this->locals->contains($local)) {
            $this->locals[] = $local;
            $local->setAdministrador($this);
        }

        return $this;
    }

    public function removeLocal(Local $local): self
    {
        if ($this->locals->removeElement($local)) {
            // set the owning side to null (unless already changed)
            if ($local->getAdministrador() === $this) {
                $local->setAdministrador(null);
            }
        }

        return $this;
    }

//      * @return Collection|Local[]

    public function getLocales(): Collection
    {
        return $this->locales;
    }

    public function addLocale(Local $locale): self
    {
        if (!$this->locales->contains($locale)) {
            $this->locales[] = $locale;
            $locale->setAdministrador($this);
        }

        return $this;
    }

    public function removeLocale(Local $locale): self
    {
        if ($this->locales->removeElement($locale)) {
            // set the owning side to null (unless already changed)
            if ($locale->getAdministrador() === $this) {
                $locale->setAdministrador(null);
            }
        }

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getSucursal(): ?Sucursal
    {
        return $this->sucursal;
    }

    public function setSucursal(?Sucursal $sucursal): self
    {
        $this->sucursal = $sucursal;

        return $this;
    }

    public function getCajas(): Collection
    {
        return $this->cajas;
    }

    public function addCaja(Caja $caja): self
    {
        if (!$this->cajas->contains($caja)) {
            $this->cajas[] = $caja;
            $caja->setStaff($this);
        }

        return $this;
    }

    public function removeCaja(Caja $caja): self
    {
        if ($this->cajas->contains($caja)) {
            $this->cajas->removeElement($caja);
            if ($caja->getStaff() === $this) {
                $caja->setStaff(null);
            }
        }

        return $this;
    }

    public function getEnrolled(): ?bool
    {
        return $this->enrolled;
    }

    public function setEnrolled(bool $enrolled): self
    {
        $this->enrolled = $enrolled;

        return $this;
    }
    
}
