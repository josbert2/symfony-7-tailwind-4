<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


    #[ORM\Entity(repositoryClass: App\Repository\VichFileRepository::class)]
//  * @Vich\Uploadable()

class VichFile
{
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fileName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $originalName;

//      * @var File
//      * @Vich\UploadableField(mapping="vich_file", fileNameProperty="fileName")

    private $file;

    #[ORM\OneToOne(targetEntity: 'Usuario', mappedBy: 'imagen')]
    protected $usuario;

    #[ORM\OneToOne(targetEntity: 'Nino', mappedBy: 'imagen')]
    protected $nino;

    #[ORM\OneToOne(targetEntity: 'Cuidador', mappedBy: 'imagen')]
    protected $cuidador;

    #[ORM\OneToMany(targetEntity: 'App\Entity\ActividadFoto', mappedBy: 'imagen')]
    protected $actividadFotos;

    #[ORM\OneToOne(targetEntity: 'Proveedor', mappedBy: 'logo')]
    protected $proveedor;

    #[ORM\OneToOne(targetEntity: 'Proveedor', mappedBy: 'foto')]
    protected $proveedorFoto;

    #[ORM\OneToOne(targetEntity: 'App\Entity\ProveedorArchivo', mappedBy: 'archivo')]
    protected $proveedorArchivo;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Market', mappedBy: 'imagenRRSS')]
    protected $marketImagenRRSS;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Market', mappedBy: 'logo')]
    protected $marketLogo;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Banner', mappedBy: 'imagenWeb')]
    protected $bannerWeb;

    #[ORM\OneToOne(targetEntity: 'App\Entity\Banner', mappedBy: 'imagenMobile')]
    protected $bannerMobile;

    #[ORM\OneToOne(targetEntity: 'Mapa', mappedBy: 'imagen')]
    protected $mapa;

    #[ORM\OneToOne(targetEntity: 'Zona', mappedBy: 'imagen')]
    protected $zona;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(type: 'datetime')]
    protected $created;

    #[ORM\Column(type: 'datetime')]
    protected $updatedAt;

    public function __construct()
    {
        $this->actividadFotos = new ArrayCollection();
    }

    public function getRelativePath()
    {
        return $this->getClass().'/'.$this->fileName;
    }

    public function getS3RelativePath()
    {
        return 'vich_files/' . $this->getRelativePath();
    }

    public function getClass()
    {
        $class = 'default';
        if($this->usuario){
            $class = 'usuario';
        }
        elseif($this->nino){
            $class = 'nino';
        }
        elseif($this->cuidador){
            $class = 'cuidador';
        }
        elseif($this->proveedorArchivo){
            $class = 'proveedorarchivo';
        }
        elseif($this->getActividadFotos()->count() > 0){
            $class = 'actividadfoto';
        }
        elseif($this->proveedor){
            $class = 'proveedorlogo';
        }
        elseif($this->proveedorFoto){
            $class = 'proveedorfoto';
        }
        elseif($this->mapa){
            $class = 'mapa';
        }
        elseif($this->zona){
            $class = 'zona';
        }
        elseif($this->marketImagenRRSS){
            $class = 'market';
        }
        elseif($this->marketLogo){
            $class = 'market';
        }
        elseif($this->bannerWeb){
            $class = 'banner';
        }
        elseif($this->bannerMobile){
            $class = 'banner';
        }

        return $class;
    }

//      * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
//      * of 'UploadedFile' is injected into this setter to trigger the  update. If this
//      * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
//      * must be able to accept an instance of 'File' as the bundle will inject one here
//      * during Doctrine hydration.

