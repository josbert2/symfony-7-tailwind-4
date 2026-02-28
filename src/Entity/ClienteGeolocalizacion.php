<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
//  * @ORM\HasLifecycleCallbacks()

class ClienteGeolocalizacion
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
     
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    private $commune;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'boolean')]
    private $fallback;

    #[ORM\Column(type: 'string', length: 512)]
    private $fullAddress;

    #[ORM\Column(type: 'float')]
    private $latitude;

    #[ORM\Column(type: 'float')]
    private $longitude;

    #[ORM\Column(type: 'string', length: 255)]
    private $region;

    #[ORM\Column(type: 'bigint')]
    private $timestamp;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Cliente', inversedBy: 'geolocalizaciones')]
    #[ORM\JoinColumn(nullable: false)]
    private $cliente;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;


    public function getId()
    {
        return $this->id;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCommune()
    {
        return $this->commune;
    }

    public function setCommune($commune)
    {
        $this->commune = $commune;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getFallback()
    {
        return $this->fallback;
    }

    public function setFallback($fallback)
    {
        $this->fallback = $fallback;
    }

    public function getFullAddress()
    {
        return $this->fullAddress;
    }

    public function setFullAddress($fullAddress)
    {
        $this->fullAddress = $fullAddress;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

//      * @ORM\PrePersist

    public function onPrePersist()
    {
        $this->updatedAt = new \DateTime();
    }

//      * @ORM\PreUpdate

    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
