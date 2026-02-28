<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\CajaEgresoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class CajaEgreso
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigo;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;

    #[ORM\Column(type: 'integer')]
    private $saldoInicial = 0;

    #[ORM\Column(type: 'integer')]
    private $monto = 0;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Caja', inversedBy: 'egresos')]
    protected $caja;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Cuadratura', inversedBy: 'egresos')]
    protected $cuadratura;

    #[ORM\ManyToOne(targetEntity: 'Staff', inversedBy: 'egresos')]
    protected $staff;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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

    public function getCuadratura(): ?Cuadratura
    {
        return $this->cuadratura;
    }

    public function setCuadratura(?Cuadratura $cuadratura): self
    {
        $this->cuadratura = $cuadratura;

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

    public function getSaldoInicial(): ?int
    {
        return $this->saldoInicial;
    }

    public function setSaldoInicial(int $saldoInicial): self
    {
        $this->saldoInicial = $saldoInicial;

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


}
