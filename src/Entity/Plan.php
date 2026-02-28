<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
    #[ORM\Entity(repositoryClass: App\Repository\PlanRepository::class)]
 
class Plan
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, unique: true, nullable: true)]
    private $codigo;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcion;
    
    #[ORM\Column(type: 'boolean')]
    private $acuerdoComercial = false;

//      * Nivel lógico del plan (1,2,3)

    #[ORM\Column(type: 'integer')]

    private $nivel;
    
    #[ORM\Column(type: 'boolean')]
    private $gratuito = false;
    
    #[ORM\Column(type: 'integer')]
    private $monto;
    
    #[ORM\OneToMany(targetEntity: 'Proveedor', mappedBy: 'plan')]
    protected $proveedores;

    #[ORM\Column(type: 'string', length: 20)]
    private $intervalo;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\Column(type: 'json', nullable: true)]
    private $beneficios = [];

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function __toString()
    {
        return $this->nombre;
    }
    public function __construct()
    {
        $this->proveedores = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function addProveedore(\App\Entity\Proveedor $proveedore)
    {
        $this->proveedores[] = $proveedore;

        return $this;
    }

    public function removeProveedore(\App\Entity\Proveedor $proveedore)
    {
        return $this->proveedores->removeElement($proveedore);
    }

    public function getProveedores()
    {
        return $this->proveedores;
    }

    public function setAcuerdoComercial($acuerdoComercial)
    {
        $this->acuerdoComercial = $acuerdoComercial;

        return $this;
    }

    public function getAcuerdoComercial()
    {
        return $this->acuerdoComercial;
    }

    public function setGratuito($gratuito)
    {
        $this->gratuito = $gratuito;

        return $this;
    }

    public function getGratuito()
    {
        return $this->gratuito;
    }

    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;    

        return $this;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }


    public function setIntervalo($intervalo)
    {
        $this->intervalo = $intervalo;

        return $this;
    }

    public function getIntervalo()
    {
        return $this->intervalo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    public function getActivo()
    {
        return $this->activo;
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

    public function getBeneficios(): array
    {
        return $this->beneficios ?? [];
    }

    public function setBeneficios(array $beneficios)
    {
        $this->beneficios = array_values(array_filter($beneficios));
    }

}
