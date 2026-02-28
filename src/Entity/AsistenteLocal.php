<?php

namespace App\Entity;

use App\Repository\AsistenteLocalRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: AsistenteLocalRepository::class)]
//  * @ORM\Table(
//  *     name="asistente_local",
//  *     indexes={
//  *         @ORM\Index(name="idx_fecha_salida", columns={"fecha_salida"),
//  *         @ORM\Index(name="idx_created", columns={"created")
//  *     }
//  * )

class AsistenteLocal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'asistenteLocal', targetEntity: Entrada::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $entrada;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaSalida;

    #[ORM\Column(type: 'string', length: 255)]
    private $codigoEntrada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrada(): ?Entrada
    {
        return $this->entrada;
    }

    public function setEntrada(Entrada $entrada): self
    {
        $this->entrada = $entrada;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fechaSalida;
    }

    public function setFechaSalida(?\DateTimeInterface $fechaSalida): self
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    public function getCodigoEntrada(): ?string
    {
        return $this->codigoEntrada;
    }

    public function setCodigoEntrada(string $codigoEntrada): self
    {
        $this->codigoEntrada = $codigoEntrada;

        return $this;
    }
}
