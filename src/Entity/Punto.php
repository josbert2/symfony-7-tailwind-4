<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\PuntoRepository::class)]
//  * @ORM\HasLifecycleCallbacks

class Punto
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $monto;

    #[ORM\Column(type: 'integer')]
    private $utilizado = 0;

    #[ORM\Column(type: 'integer')]
    private $saldo;

    #[ORM\Column(type: 'text')]
    private $detalle;
    
    #[ORM\Column(type: 'text')]
    private $estado;
    
    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaVencimiento;
	
    #[ORM\ManyToOne(targetEntity: 'Cliente', inversedBy: 'puntos')]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    protected $cliente;

    #[ORM\ManyToOne(targetEntity: 'Market', inversedBy: 'puntos')]
    protected $market;
    

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

//      * @ORM\PrePersist
//      * @ORM\PreUpdate

    public function setData()
    {
        $this->saldo = $this->monto - $this->utilizado;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set monto.

//      * @param int $monto

//      * @return Punto

    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

//      * Get monto.

//      * @return int

    public function getMonto()
    {
        return $this->monto;
    }

//      * Set detalle.

//      * @param string $detalle

//      * @return Punto

    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

//      * Get detalle.

//      * @return string

    public function getDetalle()
    {
        return $this->detalle;
    }

//      * Set estado.

//      * @param string $estado

//      * @return Punto

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

//      * Get estado.

//      * @return string

    public function getEstado()
    {
        return $this->estado;
    }

//      * Set fechaVencimiento.

//      * @param \DateTime|null $fechaVencimiento

//      * @return Punto

    public function setFechaVencimiento($fechaVencimiento = null)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

//      * Get fechaVencimiento.

//      * @return \DateTime|null

    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Punto

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

//      * @return Punto

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

//      * Set cliente.

//      * @param \App\Entity\Cliente|null $cliente

//      * @return Punto

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

//      * Set utilizado.

//      * @param int $utilizado

//      * @return Punto

    public function setUtilizado($utilizado)
    {
        $this->utilizado = $utilizado;

        return $this;
    }

//      * Get utilizado.

//      * @return int

    public function getUtilizado()
    {
        return $this->utilizado;
    }

//      * Set saldo.

//      * @param int $saldo

//      * @return Punto

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

//      * Get saldo.

//      * @return int

    public function getSaldo()
    {
        return $this->saldo;
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
}