//      * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image

    public function setFile(File $file = null)
    {
        $this->file = $file;

        if (null !== $file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getFile()
    {
        return $this->file;
    }

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set fileName.

//      * @param string|null $fileName

//      * @return VichFile

    public function setFileName($fileName = null)
    {
        $this->fileName = $fileName;

        return $this;
    }

//      * Get fileName.

//      * @return string|null

    public function getFileName()
    {
        return $this->fileName;
    }

//      * Set created.

//      * @param \DateTime $created

//      * @return VichFile

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

//      * Set updatedAt.

//      * @param \DateTime $updatedAt

//      * @return VichFile

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

//      * Get updatedAt.

//      * @return \DateTime

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

//      * Set usuario.

//      * @param \App\Entity\Usuario|null $usuario

//      * @return VichFile

    public function setUsuario(\App\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

//      * Get usuario.

//      * @return \App\Entity\Usuario|null

    public function getUsuario()
    {
        return $this->usuario;
    }

//      * Set nino.

//      * @param \App\Entity\Nino|null $nino

//      * @return VichFile

    public function setNino(\App\Entity\Nino $nino = null)
    {
        $this->nino = $nino;

        return $this;
    }

//      * Get nino.

//      * @return \App\Entity\Nino|null

    public function getNino()
    {
        return $this->nino;
    }

//      * Set cuidador.

//      * @param \App\Entity\Cuidador|null $cuidador

//      * @return VichFile

    public function setCuidador(\App\Entity\Cuidador $cuidador = null)
    {
        $this->cuidador = $cuidador;

        return $this;
    }

//      * Get cuidador.

//      * @return \App\Entity\Cuidador|null

    public function getCuidador()
    {
        return $this->cuidador;
    }

//      * Set proveedor

//      * @param \App\Entity\Proveedor $proveedor

//      * @return VichFile

    public function setProveedor(\App\Entity\Proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

//      * Get proveedor

//      * @return \App\Entity\Proveedor

    public function getProveedor()
    {
        return $this->proveedor;
    }

//      * Set proveedorFoto.

//      * @param \App\Entity\Proveedor|null $proveedorFoto

//      * @return VichFile

    public function setProveedorFoto(\App\Entity\Proveedor $proveedorFoto = null)
    {
        $this->proveedorFoto = $proveedorFoto;

        return $this;
    }

//      * Get proveedorFoto.

//      * @return \App\Entity\Proveedor|null

    public function getProveedorFoto()
    {
        return $this->proveedorFoto;
    }

    public function getMapa(): ?Mapa
    {
        return $this->mapa;
    }

    public function setMapa(?Mapa $mapa): self
    {
        $this->mapa = $mapa;

        return $this;
    }

    public function getZona(): ?Zona
    {
        return $this->zona;
    }

    public function setZona(?Zona $zona): self
    {
        $this->zona = $zona;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getProveedorArchivo(): ?ProveedorArchivo
    {
        return $this->proveedorArchivo;
    }

    public function setProveedorArchivo(?ProveedorArchivo $proveedorArchivo): self
    {
        $this->proveedorArchivo = $proveedorArchivo;

        return $this;
    }

//      * @return Collection|ActividadFoto[]
     
    public function getActividadFotos(): Collection
    {
        return $this->actividadFotos;
    }

    public function addActividadFoto(ActividadFoto $actividadFoto): self
    {
        if (!$this->actividadFotos->contains($actividadFoto)) {
            $this->actividadFotos[] = $actividadFoto;
//            $actividadFoto->setImagen($this);
        }

        return $this;
    }

    public function removeActividadFoto(ActividadFoto $actividadFoto): self
    {
        if ($this->actividadFotos->contains($actividadFoto)) {
            $this->actividadFotos->removeElement($actividadFoto);
            // set the owning side to null (unless already changed)
            if ($actividadFoto->getImagen() === $this) {
                $actividadFoto->setImagen(null);
            }
        }

        return $this;
    }

    public function getMarketImagenRRSS(): ?Market
    {
        return $this->marketImagenRRSS;
    }

    public function setMarketImagenRRSS(?Market $marketImagenRRSS): self
    {
        $this->marketImagenRRSS = $marketImagenRRSS;

        return $this;
    }

    public function getMarketLogo(): ?Market
    {
        return $this->marketLogo;
    }

    public function setMarketLogo(?Market $marketLogo): self
    {
        $this->marketLogo = $marketLogo;

        return $this;
    }

    public function getBannerWeb(): ?Banner
    {
        return $this->bannerWeb;
    }

    public function setBannerWeb(?Banner $bannerWeb): self
    {
        $this->bannerWeb = $bannerWeb;

        return $this;
    }

    public function getBannerMobile(): ?Banner
    {
        return $this->bannerMobile;
    }

    public function setBannerMobile(?Banner $bannerMobile): self
    {
        $this->bannerMobile = $bannerMobile;

        return $this;
    }
}
