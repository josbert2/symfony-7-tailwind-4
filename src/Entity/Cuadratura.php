<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\CuadraturaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Cuadratura
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigo;

    #[ORM\Column(type: 'datetime')]
    private $fecha;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $ultimoCierre;

    #[ORM\Column(type: 'integer')]
    private $saldoInicial = 0;

    #[ORM\Column(type: 'integer')]
    private $montoIngresos = 0;

    #[ORM\Column(type: 'integer')]
    private $montoEgresos = 0;

    #[ORM\Column(type: 'integer')]
    private $recaudacion = 0;

    #[ORM\Column(type: 'integer')]
    private $monto = 0;

    #[ORM\Column(type: 'integer')]
    private $ajuste = 0;

    #[ORM\Column(type: 'integer')]
    private $montoCredito = 0;

    #[ORM\Column(type: 'integer')]
    private $cantidadCredito = 0;

    #[ORM\Column(type: 'integer')]
    private $montoDebito = 0;

    #[ORM\Column(type: 'integer')]
    private $cantidadDebito = 0;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Caja', inversedBy: 'cuadraturas')]
    protected $caja;

    #[ORM\ManyToOne(targetEntity: 'Staff', inversedBy: 'cuadraturas')]
    protected $staff;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CajaIngreso', mappedBy: 'cuadratura')]
    protected $ingresos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\CajaEgreso', mappedBy: 'cuadratura')]
    protected $egresos;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Transaccion', mappedBy: 'cuadratura')]
    protected $transacciones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getDisponible()
    {
        return $this->getSaldoInicial() + $this->getRecaudacion() + $this->getMontoIngresos() - $this->getMontoEgresos();
    }

    public function __construct()
    {
        $this->ingresos = new ArrayCollection();
        $this->egresos = new ArrayCollection();
        $this->transacciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    public function getMontoIngresos(): ?int
    {
        return $this->montoIngresos;
    }

    public function setMontoIngresos(int $montoIngresos): self
    {
        $this->montoIngresos = $montoIngresos;

        return $this;
    }

    public function getMontoEgresos(): ?int
    {
        return $this->montoEgresos;
    }

    public function setMontoEgresos(int $montoEgresos): self
    {
        $this->montoEgresos = $montoEgresos;

        return $this;
    }

    public function getRecaudacion(): ?int
    {
        return $this->recaudacion;
    }

    public function setRecaudacion(int $recaudacion): self
    {
        $this->recaudacion = $recaudacion;

        return $this;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getAjuste(): ?int
    {
        return $this->ajuste;
    }

    public function setAjuste(int $ajuste): self
    {
        $this->ajuste = $ajuste;

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

    public function getCaja(): ?Caja
    {
        return $this->caja;
    }

    public function setCaja(?Caja $caja): self
    {
        $this->caja = $caja;

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
            $ingreso->setCuadratura($this);
        }

        return $this;
    }

    public function removeIngreso(CajaIngreso $ingreso): self
    {
        if ($this->ingresos->contains($ingreso)) {
            $this->ingresos->removeElement($ingreso);
            // set the owning side to null (unless already changed)
            if ($ingreso->getCuadratura() === $this) {
                $ingreso->setCuadratura(null);
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
            $egreso->setCuadratura($this);
        }

        return $this;
    }

    public function removeEgreso(CajaEgreso $egreso): self
    {
        if ($this->egresos->contains($egreso)) {
            $this->egresos->removeElement($egreso);
            // set the owning side to null (unless already changed)
            if ($egreso->getCuadratura() === $this) {
                $egreso->setCuadratura(null);
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
            $transaccione->setCuadratura($this);
        }

        return $this;
    }

    public function removeTransaccione(Transaccion $transaccione): self
    {
        if ($this->transacciones->contains($transaccione)) {
            $this->transacciones->removeElement($transaccione);
            // set the owning side to null (unless already changed)
            if ($transaccione->getCuadratura() === $this) {
                $transaccione->setCuadratura(null);
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

    public function getMontoCredito(): ?int
    {
        return $this->montoCredito;
    }

    public function setMontoCredito(int $montoCredito): self
    {
        $this->montoCredito = $montoCredito;

        return $this;
    }

    public function getCantidadCredito(): ?int
    {
        return $this->cantidadCredito;
    }

    public function setCantidadCredito(int $cantidadCredito): self
    {
        $this->cantidadCredito = $cantidadCredito;

        return $this;
    }

    public function getMontoDebito(): ?int
    {
        return $this->montoDebito;
    }

    public function setMontoDebito(int $montoDebito): self
    {
        $this->montoDebito = $montoDebito;

        return $this;
    }

    public function getCantidadDebito(): ?int
    {
        return $this->cantidadDebito;
    }

    public function setCantidadDebito(int $cantidadDebito): self
    {
        $this->cantidadDebito = $cantidadDebito;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getUltimoCierre(): ?\DateTimeInterface
    {
        return $this->ultimoCierre;
    }

    public function setUltimoCierre(?\DateTimeInterface $ultimoCierre): self
    {
        $this->ultimoCierre = $ultimoCierre;

        return $this;
    }


}
