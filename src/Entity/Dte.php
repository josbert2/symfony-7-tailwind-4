<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


    #[ORM\Entity(repositoryClass: App\Repository\DteRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Dte
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $idDte;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipodoc;

    #[ORM\Column(type: 'integer')]
    private $monto;

    #[ORM\Column(type: 'string', length: 255)]
    private $pdf;

    #[ORM\Column(type: 'string', length: 255)]
    private $sucursal = '';

    #[ORM\Column(type: 'boolean')]
    private $enviado = false;

//
//    /**
     */
//     * #[ORM\OneToOne(targetEntity: 'VichFile', inversedBy: 'dte')]
// //     */
//    protected $pdf;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Transaccion', inversedBy: 'dtes')]
    protected $transaccion;
//
    #[ORM\OneToOne(targetEntity: 'App\Entity\Transaccion', mappedBy: 'dte')]
    protected $transaccionOriginal;

    #[ORM\OneToOne(targetEntity: 'App\Entity\TransaccionDetalle', mappedBy: 'dte')]
    protected $transaccionDetalle;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Envio', mappedBy: 'dte')]
    protected $envio;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Item', mappedBy: 'dte')]
    protected $items;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDte(): ?string
    {
        return $this->idDte;
    }

    public function setIdDte(string $idDte): self
    {
        $this->idDte = $idDte;

        return $this;
    }

    public function getTipodoc(): ?string
    {
        return $this->tipodoc;
    }

    public function setTipodoc(string $tipodoc): self
    {
        $this->tipodoc = $tipodoc;

        return $this;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function getSucursal(): ?string
    {
        return $this->sucursal;
    }

    public function setSucursal(string $sucursal): self
    {
        $this->sucursal = $sucursal;

        return $this;
    }

    public function getEnviado(): ?bool
    {
        return $this->enviado;
    }

    public function setEnviado(bool $enviado): self
    {
        $this->enviado = $enviado;

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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getTransaccion(): ?Transaccion
    {
        return $this->transaccion;
    }

    public function setTransaccion(?Transaccion $transaccion): self
    {
        $this->transaccion = $transaccion;

        return $this;
    }

    public function getTransaccionOriginal(): ?Transaccion
    {
        return $this->transaccionOriginal;
    }

    public function setTransaccionOriginal(?Transaccion $transaccionOriginal): self
    {
        // unset the owning side of the relation if necessary
        if ($transaccionOriginal === null && $this->transaccionOriginal !== null) {
            $this->transaccionOriginal->setDte(null);
        }

        // set the owning side of the relation if necessary
        if ($transaccionOriginal !== null && $transaccionOriginal->getDte() !== $this) {
            $transaccionOriginal->setDte($this);
        }

        $this->transaccionOriginal = $transaccionOriginal;

        return $this;
    }

    public function getEnvio(): ?Envio
    {
        return $this->envio;
    }

    public function setEnvio(?Envio $envio): self
    {
        // unset the owning side of the relation if necessary
        if ($envio === null && $this->envio !== null) {
            $this->envio->setDte(null);
        }

        // set the owning side of the relation if necessary
        if ($envio !== null && $envio->getDte() !== $this) {
            $envio->setDte($this);
        }

        $this->envio = $envio;

        return $this;
    }

    public function getTransaccionDetalle(): ?TransaccionDetalle
    {
        return $this->transaccionDetalle;
    }

    public function setTransaccionDetalle(?TransaccionDetalle $transaccionDetalle): self
    {
        // unset the owning side of the relation if necessary
        if ($transaccionDetalle === null && $this->transaccionDetalle !== null) {
            $this->transaccionDetalle->setDte(null);
        }

        // set the owning side of the relation if necessary
        if ($transaccionDetalle !== null && $transaccionDetalle->getDte() !== $this) {
            $transaccionDetalle->setDte($this);
        }

        $this->transaccionDetalle = $transaccionDetalle;

        return $this;
    }

//      * @return Collection|Item[]
     
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setDte($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getDte() === $this) {
                $item->setDte(null);
            }
        }

        return $this;
    }

}
