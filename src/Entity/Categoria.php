<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OrderBy;

    #[ORM\Entity(repositoryClass: App\Repository\CategoriaRepository::class)]
class Categoria
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $icono;

    #[ORM\Column(type: 'integer')]
    private $lvl;

    #[ORM\ManyToOne(targetEntity: 'Categoria')]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected $root;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orden;

    #[ORM\Column(type: 'boolean')]
    private $activo = true;

    #[ORM\Column(type: 'json', nullable: true)]
    private $slugs;

    #[Gedmo\Slug()]
    #[ORM\Column(length: 128, unique: true)]
    private $slug;

    #[ORM\ManyToOne(targetEntity: 'Categoria', inversedBy: 'categorias')]
    protected $categoria;

    #[ORM\OneToMany(targetEntity: 'Actividad', mappedBy: 'categoria')]
    protected $actividadesPrincipales;

    
    #[ORM\OneToMany(targetEntity: 'App\Entity\Categoria', mappedBy: 'categoria')]
//      * @OrderBy({"orden" = "ASC")

    protected $categorias;

    #[ORM\OneToMany(targetEntity: 'App\Entity\Atributo', mappedBy: 'categoria')]
    protected $atributos;

    #[ORM\ManyToMany(targetEntity: 'Market', mappedBy: 'categorias')]
    protected $markets;

    #[ORM\ManyToMany(targetEntity: 'Market', mappedBy: 'categoriasDestacadas')]
    protected $marketsDestacados;

    #[ORM\ManyToMany(targetEntity: 'Actividad', mappedBy: 'categorias')]
    protected $actividades;
    
    #[ORM\ManyToMany(targetEntity: 'Promocion', mappedBy: 'categorias')]
    protected $promociones;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(type: 'datetime')]
    protected $updated;

    public function __construct()
    {
        $this->actividadesPrincipales = new ArrayCollection();
        $this->markets = new ArrayCollection();
        $this->actividades = new ArrayCollection();
        $this->promociones = new ArrayCollection();
        $this->categorias = new ArrayCollection();
        $this->atributos = new ArrayCollection();
        $this->multivendeMaps = new ArrayCollection();
        $this->marketsDestacados = new ArrayCollection();
    }

    public function getIds()
    {
        $exit = false;
        $ids = [];

        $categoria = $this;
        $i = 0;
        while(!$exit){
            $i++;
            $ids[] = $categoria->getId();
            $categoria = $categoria->getCategoria();
            if(!$categoria || $i > 10){
                $exit = true;
            }
        }

        return array_reverse($ids);
    }

    public function getSlugsArray()
    {
        $exit = false;
        $slugs = [];

        $categoria = $this;
        $i = 0;
        while(!$exit){
            $i++;
            $slugs[] = $categoria->getSlug();
            $categoria = $categoria->getCategoria();
            if(!$categoria || $i > 10){
                $exit = true;
            }
        }

        $idx = 0;
        $rSlugs = [];
        foreach(array_reverse($slugs) as $slug){
            $rSlugs['categoria'.$idx] = $slug;
            $idx++;
        }

        return $rSlugs;
    }

    public function getNombresArray()
    {
        $exit = false;
        $nombres = [];

        $categoria = $this;
        $i = 0;
        while(!$exit){
            $i++;
            $nombres[] = $categoria->getNombre();
            $categoria = $categoria->getCategoria();
            if(!$categoria || $i > 10){
                $exit = true;
            }
        }

        return array_reverse($nombres);
    }

    public function getCategoriaId()
    {
        if($this->getCategoria()){
            return $this->getCategoria()->getId();
        }
    }

    public function __toString() {
        return $this->nombre;
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

    public function getIcono(): ?string
    {
        return $this->icono;
    }

    public function setIcono(?string $icono): self
    {
        $this->icono = $icono;

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

//      * @return Collection|Actividad[]
     
    public function getActividadesPrincipales(): Collection
    {
        return $this->actividadesPrincipales;
    }

    public function addActividadesPrincipale(Actividad $actividadesPrincipale): self
    {
        if (!$this->actividadesPrincipales->contains($actividadesPrincipale)) {
            $this->actividadesPrincipales[] = $actividadesPrincipale;
            $actividadesPrincipale->setCategoria($this);
        }

        return $this;
    }

    public function removeActividadesPrincipale(Actividad $actividadesPrincipale): self
    {
        if ($this->actividadesPrincipales->contains($actividadesPrincipale)) {
            $this->actividadesPrincipales->removeElement($actividadesPrincipale);
            // set the owning side to null (unless already changed)
            if ($actividadesPrincipale->getCategoria() === $this) {
                $actividadesPrincipale->setCategoria(null);
            }
        }

        return $this;
    }

//      * @return Collection|Market[]

    public function getMarkets(): Collection
    {
        return $this->markets;
    }

    public function addMarket(Market $market): self
    {
        if (!$this->markets->contains($market)) {
            $this->markets[] = $market;
            $market->addCategoria($this);
        }

        return $this;
    }

    public function removeMarket(Market $market): self
    {
        if ($this->markets->contains($market)) {
            $this->markets->removeElement($market);
            $market->removeCategoria($this);
        }

        return $this;
    }

//      * @return Collection|Actividad[]

    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividad $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->addCategoria($this);
        }

        return $this;
    }

    public function removeActividade(Actividad $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
            $actividade->removeCategoria($this);
        }

        return $this;
    }

