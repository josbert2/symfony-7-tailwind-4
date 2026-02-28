<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

    #[ORM\Entity(repositoryClass: App\Repository\MercadoPagoRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class MercadoPago
{
    #[ORM\Column(name: 'id', type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $collectionId;

    #[ORM\Column(type: 'string', length: 255)]
    private $collectionStatus;

    #[ORM\Column(type: 'string', length: 255)]
    private $externalReference;

    #[ORM\Column(type: 'string', length: 255)]
    private $merchantAccountId;

    #[ORM\Column(type: 'string', length: 255)]
    private $merchantOrderId;

    #[ORM\Column(type: 'string', length: 255)]
    private $paymentType;

    #[ORM\Column(type: 'string', length: 255)]
    private $preferenceId;

    #[ORM\Column(type: 'string', length: 255)]
    private $processingMode;

    #[ORM\Column(type: 'string', length: 255)]
    private $siteId;
    
    #[ORM\OneToOne(targetEntity: 'Transaccion', mappedBy: 'mercadoPago')]
    protected $transaccion;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getTipoFull()
    {
        $tipoPago = null;
        switch ($this->tipo) {
            case 'VD': $tipoPago = 'Venta Débito'; break;
            case 'VN': $tipoPago = 'Sin Cuotas'; break;
            case 'VC': $tipoPago = 'Cuotas Normales'; break;
            case 'NC':
            case 'SI':
            case 'S2': $tipoPago = 'Sin Interés'; break;
            case 'CI': $tipoPago = 'Cuotas Comercio'; break;
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

    public function getCollectionId(): ?string
    {
        return $this->collectionId;
    }

    public function setCollectionId(string $collectionId): self
    {
        $this->collectionId = $collectionId;

        return $this;
    }

    public function getCollectionStatus(): ?string
    {
        return $this->collectionStatus;
    }

    public function setCollectionStatus(string $collectionStatus): self
    {
        $this->collectionStatus = $collectionStatus;

        return $this;
    }

    public function getExternalReference(): ?string
    {
        return $this->externalReference;
    }

    public function setExternalReference(string $externalReference): self
    {
        $this->externalReference = $externalReference;

        return $this;
    }

    public function getMerchantAccountId(): ?string
    {
        return $this->merchantAccountId;
    }

    public function setMerchantAccountId(string $merchantAccountId): self
    {
        $this->merchantAccountId = $merchantAccountId;

        return $this;
    }

    public function getMerchantOrderId(): ?string
    {
        return $this->merchantOrderId;
    }

    public function setMerchantOrderId(string $merchantOrderId): self
    {
        $this->merchantOrderId = $merchantOrderId;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getPreferenceId(): ?string
    {
        return $this->preferenceId;
    }

    public function setPreferenceId(string $preferenceId): self
    {
        $this->preferenceId = $preferenceId;

        return $this;
    }

    public function getProcessingMode(): ?string
    {
        return $this->processingMode;
    }

    public function setProcessingMode(string $processingMode): self
    {
        $this->processingMode = $processingMode;

        return $this;
    }

    public function getSiteId(): ?string
    {
        return $this->siteId;
    }

    public function setSiteId(string $siteId): self
    {
        $this->siteId = $siteId;

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
        $newMercadoPago = $transaccion === null ? null : $this;
        if ($newMercadoPago !== $transaccion->getMercadoPago()) {
            $transaccion->setMercadoPago($newMercadoPago);
        }

        return $this;
    }
    

}
