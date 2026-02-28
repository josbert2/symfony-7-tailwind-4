<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'attendance_register_imageupload')]
 
class AttendanceRegisterImageupload
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(name: 'image_name', type: 'string', length: 255)]
    private $imageName;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'boolean')]
    private $validated = false;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }
}
