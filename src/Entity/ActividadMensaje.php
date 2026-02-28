<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

    #[ORM\Table(name: 'actividad_mensaje')]
    #[ORM\Entity(repositoryClass: App\Repository\ActividadMensajeRepository::class)]
class ActividadMensaje
{

//      * @var int

    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]

    private $id;

//      * @var string|null

    #[ORM\Column(name: 'mensaje_correo', type: 'text', nullable: true)]

    private $mensajeCorreo;

    #[ORM\ManyToOne(targetEntity: 'Market', inversedBy: 'actividadMensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private $market;

    #[ORM\ManyToOne(targetEntity: 'Actividad')]
    #[ORM\JoinColumn(nullable: false)]
    private $actividad;

//      * Get id.

//      * @return int

    public function getId()
    {
        return $this->id;
    }

//      * Set mensajeCorreo.

//      * @param string|null $mensajeCorreo

//      * @return ActividadMensaje

    public function setMensajeCorreo($mensajeCorreo = null)
    {
        $this->mensajeCorreo = $mensajeCorreo;

        return $this;
    }

//      * Get mensajeCorreo.

//      * @return string|null

    public function getMensajeCorreo()
    {
        return $this->mensajeCorreo;
    }

//      * Set market.

//      * @param \App\Entity\Market $market

//      * @return ActividadMensaje

    public function setMarket(\App\Entity\Market $market)
    {
        $this->market = $market;

        return $this;
    }

//      * Get market.

//      * @return \App\Entity\Market

    public function getMarket()
    {
        return $this->market;
    }

//      * Set actividad.

//      * @param \App\Entity\Actividad $actividad

//      * @return ActividadMensaje

    public function setActividad(\App\Entity\Actividad $actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

//      * Get actividad.

//      * @return \App\Entity\Actividad

    public function getActividad()
    {
        return $this->actividad;
    }
}
