<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: App\Repository\CustomFieldActivityRepository::class)]
    #[ORM\Table(name: 'login_customfieldactivity')]
class CustomFieldActivity
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

    #[ORM\ManyToOne(targetEntity: 'Actividad', inversedBy: 'customFieldActivity')]
    #[ORM\JoinColumn(nullable: false)]
    private $actividad;

    #[ORM\ManyToOne(targetEntity: 'CustomField', inversedBy: 'customFieldActivity')]
    #[ORM\JoinColumn(nullable: false)]
    private $customField;

    public function getId()
    {
        return $this->id;
    }

    public function getActividad()
    {
        return $this->actividad;
    }

    public function setActividad($actividad)
    {
        $this->actividad = $actividad;
        return $this;
    }

    public function getCustomField()
    {
        return $this->customField;
    }

    public function setCustomField($customField)
    {
        $this->customField = $customField;
        return $this;
    }
}
