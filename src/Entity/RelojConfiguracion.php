<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'reloj_configuracion')]
 
class RelojConfiguracion
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'relojesConfigurados')]
    private $proveedor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descripcion;

    #[ORM\Column(type: 'integer')]
    private $verde;

    #[ORM\Column(type: 'integer')]
    private $azul;

    #[ORM\Column(type: 'integer')]
    private $rojo;

    // Getters y setters

    public function getId()
    {
        return $this->id;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function getVerde()
    {
        return $this->verde;
    }

    public function setVerde($verde)
    {
        $this->verde = $verde;
        return $this;
    }

    public function getAzul()
    {
        return $this->azul;
    }

    public function setAzul($azul)
    {
        $this->azul = $azul;
        return $this;
    }

    public function getRojo()
    {
        return $this->rojo;
    }

    public function setRojo($rojo)
    {
        $this->rojo = $rojo;
        return $this;
    }
}
