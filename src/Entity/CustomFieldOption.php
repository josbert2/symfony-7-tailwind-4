<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'login_customfieldoption')]
 
class CustomFieldOption
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

//      * Relación con CustomField

    #[ORM\ManyToOne(targetEntity: 'CustomField', inversedBy: 'options')]
    #[ORM\JoinColumn(nullable: false)]
    private $customField;

    #[ORM\Column(type: 'string', length: 255)]
    private $option;

    
    public function getId()
    {
        return $this->id;
    }

    public function getCustomField()
    {
        return $this->customField;
    }

    public function setCustomField(CustomField $customField = null)
    {
        $this->customField = $customField;
        return $this;
    }

    public function getOption()
    {
        return $this->option;
    }

    public function setOption(string $option)
    {
        $this->option = $option;
        return $this;
    }
}
