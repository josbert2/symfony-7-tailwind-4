<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

//  * ProveedorLiquidacionPendiente

//  * @ORM\Table(
//  *     name="proveedor_liquidacion_pendiente",
//  *     indexes={
//  *         @ORM\Index(name="idx_proveedor_liquidacion_pendiente_proveedor_id", columns={"proveedor_id")
//  *     }
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\ProveedorLiquidacionPendienteRepository::class)]

class ProveedorLiquidacionPendiente
{

//      * @var int

    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]

    private $id;

//      * @var \App\Entity\Proveedor

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'liquidacionesPendientes')]
    #[ORM\JoinColumn(name: 'proveedor_id', referencedColumnName: 'id', onDelete: 'CASCADE')]

    private $proveedor;

//      * @var \DateTime

    #[ORM\Column(name: 'fecha_actualizacion', type: 'datetime')]

    private $fechaActualizacion;

    // --------- Getters & Setters ---------

//      * Get id

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set proveedor

//      * @param \App\Entity\Proveedor $proveedor
//      * @return ProveedorLiquidacionPendiente

    public function setProveedor(\App\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;
        return $this;
    }

//      * Get proveedor

//      * @return \App\Entity\Proveedor

    public function getProveedor()
    {
        return $this->proveedor;
    }

//      * Set fechaActualizacion

//      * @param \DateTime $fechaActualizacion
//      * @return ProveedorLiquidacionPendiente

    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
        return $this;
    }

//      * Get fechaActualizacion

//      * @return \DateTime

    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }
}
