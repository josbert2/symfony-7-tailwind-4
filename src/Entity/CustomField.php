<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


    #[ORM\Entity(repositoryClass: App\Repository\CustomFieldRepository::class)]
    #[ORM\Table(name: 'login_customfield')]
class CustomField
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]

    private $id;

    #[ORM\ManyToOne(targetEntity: 'Proveedor', inversedBy: 'customfield')]
    private $proveedor;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isRequired;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $question;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $visibleInTicket;

    #[ORM\OneToMany(targetEntity: 'CustomFieldOption', mappedBy: 'customField')]
    private $options;

    #[ORM\OneToMany(targetEntity: 'CustomFieldActivity', mappedBy: 'customField')]
    private $customFieldActivities;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->customFieldActivities = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getIsRequired()
    {
        return $this->isRequired;
    }

    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getVisibleInTicket()
    {
        return $this->visibleInTicket;
    }

    public function setVisibleInTicket($visibleInTicket)
    {
        $this->visibleInTicket = $visibleInTicket;
    }

    public function getOptions()
    {
        return $this->options;
    }
    
    public function addOption(CustomFieldOption $option)
    {
        $this->options[] = $option;
        $option->setCustomField($this);
        return $this;
    }
    
    public function removeOption(CustomFieldOption $option)
    {
        $this->options->removeElement($option);
    }

    public function getCustomFieldActivities()
    {
        return $this->customFieldActivities;
    }

    public function addCustomFieldActivity(CustomFieldActivity $activity)
    {
        $this->customFieldActivities[] = $activity;
        $activity->setCustomField($this);
    }

    public function removeCustomFieldActivity(CustomFieldActivity $activity)
    {
        $this->customFieldActivities->removeElement($activity);
    }
}
