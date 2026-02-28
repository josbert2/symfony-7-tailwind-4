<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

    #[ORM\Entity]
    #[ORM\Table(name: 'item_loaded')]
//  * @Gedmo\Mapping\Annotation\SoftDeleteable(fieldName="deletedAt", timeAware=false)

class ItemLoaded
{
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Caja')]
    #[ORM\JoinColumn(nullable: true)]
    private $caja;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Item')]
//      * @ORM\JoinTable(name="item_loaded_items",
            joinColumns={#[ORM\JoinColumn(name: 'item_loaded_id', referencedColumnName: 'id')]},
            inverseJoinColumns={#[ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id')]}
//      * )

    private $items;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCaja()
    {
        return $this->caja;
    }

    public function setCaja($caja)
    {
        $this->caja = $caja;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function addItem(Item $item)
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }
    }

    public function removeItem(Item $item)
    {
        $this->items->removeElement($item);
    }

}
