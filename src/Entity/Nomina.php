<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


    #[ORM\Entity(repositoryClass: App\Repository\NominaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Nomina
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $rutEmpresa;

    #[ORM\Column(type: 'string', length: 255)]
    private $rutEmpresaDv;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipoPago;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaPago;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Liquidacion', mappedBy: 'nomina')]
    protected $liquidaciones;

    #[ORM\OneToMany(targetEntity: 'App\Entity\NominaLiquidacion', mappedBy: 'nomina')]
    protected $nominaLiquidaciones;

    #[ORM\OneToMany(targetEntity: 'App\Entity\NominaCuenta', mappedBy: 'nomina')]
    protected $nominaCuentas;

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
        $this->liquidaciones = new ArrayCollection();
        $this->nominaLiquidaciones = new ArrayCollection();
        $this->nominaCuentas = new ArrayCollection();
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getLiquidaciones() as $liquidacion) {
            $total += $liquidacion->getTotal();
        }

        return $total;
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

    public function getTipoPago(): ?string
    {
        return $this->tipoPago;
    }

    public function setTipoPago(string $tipoPago): self
    {
        $this->tipoPago = $tipoPago;

        return $this;
    }

    public function getFechaPago(): ?\DateTimeInterface
    {
        return $this->fechaPago;
    }

    public function setFechaPago(?\DateTimeInterface $fechaPago): self
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

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

//      * @return Collection|Liquidacion[]
     
    public function getLiquidaciones(): Collection
    {
        return $this->liquidaciones;
    }

    public function addLiquidacione(Liquidacion $liquidacione): self
    {
        if (!$this->liquidaciones->contains($liquidacione)) {
            $this->liquidaciones[] = $liquidacione;
            $liquidacione->setNomina($this);
        }

        return $this;
    }

    public function removeLiquidacione(Liquidacion $liquidacione): self
    {
        if ($this->liquidaciones->removeElement($liquidacione)) {
            // set the owning side to null (unless already changed)
            if ($liquidacione->getNomina() === $this) {
                $liquidacione->setNomina(NULL);
            }
        }

        return $this;
    }

    public function getRutEmpresa(): ?string
    {
        return $this->rutEmpresa;
    }

    public function setRutEmpresa(string $rutEmpresa): self
    {
        $this->rutEmpresa = $rutEmpresa;

        return $this;
    }

    public function getRutEmpresaDv(): ?string
    {
        return $this->rutEmpresaDv;
    }

    public function setRutEmpresaDv(string $rutEmpresaDv): self
    {
        $this->rutEmpresaDv = $rutEmpresaDv;

        return $this;
    }

//      * @return Collection|NominaLiquidacion[]

    public function getNominaLiquidaciones(): Collection
    {
        return $this->nominaLiquidaciones;
    }

    public function addNominaLiquidacione(NominaLiquidacion $nominaLiquidacione): self
    {
        if (!$this->nominaLiquidaciones->contains($nominaLiquidacione)) {
            $this->nominaLiquidaciones[] = $nominaLiquidacione;
            $nominaLiquidacione->setNomina($this);
        }

        return $this;
    }

    public function removeNominaLiquidacione(NominaLiquidacion $nominaLiquidacione): self
    {
        if ($this->nominaLiquidaciones->removeElement($nominaLiquidacione)) {
            // set the owning side to null (unless already changed)
            if ($nominaLiquidacione->getNomina() === $this) {
                $nominaLiquidacione->setNomina(null);
            }
        }

        return $this;
    }

//      * @return Collection|NominaCuenta[]

    public function getNominaCuentas(): Collection
    {
        return $this->nominaCuentas;
    }

    public function addNominaCuenta(NominaCuenta $nominaCuenta): self
    {
        if (!$this->nominaCuentas->contains($nominaCuenta)) {
            $this->nominaCuentas[] = $nominaCuenta;
            $nominaCuenta->setNomina($this);
        }

        return $this;
    }

    public function removeNominaCuenta(NominaCuenta $nominaCuenta): self
    {
        if ($this->nominaCuentas->removeElement($nominaCuenta)) {
            // set the owning side to null (unless already changed)
            if ($nominaCuenta->getNomina() === $this) {
                $nominaCuenta->setNomina(null);
            }
        }

        return $this;
    }

}
