<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: App\Repository\TransbankRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Transbank
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $ordenCompra;
    
    #[ORM\Column(name: 'id_transbank', type: 'string', length: 255, nullable: true)]
    private $idTransbank;
    
    #[ORM\Column(type: 'integer')]
    private $monto;
    
    #[ORM\Column(name: 'digitos', type: 'string', length: 10, nullable: true)]
    private $digitos;

    #[ORM\Column(name: 'codigo', type: 'string', length: 255)]
    private $codigo;

    #[ORM\Column(name: 'cuotas', type: 'integer')]
    private $cuotas;

    #[ORM\Column(name: 'tipo', type: 'string', length: 255)]
    private $tipo;
    
    #[ORM\Column(name: 'reversa', type: 'string', length: 255, nullable: true)]
    private $reversa;
    
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Transaccion', inversedBy: 'transbanks')]
    protected $transaccion;

    #[ORM\OneToOne(targetEntity: 'App\Entity\TransaccionDetalle', mappedBy: 'transbank')]
    protected $transaccionDetalle;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Transaccion', mappedBy: 'transbank')]
    protected $transaccionOriginal;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(type: 'text', nullable: true)]
    private $payload;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $responseCode;

    public function getTipoFull()
    {
        $tipoPago = null;
        switch ($this->tipo) {
            case 'VP':
                $tipoPago = 'Prepago'; 
                break;
            case 'VD':
                $tipoPago = 'Venta Débito'; 
                break;
            case 'VN':
                $tipoPago = 'Sin Cuotas'; 
                break;
            case 'VC':
                $tipoPago = 'Cuotas Normales'; 
                break;
            case 'NC':
            case 'SI':
            case 'S2': 
                $tipoPago = 'Sin Interés'; 
                break;
            case 'CI': 
                $tipoPago = 'Cuotas Comercio'; 
                break;
        }
        
        return $tipoPago;
    }
    
    public function getCuotasFull()
    {
        $cuotas = null;
        switch ($this->tipo) {
            case 'VD':
            case 'VN': $cuotas = '00'; break;
            case 'VC': $cuotas = $this->cuotas; break;
            case 'NC': $cuotas = 'N'; break;
            case 'SI': $cuotas = '3'; break;
            case 'S2': $cuotas = '2'; break;
        }
        
        return $cuotas;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdenCompra(): ?string
    {
        return $this->ordenCompra;
    }

    public function setOrdenCompra(string $ordenCompra): self
    {
        $this->ordenCompra = $ordenCompra;

        return $this;
    }

    public function getIdTransbank(): ?string
    {
        return $this->idTransbank;
    }

    public function setIdTransbank(?string $idTransbank): self
    {
        $this->idTransbank = $idTransbank;

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

    public function getDigitos(): ?int
    {
        return $this->digitos;
    }

    public function setDigitos($digitos)
    {
        if (is_numeric($digitos)) {
            $this->digitos = (int) $digitos;
        } else {
            $this->digitos = 0;
        }
        
        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getCuotas(): ?int
    {
        return $this->cuotas;
    }

    public function setCuotas(int $cuotas): self
    {
        $this->cuotas = $cuotas;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getReversa(): ?string
    {
        return $this->reversa;
    }

    public function setReversa(?string $reversa): self
    {
        $this->reversa = $reversa;

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

        // set (or unset) the owning side of the relation if necessary
        $newTransbank = $transaccion === null ? null : $this;
        if ($newTransbank !== $transaccion->getTransbank()) {
            $transaccion->setTransbank($newTransbank);
        }

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
            $this->transaccionDetalle->setTransbank(null);
        }

        // set the owning side of the relation if necessary
        if ($transaccionDetalle !== null && $transaccionDetalle->getTransbank() !== $this) {
            $transaccionDetalle->setTransbank($this);
        }

        $this->transaccionDetalle = $transaccionDetalle;

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
            $this->transaccionOriginal->setTransbank(null);
        }

        // set the owning side of the relation if necessary
        if ($transaccionOriginal !== null && $transaccionOriginal->getTransbank() !== $this) {
            $transaccionOriginal->setTransbank($this);
        }

        $this->transaccionOriginal = $transaccionOriginal;

        return $this;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }

    public function setPayload(?string $payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    public function setResponseCode(?int $responseCode): self
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    public function getTipoPagoDescripcion(): string
    {
        $tipos = [
            'VD' => 'Venta Débito',
            'VN' => 'Venta Normal',
            'VC' => 'Venta en cuotas',
            'SI' => '3 cuotas sin interés',
            'S2' => '2 cuotas sin interés',
            'NC' => 'N cuotas sin interés',
            'VP' => 'Venta Prepago',
        ];

        return $tipos[$this->tipo] ?? $this->tipo;
    }

}
