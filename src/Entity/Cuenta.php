<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


    #[ORM\Entity]
 
class Cuenta
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titular;

    #[ORM\Column(type: 'string', length: 255)]
    private $banco;

    #[ORM\Column(type: 'string', length: 255)]
    private $tipo;

    #[ORM\Column(type: 'string', length: 255)]
    private $numero;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $rut;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\OneToOne(targetEntity: 'Proveedor', inversedBy: 'cuenta')]
    protected $proveedor;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ProveedorRut', mappedBy: 'cuenta')]
    protected $proveedorRut;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function __toString() {
        return $this->titular;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set titular.

//      * @param string $titular

//      * @return Cuenta

    public function setTitular($titular)
    {
        $this->titular = $titular;

        return $this;
    }

//      * Get titular.

//      * @return string

    public function getTitular()
    {
        return $this->titular;
    }

//      * Set banco.

//      * @param string $banco

//      * @return Cuenta

    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

//      * Get banco.

//      * @return string

    public function getBanco()
    {
        return $this->banco;
    }

//      * Set tipo.

//      * @param string $tipo

//      * @return Cuenta

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

//      * Get tipo.

//      * @return string

    public function getTipo()
    {
        return $this->tipo;
    }

//      * Set numero.

//      * @param string $numero

//      * @return Cuenta

    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

//      * Get numero.

//      * @return string

    public function getNumero()
    {
        return $this->numero;
    }

//      * Set rut.

//      * @param string $rut

//      * @return Cuenta

    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

//      * Get rut.

//      * @return string

    public function getRut()
    {
        return $this->rut;
    }

//      * Set email.

//      * @param string|null $email

//      * @return Cuenta

    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

//      * Get email.

//      * @return string|null

    public function getEmail()
    {
        return $this->email;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return Cuenta

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

//      * Get created.

//      * @return \DateTime

    public function getCreated()
    {
        return $this->created;
    }

//      * Set updated.

//      * @param \DateTime $updated

//      * @return Cuenta

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

//      * Get updated.

//      * @return \DateTime

    public function getUpdated()
    {
        return $this->updated;
    }

//      * Set proveedor.

//      * @param \App\Entity\Proveedor|null $proveedor

//      * @return Cuenta

    public function setProveedor(\App\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * Get proveedor.

//      * @return \App\Entity\Proveedor|null

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function getProveedorRut(): ?ProveedorRut
    {
        return $this->proveedorRut;
    }

    public function setProveedorRut(?ProveedorRut $proveedorRut): self
    {
        // unset the owning side of the relation if necessary
        if ($proveedorRut === null && $this->proveedorRut !== null) {
            $this->proveedorRut->setCuenta(null);
        }

        // set the owning side of the relation if necessary
        if ($proveedorRut !== null && $proveedorRut->getCuenta() !== $this) {
            $proveedorRut->setCuenta($this);
        }

        $this->proveedorRut = $proveedorRut;

        return $this;
    }
}
