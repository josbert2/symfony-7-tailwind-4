<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: App\Repository\RelojIniciadoRepository::class)]
    #[ORM\Table(name: 'reloj_iniciado')]
class RelojIniciado
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor', inversedBy: 'relojesIniciados')]
    private $proveedor;

    #[ORM\Column(type: 'integer')]
    private $verde;

    #[ORM\Column(type: 'integer')]
    private $azul;

    #[ORM\Column(type: 'integer')]
    private $rojo;

    #[ORM\Column(type: 'datetime')]
    private $envioDeTiempo;

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

    public function getEnvioDeTiempo()
    {
        return $this->envioDeTiempo;
    }

    public function setEnvioDeTiempo(\DateTime $envioDeTiempo)
    {
        $this->envioDeTiempo = $envioDeTiempo;
        return $this;
    }

    public function getEnvioDeTiempoFormatted(): ?string
    {
        if ($this->envioDeTiempo === null) {
            return null;
        }

        return $this->envioDeTiempo->format('d-m-Y H:i');
    }

    public function arrayRelojesFiltrados(): array
    {
        return [
            'verde' => $this->getVerde(),
            'azul' => $this->getAzul(),
            'rojo' => $this->getRojo(),
            'envioDeTiempoFormatted' => $this->getEnvioDeTiempo()->format('d-m-Y H:i'),
        ];
    }
}
