<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

//  * @ORM\Table(indexes={
//  *     @ORM\Index(name="quemador", columns={"fecha_acceso", "deleted"),
//  *     @ORM\Index(name="codigo", columns={"codigo", "deleted"),
//  *     @ORM\Index(name="consulta", columns={"codigo_secundario", "deleted"),
//  *     @ORM\Index(name="idx_fin_tiempo", columns={"fin_tiempo"),
//  *     @ORM\Index(name="idx_estado", columns={"estado"),
//  *     @ORM\Index(name="idx_entrada_item_estado_deleted", columns={"item_id", "estado", "deleted")
//  * )
    #[ORM\Entity(repositoryClass: App\Repository\EntradaRepository::class)]
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Entrada
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $codigo;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaAcceso;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $emailResena;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rut;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $comision;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $cobroFijo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estadoLiquidacion;

    #[ORM\ManyToOne(targetEntity: 'Item', inversedBy: 'entradas')]
    protected $item;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Nino', inversedBy: 'entradas')]
    protected $nino;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Liquidacion', inversedBy: 'entradas')]
    protected $liquidacion;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Liquidacion', inversedBy: 'entradas')]
    protected $liquidacionOriginal;

    #[ORM\OneToOne(targetEntity: 'Resena', mappedBy: 'entrada')]
    protected $resena;

    #[ORM\OneToOne(targetEntity: 'CodigoExterno', mappedBy: 'entrada')]
    protected $codigoExterno;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Asistente', mappedBy: 'entrada')]
    protected $asistente;

    #[ORM\OneToMany(targetEntity: 'EntradaAcceso', mappedBy: 'entrada')]
    protected $accesos;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $razon;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $estado;

    #[ORM\OneToMany(mappedBy: 'entrada', targetEntity: EntradaEstado::class)]
    private $entradaEstados;

    #[ORM\OneToOne(mappedBy: 'entrada', targetEntity: AsistenteLocal::class)]
    private $asistenteLocal;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $codigoSecundario;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $inicioTiempo;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $finTiempo;

    public function __construct()
    {
        $this->accesos = new ArrayCollection();
        $this->entradaEstados = new ArrayCollection();
    }

    public function getCobroFijoFinal()
    {
        return !is_null($this->getCobroFijo()) ? $this->getCobroFijo() : $this->getItem()->getCobroFijo();
    }

    public function getComisionFinal()
    {
        return !is_null($this->getComision()) ? $this->getComision() : $this->getItem()->getComision();
    }

    public function getCliente(): ?Cliente
    {
        $transaccion = $this->getItem()->getTransaccion();

        return $transaccion->getCliente();
    }

    public function getProveedor(): ?Proveedor
    {
        return $this->getItem()->getProveedor();
    }

    public function getActividad(): ?Actividad
    {
        return $this->getItem()->getActividad();
    }

    public function getEvento(): ?ActividadEvento
    {
        return $this->getItem()->getEvento();
    }

    public function getEventoPrecio()
    {
        return $this->getItem()->getEventoPrecio();
    }

    public function getCodigoTicket()
    {
        $rut = $this->getRut();
        if ($rut) {
            $codigo = $rut;
        } else {
            $codigo = $this->getCodigo();
        }

        return $codigo;
    }

    public function getEstado()
    {
        if(!$this->estado){
            if($this->fechaAcceso){
                $this->estado = 'Validado';
            }
            else{
                $this->estado = 'No Validado';
            }
            $this->setEstado($this->estado);
        } elseif(!in_array($this->estado, ['Cancelado', 'Validado']) && !$this->fechaAcceso) {
            $this->estado = 'No Validado';
        }

        return $this->estado;
    }

    public function getMarket()
    {
        return $this->getItem()->getMarket();
    }

    public function getBarcode($format = 'png')
    {
        $actividad = $this->getActividad();
        $tipoCodigo = NULL;
        if ($actividad) {
            $tipoCodigo = $actividad->getCodigoDoble() ? $actividad->getTipoCodigoExterno() : $actividad->getTipoCodigo();
        }

        if (!$tipoCodigo) {
            $tipoCodigo = 'TYPE_CODE_128';
        }

        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $tipo = constant('\Picqer\Barcode\BarcodeGeneratorPNG::' . $tipoCodigo);

        return 'data:image/png;base64,' . base64_encode($generator->getBarcode($this->getCodigo(), $tipo));
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFechaAcceso(): ?\DateTimeInterface
    {
        return $this->fechaAcceso;
    }

    public function setFechaAcceso(?\DateTimeInterface $fechaAcceso): self
    {
        $this->fechaAcceso = $fechaAcceso;

        return $this;
    }

    public function getEmailResena(): ?\DateTimeInterface
    {
        return $this->emailResena;
    }

    public function setEmailResena(?\DateTimeInterface $emailResena): self
    {
        $this->emailResena = $emailResena;

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

    public function getDeleted(): ?\DateTimeInterface
    {
        return $this->deleted;
    }

    public function setDeleted(?\DateTimeInterface $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getNino(): ?Nino
    {
        return $this->nino;
    }

    public function setNino(?Nino $nino): self
    {
        $this->nino = $nino;

        return $this;
    }

    public function getResena(): ?Resena
    {
        return $this->resena;
    }

    public function setResena(?Resena $resena): self
    {
        $this->resena = $resena;

        // set (or unset) the owning side of the relation if necessary
        $newEntrada = $resena === NULL ? NULL : $this;
        if ($newEntrada !== $resena->getEntrada()) {
            $resena->setEntrada($newEntrada);
        }

        return $this;
    }

    public function getCodigoExterno(): ?CodigoExterno
    {
        return $this->codigoExterno;
    }

    public function setCodigoExterno(?CodigoExterno $codigoExterno): self
    {
        $this->codigoExterno = $codigoExterno;

        // set (or unset) the owning side of the relation if necessary
        $newEntrada = $codigoExterno === NULL ? NULL : $this;
        if ($newEntrada !== $codigoExterno->getEntrada()) {
            $codigoExterno->setEntrada($newEntrada);
        }

        return $this;
    }

//      * @return Collection|EntradaAcceso[]

    public function getAccesos(): Collection
    {
        return $this->accesos;
    }

    public function addAcceso(EntradaAcceso $acceso): self
    {
        if (!$this->accesos->contains($acceso)) {
            $this->accesos[] = $acceso;
            $acceso->setEntrada($this);
        }

        return $this;
    }

    public function removeAcceso(EntradaAcceso $acceso): self
    {
        if ($this->accesos->contains($acceso)) {
            $this->accesos->removeElement($acceso);
            // set the owning side to null (unless already changed)
            if ($acceso->getEntrada() === $this) {
                $acceso->setEntrada(NULL);
            }
        }

        return $this;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(?string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getAsistente(): ?Asistente
    {
        return $this->asistente;
    }

    public function setAsistente(?Asistente $asistente): self
    {
        $this->asistente = $asistente;

        // set (or unset) the owning side of the relation if necessary
        $newEntrada = $asistente === NULL ? NULL : $this;
        if ($newEntrada !== $asistente->getEntrada()) {
            $asistente->setEntrada($newEntrada);
        }

        return $this;
    }

    public function getRazon(): ?string
    {
        return $this->razon;
    }

    public function setRazon(?string $razon): self
    {
        $this->razon = $razon;
        $entradaEstado = $this->getEntradaEstado();
        $entradaEstado->setRazon($razon);

        return $this;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;
        $entradaEstado = $this->getEntradaEstado();
        $entradaEstado->setEstado($estado);
        $this->addEstado($entradaEstado);

        return $this;
    }

//      * @return Collection|EntradaEstado[]

    public function getEntradaEstados(): Collection
    {
        return $this->entradaEstados;
    }

    public function addEntradaEstado(EntradaEstado $entradaEstado): self
    {
        if (!$this->entradaEstados->contains($entradaEstado)) {
            $this->entradaEstados[] = $entradaEstado;
            $entradaEstado->setEntrada($this);
        }

        return $this;
    }

    public function removeEntradaEstado(EntradaEstado $entradaEstado): self
    {
        if ($this->entradaEstados->removeElement($entradaEstado)) {
            // set the owning side to null (unless already changed)
            if ($entradaEstado->getEntrada() === $this) {
                $entradaEstado->setEntrada(null);
            }
        }

        return $this;
    }

    public function getEntradaEstado()
    {
        if(!isset($this->entradaEstado)){
            $this->entradaEstado = new EntradaEstado();
        }
        return $this->entradaEstado;
    }

    public function addEstado(EntradaEstado $estado): self
    {
        if (!$this->entradaEstados->contains($estado)) {
            $this->estados[] = $estado;
            $estado->setEntrada($this);
        }

        return $this;
    }

    public function getLiquidacion(): ?Liquidacion
    {
        return $this->liquidacion;
    }

    public function setLiquidacion(?Liquidacion $liquidacion): self
    {
        $this->liquidacion = $liquidacion;

        return $this;
    }

    public function getEstadoLiquidacion(): ?string
    {
        return $this->estadoLiquidacion;
    }

    public function setEstadoLiquidacion(?string $estadoLiquidacion): self
    {
        $this->estadoLiquidacion = $estadoLiquidacion;

        return $this;
    }

    public function getComision(): ?int
    {
        return $this->comision;
    }

    public function setComision(?int $comision): self
    {
        $this->comision = $comision;

        return $this;
    }

    public function getCobroFijo(): ?int
    {
        return $this->cobroFijo;
    }

    public function setCobroFijo(?int $cobroFijo): self
    {
        $this->cobroFijo = $cobroFijo;

        return $this;
    }

    public function getLiquidacionOriginal(): ?Liquidacion
    {
        return $this->liquidacionOriginal;
    }

    public function setLiquidacionOriginal(?Liquidacion $liquidacionOriginal): self
    {
        $this->liquidacionOriginal = $liquidacionOriginal;

        return $this;
    }

    public function getAsistenteLocal(): ?AsistenteLocal
    {
        return $this->asistenteLocal;
    }

    public function setAsistenteLocal(AsistenteLocal $asistenteLocal): self
    {
        // set the owning side of the relation if necessary
        if ($asistenteLocal->getEntrada() !== $this) {
            $asistenteLocal->setEntrada($this);
        }

        $this->asistenteLocal = $asistenteLocal;

        return $this;
    }

    public function getCodigoSecundario(): ?string
    {
        return $this->codigoSecundario;
    }

    public function setCodigoSecundario(?string $codigoSecundario): self
    {
        $this->codigoSecundario = $codigoSecundario;

        return $this;
    }

    public function getInicioTiempo(): ?\DateTimeInterface
    {
        return $this->inicioTiempo;
    }

    public function setInicioTiempo(?\DateTimeInterface $inicioTiempo): self
    {
        $this->inicioTiempo = $inicioTiempo;

        return $this;
    }

    public function getFinTiempo(): ?\DateTimeInterface
    {
        return $this->finTiempo;
    }

    public function setFinTiempo(?\DateTimeInterface $finTiempo): self
    {
        $this->finTiempo = $finTiempo;

        return $this;
    }

    public function getStatus(): int
    {
        $acceso = $this->getAsistenteLocal();
        if (!$acceso) {
            return 0;
        }

        if (!$acceso->getFechaSalida()) {
            return 1;
        }

        $inicio = $this->getInicioTiempo();
        $fin = $this->getFinTiempo();

        if (!$inicio || !$fin) {
            return 0;
        }

        $duracion = ($fin->getTimestamp() - $inicio->getTimestamp()) / 60;
        $tiempoUsado = ($acceso->getFechaSalida()->getTimestamp() - $acceso->getCreated()->getTimestamp()) / 60;

        return ($tiempoUsado + 10 > $duracion) ? 3 : 2;
    }

    public function getTimeLeft(): ?int
    {
        $inicio = $this->getInicioTiempo();
        $fin = $this->getFinTiempo();

        if (!$inicio || !$fin) {
            return null;
        }

        return (int)(($fin->getTimestamp() - $inicio->getTimestamp()) / 60);
    }
}
