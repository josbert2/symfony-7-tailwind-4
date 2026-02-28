<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


    #[ORM\Entity]
    #[ORM\Table(name: 'promotions_promotionlist')]
 
class PromocionLista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'promocionListas')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: true)]
    private $proveedor;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $deleted;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateExpired;

    #[ORM\OneToMany(targetEntity: 'PromocionListaCodigo', mappedBy: 'promocionLista')]
    private $promocionListaCodigos;

    #[ORM\OneToMany(targetEntity: 'PromocionListaGrupo', mappedBy: 'promocionLista')]
    private $promocionListaGrupos;

    public function __construct()
    {
        $this->deleted = null;
        $this->dateExpired = null;
        $this->promocionListaCodigos = new ArrayCollection();
        $this->promocionListaGrupos = new ArrayCollection();
    }

    public function getId() { 
        return $this->id;
    }

    public function getName() { 
        return $this->name;
    }

    public function setName($name) { 
        $this->name = $name;
    }

    public function getClient() { 
        return $this->client;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function getDateExpired() {
        return $this->dateExpired;
    }

    public function setDateExpired($dateExpired) {
        $this->dateExpired = $dateExpired;
    }

    public function setProveedor($proveedor){
        $this->proveedor = $proveedor;
    }

    public function getProveedor(){
        return $this->proveedor;
    }

    public function getPromocionListaCodigos(): Collection
    {
        return $this->promocionListaCodigos->filter(function (PromocionListaCodigo $code) {
            return $code->getDeleted() === null;
        );
    }

    public function getAllPromocionListaCodigos(): Collection
    {
        return $this->promocionListaCodigos;
    }

    public function addPromocionListaCodigos(PromocionListaCodigo $promotionListCode): self
    {
        if (!$this->promocionListaCodigos->contains($promocionListaCodigos)) {
            $this->promocionListaCodigos[] = $promocionListaCodigos;
            $promocionListaCodigos->setPromocionLista($this);
        }

        return $this;
    }

    public function getPromocionListaGrupos(): Collection
    {
        return $this->promocionListaGrupos;
    }

    public function addPromocionListaCodigo(PromocionListaCodigo $promocionListaCodigo): self
    {
        if (!$this->promocionListaCodigos->contains($promocionListaCodigo)) {
            $this->promocionListaCodigos[] = $promocionListaCodigo;
            $promocionListaCodigo->setPromocionLista($this);
        }

        return $this;
    }

    public function removePromocionListaCodigo(PromocionListaCodigo $promocionListaCodigo): self
    {
        if ($this->promocionListaCodigos->removeElement($promocionListaCodigo)) {
            // set the owning side to null (unless already changed)
            if ($promocionListaCodigo->getPromocionLista() === $this) {
                $promocionListaCodigo->setPromocionLista(null);
            }
        }

        return $this;
    }

    public function addPromocionListaGrupo(PromocionListaGrupo $promocionListaGrupo): self
    {
        if (!$this->promocionListaGrupos->contains($promocionListaGrupo)) {
            $this->promocionListaGrupos[] = $promocionListaGrupo;
            $promocionListaGrupo->setPromocionLista($this);
        }

        return $this;
    }

    public function removePromocionListaGrupo(PromocionListaGrupo $promocionListaGrupo): self
    {
        if ($this->promocionListaGrupos->removeElement($promocionListaGrupo)) {
            // set the owning side to null (unless already changed)
            if ($promocionListaGrupo->getPromocionLista() === $this) {
                $promocionListaGrupo->setPromocionLista(null);
            }
        }

        return $this;
    }
}
