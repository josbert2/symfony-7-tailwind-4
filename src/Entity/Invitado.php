<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity(repositoryClass: App\Repository\InvitadoRepository::class)]
//  * @ORM\HasLifecycleCallbacks()
    #[Gedmo\SoftDeleteable(fieldName: 'deleted')]

class Invitado
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $apellido;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $estado = 'Pendiente';

    #[ORM\Column(type: 'string', length: 255)]
    private $codigo;

    #[ORM\Column(type: 'integer')]
    private $cantidad = 1;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaVencimiento;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaEmail;

    #[ORM\ManyToOne(targetEntity: 'Lista', inversedBy: 'invitados')]
    protected $lista;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'invitado')]
    protected $invitaciones;

    #[ORM\OneToMany(targetEntity: 'Invitacion', mappedBy: 'invitadoOriginal')]
    protected $invitacionesReenviadas;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    protected $deleted;

    public function getNombreCorto()
    {
        return $this->nombre.' '.substr($this->apellido, 0, 1).'.';
    }

    public function getTipo()
    {
        return $this->getLista()->getTipo();
    }

    public function getGrupo()
    {
        return $this->getLista()->getGrupo();
    }

    public function getActividad()
    {
        return $this->getLista()->getActividad();
    }

    public function getActividadEvento()
    {
        return $this->getLista()->getActividadEvento();
    }

    public function getActividadEventos()
    {
        return $this->getLista()->getActividadEventos();
    }

    public function getActividadEventoPrecio()
    {
        return $this->getLista()->getActividadEventoPrecio();
    }

    public function getTipoPrecio()
    {
        return $this->getLista()->getTipoPrecio();
    }

    public function getMarket()
    {
        return $this->getLista()->getMarket();
    }

    public function getAbierta()
    {
        return $this->getLista()->getAbierta();
    }

    public function getActividadZona()
    {
        return $this->getLista()->getActividadZona();
    }

    public function getFechaVencimientoCheck()
    {
        $fechaVencimiento = $this->getFechaVencimiento();
        if($fechaVencimiento){
            $sHora = $fechaVencimiento->format('H:i:s');
            if($sHora == '00:00:00'){
                $fechaVencimiento->modify('+1 day')->modify('-1 second');
            }
        }
        return $fechaVencimiento;
    }

    public function __construct()
    {
        $this->invitaciones = new ArrayCollection();
        $this->invitacionesReenviadas = new ArrayCollection();
    }

//      * @ORM\PrePersist

    public function setLife()
    {
        $codigo = $this->getCodigo();
        if(!$codigo){
            $codigo = $this->generateRandomString();
            $this->setCodigo($codigo);
        }

    }

    public function generateRandomString($length = 20, $lowercase = false)
    {
        $characters = 'abcdefghijkymnopqrstuvwxyz0123456789';
        if (!$lowercase) {
            $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $random;
    }

    public function getNombreCompleto()
    {
        return $this->getNombre().' '.$this->getApellido();
    }

    public function getProveedor()
    {
        return $this->getGrupo()->getProveedor();
    }

    public function __toString() {
        return $this->getNombreCompleto();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

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

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFechaVencimiento(): ?\DateTimeInterface
    {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento(?\DateTimeInterface $fechaVencimiento): self
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    public function getFechaEmail(): ?\DateTimeInterface
    {
        return $this->fechaEmail;
    }

    public function setFechaEmail(?\DateTimeInterface $fechaEmail): self
    {
        $this->fechaEmail = $fechaEmail;

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

    public function getLista(): ?Lista
    {
        return $this->lista;
    }

    public function setLista(?Lista $lista): self
    {
        $this->lista = $lista;

        return $this;
    }

//      * @return Collection|Invitacion[]
     
    public function getInvitaciones(): Collection
    {
        return $this->invitaciones;
    }

    public function addInvitacione(Invitacion $invitacione): self
    {
        if (!$this->invitaciones->contains($invitacione)) {
            $this->invitaciones[] = $invitacione;
            $invitacione->setInvitado($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->contains($invitacione)) {
            $this->invitaciones->removeElement($invitacione);
            // set the owning side to null (unless already changed)
            if ($invitacione->getInvitado() === $this) {
                $invitacione->setInvitado(null);
            }
        }

        return $this;
    }

//      * @return Collection|Invitacion[]

    public function getInvitacionesReenviadas(): Collection
    {
        return $this->invitacionesReenviadas;
    }

    public function addInvitacionesReenviada(Invitacion $invitacionesReenviada): self
    {
        if (!$this->invitacionesReenviadas->contains($invitacionesReenviada)) {
            $this->invitacionesReenviadas[] = $invitacionesReenviada;
            $invitacionesReenviada->setInvitadoOriginal($this);
        }

        return $this;
    }

    public function removeInvitacionesReenviada(Invitacion $invitacionesReenviada): self
    {
        if ($this->invitacionesReenviadas->contains($invitacionesReenviada)) {
            $this->invitacionesReenviadas->removeElement($invitacionesReenviada);
            // set the owning side to null (unless already changed)
            if ($invitacionesReenviada->getInvitadoOriginal() === $this) {
                $invitacionesReenviada->setInvitadoOriginal(null);
            }
        }

        return $this;
    }



}
