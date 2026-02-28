<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: App\Repository\NominaCuentaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class NominaCuenta
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titular;

    #[ORM\Column(type: 'string', length: 255)]
    private $banco;

    #[ORM\Column(type: 'string', length: 255)]
    private $numero;

    #[ORM\Column(type: 'string', length: 255)]
    private $rut;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Nomina', inversedBy: 'nominaCuentas')]
    protected $nomina;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Liquidacion', inversedBy: 'nominaCuentas')]
    protected $liquidacion;

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

    public function getTitular(): ?string
    {
        return $this->titular;
    }

    public function setTitular(string $titular): self
    {
        $this->titular = $titular;

        return $this;
    }

    public function getBanco(): ?string
    {
        return $this->banco;
    }

    public function setBanco(string $banco): self
    {
        $this->banco = $banco;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getNomina(): ?Nomina
    {
        return $this->nomina;
    }

    public function setNomina(?Nomina $nomina): self
    {
        $this->nomina = $nomina;

        return $this;
    }

    public function getLiquidacion(): ?Liquidacion
    {
        return $this->liquidacion;
    }

    public function setLiquidacion(?Liquidacion $liquidacion): self
    {
        $this->liquidacion = $liquidacion;

        return $this;
    }

}
