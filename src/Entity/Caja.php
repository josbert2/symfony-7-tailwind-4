<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\CajaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Caja
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'integer')]
    private $saldoInicial = 0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $ultimaCuadratura;
    
    #[ORM\Column(type: 'boolean')]
    private $activo = false;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Sucursal', inversedBy: 'cajas')]
    protected $sucursal;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Cuadratura', mappedBy: 'caja')]
    protected $cuadraturas;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CajaIngreso', mappedBy: 'caja')]
    protected $ingresos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CajaEgreso', mappedBy: 'caja')]
    protected $egresos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Transaccion', mappedBy: 'caja')]
    protected $transacciones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\ManyToOne(targetEntity: 'Staff', inversedBy: 'cajas')]
    private $staff;

    public function __toString() {
        return $this->getNombre();
    }

    public function __construct()
    {
        $this->cuadraturas = new ArrayCollection();
        $this->transacciones = new ArrayCollection();
        $this->ingresos = new ArrayCollection();
        $this->egresos = new ArrayCollection();
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

    public function getSaldoInicial(): ?int
    {
        return $this->saldoInicial;
    }

    public function setSaldoInicial(int $saldoInicial): self
    {
        $this->saldoInicial = $saldoInicial;

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

    public function getSucursal(): ?Sucursal
    {
        return $this->sucursal;
    }

    public function setSucursal(?Sucursal $sucursal): self
    {
        $this->sucursal = $sucursal;

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
            $cuadratura->setCaja($this);
        }

        return $this;
    }

    public function removeCuadratura(Cuadratura $cuadratura): self
    {
        if ($this->cuadraturas->contains($cuadratura)) {
            $this->cuadraturas->removeElement($cuadratura);
            // set the owning side to null (unless already changed)
            if ($cuadratura->getCaja() === $this) {
                $cuadratura->setCaja(null);
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
            $transaccione->setCaja($this);
        }

        return $this;
    }

    public function removeTransaccione(Transaccion $transaccione): self
    {
        if ($this->transacciones->contains($transaccione)) {
            $this->transacciones->removeElement($transaccione);
            // set the owning side to null (unless already changed)
            if ($transaccione->getCaja() === $this) {
                $transaccione->setCaja(null);
            }
        }

        return $this;
    }

    public function getUltimaCuadratura(): ?\DateTimeInterface
    {
        return $this->ultimaCuadratura;
    }

    public function setUltimaCuadratura(\DateTimeInterface $ultimaCuadratura): self
    {
        $this->ultimaCuadratura = $ultimaCuadratura;

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
            $ingreso->setCaja($this);
        }

        return $this;
    }

    public function removeIngreso(CajaIngreso $ingreso): self
    {
        if ($this->ingresos->contains($ingreso)) {
            $this->ingresos->removeElement($ingreso);
            // set the owning side to null (unless already changed)
            if ($ingreso->getCaja() === $this) {
                $ingreso->setCaja(null);
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
            $egreso->setCaja($this);
        }

        return $this;
    }

    public function removeEgreso(CajaEgreso $egreso): self
    {
        if ($this->egresos->contains($egreso)) {
            $this->egresos->removeElement($egreso);
            // set the owning side to null (unless already changed)
            if ($egreso->getCaja() === $this) {
                $egreso->setCaja(null);
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
        $this->staff = $staff;
        return $this;
    }

}
