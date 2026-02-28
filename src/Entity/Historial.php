<?php

namespace App\Entity;

use App\Repository\HistorialRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: HistorialRepository::class)]
//  * @ORM\Table(
//  * indexes={
//  *     @ORM\Index(name="idx_created", columns={"created"),
//  *     @ORM\Index(name="idx_accion", columns={"accion"),
//  *     @ORM\Index(name="idx_entidad", columns={"entidad", "entidad_id"),
//  *     @ORM\Index(name="idx_entidad_id", columns={"entidad_id")
//  *  }
//  * )

class Historial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $entidad;

    #[ORM\Column(type: 'integer')]
    private $entidadId;

    #[ORM\ManyToOne(inversedBy: 'historials', targetEntity: Usuario::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $usuario;

    #[ORM\Column(type: 'json', nullable: true)]
    private $data = [];

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'string', length: 255)]
    private $accion;
    
    public function getId(): ?int
    {
        return $this->id;
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

    public function setEntidadId(int $entidadId): self
    {
        $this->entidadId = $entidadId;

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

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
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
}
