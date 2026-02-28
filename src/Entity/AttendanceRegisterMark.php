<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'attendance_register_mark')]
    #[ORM\Entity(repositoryClass: App\Repository\AttendanceRegisterMarkRepository::class)]
 
class AttendanceRegisterMark
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

    #[ORM\Column(type: 'datetime')]
    private $created;

    #[ORM\Column(type: 'string', length: 55)]
    private $type; // "entry" o "exit"

    #[ORM\Column(type: 'boolean')]
    private $validated = false;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Staff')]
    #[ORM\JoinColumn(nullable: false)]
    private $staff;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\AttendanceRegisterImageupload')]
    #[ORM\JoinColumn(nullable: true)]
    private $image;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function getLinkPublic(): ?string
    {
        if (!$this->image || !$this->image->getImageName()) {
            return null;
        }

        $region = 'us-east-1';
        $bucket = 'images-attendance';
        $key = ltrim($this->image->getImageName(), '/');

        return sprintf('https://%s.s3.%s.amazonaws.com/%s', $bucket, $region, $key);
    }

    public function getStaff()
    {
        return $this->staff;
    }

    public function setStaff($staff)
    {
        $this->staff = $staff;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getValidated()
    {
        return $this->validated;
    }

    public function setValidated($validated)
    {
        $this->validated = $validated;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getCreatedFormat(): string
    {
        return $this->created ? $this->created->format('d-m-Y H:i') : '';
    }
    
    public function getTypeFormat(): string
    {
        switch ($this->type) {
            case 'entry':
                return 'Entrada';
            case 'exit':
                return 'Salida';
            default:
                return '';
        }
    }

    public function getValidatedFormat(): string
    {
        return $this->validated ? 'Valida' : 'No valida';
    }
}
