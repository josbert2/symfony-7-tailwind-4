<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'attendance_register_enrolledimage')]
 
class AttendanceRegisterEnrolledimage
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\AttendanceRegisterImageupload')]
    #[ORM\JoinColumn(name: 'image_id', referencedColumnName: 'id', nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Staff')]
    #[ORM\JoinColumn(name: 'staff_id', referencedColumnName: 'id')]
    private $staff;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'boolean')]
    private $validated = false;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getStaff()
    {
        return $this->staff;
    }

    public function setStaff($staff)
    {
        $this->staff = $staff;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }
}
