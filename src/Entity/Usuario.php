<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

    #[ORM\Table(name: 'usuario')]
    #[ORM\Entity(repositoryClass: 'App\Repository\UsuarioRepository')]
    #[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $apellido;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $telefono;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $facebookId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $facebookAccessToken;

    #[ORM\Column(type: 'boolean')]
    protected $facebookFirst = false;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $googleId;
    
    #[ORM\Column(type: 'string', length: 2048, nullable: true)]
    protected $googleAccessToken;

    #[ORM\Column(type: 'boolean')]
    protected $googleFirst = false;

//      * @Assert\Valid

    #[ORM\OneToOne(targetEntity: 'VichFile', inversedBy: 'usuario')]
    protected $imagen;
    
    #[ORM\OneToOne(targetEntity: 'App\Entity\Staff', mappedBy: 'usuario')]
    protected $staff;
    
    #[ORM\OneToMany(targetEntity: 'Notificacion', mappedBy: 'usuario')]
    protected $notificaciones;

    #[ORM\OneToMany(targetEntity: 'Cliente', mappedBy: 'usuario')]
    protected $clientes;

    #[ORM\OneToMany(targetEntity: 'Dispositivo', mappedBy: 'usuario')]
    protected $dispositivos;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: EntradaEstado::class)]
    private $entradaEstados;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Historial::class)]
    private $historials;

    #[ORM\OneToMany(mappedBy: 'gestor', targetEntity: DevolucionDinero::class)]
    private $devolucionDineros;

    #[ORM\OneToMany(mappedBy: 'gestor', targetEntity: Indemnizacion::class)]
    private $indemnizacions;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $lastName;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateJoined;

    #[ORM\Column(type: 'boolean')]
    private $isActive = true;

    #[ORM\Column(type: 'boolean')]
    private $isStaff = false;

    #[ORM\Column(type: 'boolean')]
    private $isSuperuser = false;

    // Additional fields from original FOSUser that might be needed or were implicitly used?
    // username, usernameCanonical, emailCanonical, salt, etc.
    // For modern Symfony, we assume email is identifier.

    public function __construct()
    {
        $this->notificaciones = new ArrayCollection();
        $this->dispositivos = new ArrayCollection();
        $this->clientes = new ArrayCollection();
        $this->entradaEstados = new ArrayCollection();
        $this->historials = new ArrayCollection();
        $this->devolucionDineros = new ArrayCollection();
        $this->indemnizacions = new ArrayCollection();
        $this->dateJoined = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

//      * A visual identifier that represents this user.

//      * @see UserInterface

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

//      * @see UserInterface

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

//      * @see PasswordAuthenticatedUserInterface

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

//      * @see UserInterface

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): self
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    public function getFacebookAccessToken(): ?string
    {
        return $this->facebookAccessToken;
    }

    public function setFacebookAccessToken(?string $facebookAccessToken): self
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    public function getFacebookFirst(): ?bool
    {
        return $this->facebookFirst;
    }

    public function setFacebookFirst(bool $facebookFirst): self
    {
        $this->facebookFirst = $facebookFirst;

        return $this;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): self
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getGoogleAccessToken(): ?string
    {
        return $this->googleAccessToken;
    }

    public function setGoogleAccessToken(?string $googleAccessToken): self
    {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }

    public function getGoogleFirst(): ?bool
    {
        return $this->googleFirst;
    }

    public function setGoogleFirst(bool $googleFirst): self
    {
        $this->googleFirst = $googleFirst;

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

    public function getImagen(): ?VichFile
    {
        return $this->imagen;
    }

    public function setImagen(\App\Entity\VichFile $imagen = null): self
    {
        $imagen->setUsuario($this);
        $this->imagen = $imagen;
        return $this;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(\App\Entity\Staff $staff = null): self
    {
        $staff->setUsuario($this);
        $this->staff = $staff;

        return $this;
    }

//      * @return Collection|Notificacion[]

    public function getNotificaciones(): Collection
    {
        return $this->notificaciones;
    }

    public function addNotificacione(Notificacion $notificacione): self
    {
        if (!$this->notificaciones->contains($notificacione)) {
            $this->notificaciones[] = $notificacione;
            $notificacione->setUsuario($this);
        }

        return $this;
    }

    public function removeNotificacione(Notificacion $notificacione): self
    {
        if ($this->notificaciones->removeElement($notificacione)) {
            if ($notificacione->getUsuario() === $this) {
                $notificacione->setUsuario(null);
            }
        }

        return $this;
    }

//      * @return Collection|Cliente[]

    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setUsuario($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            if ($cliente->getUsuario() === $this) {
                $cliente->setUsuario(null);
            }
        }

        return $this;
    }

//      * @return Collection|Dispositivo[]

    public function getDispositivos(): Collection
    {
        return $this->dispositivos;
    }

    public function addDispositivo(Dispositivo $dispositivo): self
    {
        if (!$this->dispositivos->contains($dispositivo)) {
            $this->dispositivos[] = $dispositivo;
            $dispositivo->setUsuario($this);
        }

        return $this;
    }

    public function removeDispositivo(Dispositivo $dispositivo): self
    {
        if ($this->dispositivos->removeElement($dispositivo)) {
            if ($dispositivo->getUsuario() === $this) {
                $dispositivo->setUsuario(null);
            }
        }

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
            $entradaEstado->setUsuario($this);
        }

        return $this;
    }

    public function removeEntradaEstado(EntradaEstado $entradaEstado): self
    {
        if ($this->entradaEstados->removeElement($entradaEstado)) {
            if ($entradaEstado->getUsuario() === $this) {
                $entradaEstado->setUsuario(null);
            }
        }

        return $this;
    }

