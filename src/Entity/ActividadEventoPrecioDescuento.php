<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\ActividadEventoPrecioDescuentoRepository::class)]
class ActividadEventoPrecioDescuento
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaInicio;

    #[ORM\Column(type: 'date', nullable: true)]
    private $fechaTermino;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioNormal;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $precioOferta;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cupos;

    #[ORM\Column(type: 'boolean')]
    private $mostrarTermino = false;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ActividadEventoPrecio', inversedBy: 'actividadEventoPrecioDescuento')]
    protected $actividadEventoPrecio;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function isActivo()
    {
        $now = new \DateTime();
        $fechaInicio = $this->getFechaInicio();
        $fechaTermino = $this->getFechaTermino();
        if($fechaTermino){
            $fechaTermino = clone $fechaTermino;
            $fechaTermino->modify('+1 day')->modify('-1 second');
        }
        $cupos = $this->getCupos();
        $found = false;

        if($fechaInicio && $fechaInicio <= $now){
            if($fechaTermino && $fechaTermino >= $now){
                if(is_null($cupos) || $cupos > 0){
                    $found = true;
                }
            }
        }

        return $found;
    }

    public function getProveedor()
    {
        return $this->getActividadEventoPrecio()->getProveedor();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaTermino(): ?\DateTimeInterface
    {
        return $this->fechaTermino;
    }

    public function setFechaTermino(?\DateTimeInterface $fechaTermino): self
    {
        $this->fechaTermino = $fechaTermino;

        return $this;
    }

    public function getCupos(): ?int
    {
        return $this->cupos;
    }

    public function setCupos(?int $cupos): self
    {
        $this->cupos = $cupos;

        return $this;
    }

    public function getMostrarTermino(): ?bool
    {
        return $this->mostrarTermino;
    }

    public function setMostrarTermino(bool $mostrarTermino): self
    {
        $this->mostrarTermino = $mostrarTermino;

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

    public function getActividadEventoPrecio(): ?ActividadEventoPrecio
    {
        return $this->actividadEventoPrecio;
    }

    public function setActividadEventoPrecio(?ActividadEventoPrecio $actividadEventoPrecio): self
    {
        $this->actividadEventoPrecio = $actividadEventoPrecio;

        return $this;
    }

    public function getPrecioOferta(): ?int
    {
        return $this->precioOferta;
    }

    public function setPrecioOferta(?int $precioOferta): self
    {
        $this->precioOferta = $precioOferta;

        return $this;
    }

    public function getPrecioNormal(): ?int
    {
        return $this->precioNormal;
    }

    public function setPrecioNormal(?int $precioNormal): self
    {
        $this->precioNormal = $precioNormal;

        return $this;
    }



}