//      * @return Collection|Promocion[]

    public function getPromociones(): Collection
    {
        return $this->promociones;
    }

    public function addPromocione(Promocion $promocione): self
    {
        if (!$this->promociones->contains($promocione)) {
            $this->promociones[] = $promocione;
            $promocione->addCategoria($this);
        }

        return $this;
    }

    public function removePromocione(Promocion $promocione): self
    {
        if ($this->promociones->contains($promocione)) {
            $this->promociones->removeElement($promocione);
            $promocione->removeCategoria($this);
        }

        return $this;
    }

    public function getCategoria(): ?self
    {
        return $this->categoria;
    }

    public function setCategoria(?self $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

//      * @return Collection|Categoria[]

    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
            $categoria->setCategoria($this);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->contains($categoria)) {
            $this->categorias->removeElement($categoria);
            // set the owning side to null (unless already changed)
            if ($categoria->getCategoria() === $this) {
                $categoria->setCategoria(null);
            }
        }

        return $this;
    }

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setRoot(?self $root): self
    {
        $this->root = $root;

        return $this;
    }

//      * @return Collection|Atributo[]

    public function getAtributos(): Collection
    {
        return $this->atributos;
    }

    public function addAtributo(Atributo $atributo): self
    {
        if (!$this->atributos->contains($atributo)) {
            $this->atributos[] = $atributo;
            $atributo->setCategoria($this);
        }

        return $this;
    }

    public function removeAtributo(Atributo $atributo): self
    {
        if ($this->atributos->contains($atributo)) {
            $this->atributos->removeElement($atributo);
            // set the owning side to null (unless already changed)
            if ($atributo->getCategoria() === $this) {
                $atributo->setCategoria(null);
            }
        }

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlugs(): ?array
    {
        return $this->slugs;
    }

    public function setSlugs(?array $slugs): self
    {
        $this->slugs = $slugs;

        return $this;
    }

//      * @return Collection|Market[]

    public function getMarketsDestacados(): Collection
    {
        return $this->marketsDestacados;
    }

    public function addMarketsDestacado(Market $marketsDestacado): self
    {
        if (!$this->marketsDestacados->contains($marketsDestacado)) {
            $this->marketsDestacados[] = $marketsDestacado;
            $marketsDestacado->addCategoriasDestacada($this);
        }

        return $this;
    }

    public function removeMarketsDestacado(Market $marketsDestacado): self
    {
        if ($this->marketsDestacados->removeElement($marketsDestacado)) {
            $marketsDestacado->removeCategoriasDestacada($this);
        }

        return $this;
    }

}