//      * @return Collection|Historial[]

    public function getHistorials(): Collection
    {
        return $this->historials;
    }

    public function addHistorial(Historial $historial): self
    {
        if (!$this->historials->contains($historial)) {
            $this->historials[] = $historial;
            $historial->setUsuario($this);
        }

        return $this;
    }

    public function removeHistorial(Historial $historial): self
    {
        if ($this->historials->removeElement($historial)) {
            if ($historial->getUsuario() === $this) {
                $historial->setUsuario(null);
            }
        }

        return $this;
    }

//      * @return Collection|DevolucionDinero[]

    public function getDevolucionDineros(): Collection
    {
        return $this->devolucionDineros;
    }

    public function addDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if (!$this->devolucionDineros->contains($devolucionDinero)) {
            $this->devolucionDineros[] = $devolucionDinero;
            $devolucionDinero->setGestor($this);
        }

        return $this;
    }

    public function removeDevolucionDinero(DevolucionDinero $devolucionDinero): self
    {
        if ($this->devolucionDineros->removeElement($devolucionDinero)) {
            if ($devolucionDinero->getGestor() === $this) {
                $devolucionDinero->setGestor(null);
            }
        }

        return $this;
    }

//      * @return Collection|Indemnizacion[]

    public function getIndemnizacions(): Collection
    {
        return $this->indemnizacions;
    }

    public function addIndemnizacion(Indemnizacion $indemnizacion): self
    {
        if (!$this->indemnizacions->contains($indemnizacion)) {
            $this->indemnizacions[] = $indemnizacion;
            $indemnizacion->setGestor($this);
        }

        return $this;
    }

    public function removeIndemnizacion(Indemnizacion $indemnizacion): self
    {
        if ($this->indemnizacions->removeElement($indemnizacion)) {
            if ($indemnizacion->getGestor() === $this) {
                $indemnizacion->setGestor(null);
            }
        }

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getDateJoined(): ?\DateTimeInterface
    {
        return $this->dateJoined;
    }

    public function setDateJoined(?\DateTimeInterface $dateJoined): self
    {
        $this->dateJoined = $dateJoined;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getIsStaff(): ?bool
    {
        return $this->isStaff;
    }

    public function setIsStaff(bool $isStaff): self
    {
        $this->isStaff = $isStaff;
        return $this;
    }

    public function getIsSuperuser(): ?bool
    {
        return $this->isSuperuser;
    }

    public function setIsSuperuser(bool $isSuperuser): self
    {
        $this->isSuperuser = $isSuperuser;
        return $this;
    }

    // Helper method from old class
    public function getNombreCompleto()
    {
        return $this->getNombre().' '.$this->getApellido();
    }
    
    public function __toString() {
        return (string) $this->getNombreCompleto();
    }
}
