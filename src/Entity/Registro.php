<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass: App\Repository\RegistroRepository::class)]
class Registro
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $accion;

    #[ORM\Column(type: 'string', length: 255)]
    private $entidad;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $entidadId;

    #[ORM\Column(type: 'string', length: 255)]
    private $usuario;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $usuarioId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $columna;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $oldValor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $valor;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccion(): ?string
    {
        return $this->accion;
    }

    public function setAccion(string $accion): self
    {
        $this->accion = $accion;

        return $this;
    }

    public function getEntidad(): ?string
    {
        return $this->entidad;
    }

    public function setEntidad(string $entidad): self
    {
        $this->entidad = $entidad;

        return $this;
    }

    public function getEntidadId(): ?int
    {
        return $this->entidadId;
    }

    public function setEntidadId(?int $entidadId): self
    {
        $this->entidadId = $entidadId;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getUsuarioId(): ?int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(?int $usuarioId): self
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    public function getColumna(): ?string
    {
        return $this->columna;
    }

    public function setColumna(?string $columna): self
    {
        $this->columna = $columna;

        return $this;
    }

    public function getOldValor(): ?string
    {
        return $this->oldValor;
    }

    public function setOldValor(?string $oldValor): self
    {
        $this->oldValor = $oldValor;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): self
    {
        $this->valor = $valor;

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

}
