<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'metodos_pagos_bsale')]
 
class MetodoPagoBsale
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Proveedor')]
    #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id', nullable: true)]
    private $proveedor;

    #[ORM\Column(type: 'string', nullable: true)]
    private $name;

    #[ORM\Column(name: 'bsale_id', type: 'integer', nullable: true)]
    private $bsaleId;

    public function getProveedor() { return $this->proveedor; }
    public function getName() { return $this->name; }
    public function getBsaleId() { return $this->bsaleId; }
}
