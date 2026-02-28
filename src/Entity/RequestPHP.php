<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'logger_requestphp')]
 
class RequestPHP
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $url;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $host;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $responseTime;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $status;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $clientIp;

    #[ORM\Column(type: 'string', length: 250, nullable: true)]
    private $userAgent;

    #[ORM\Column(type: 'string', length: 250, nullable: true)]
    private $referer;

    #[ORM\Column(type: 'datetime')]
    private $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }   

    public function getHost()
    {
        return $this->host;
    }

    public function getResponseTime()
    {
        return $this->responseTime;
    }

    public function getStatus()
    {
        return $this->status;
    }   

    public function getClientIp()
    {
        return $this->clientIp;
    }   

    public function getUserAgent()
    {
        return $this->userAgent;
    }   

    public function getReferer()
    {
        return $this->referer;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function setReferer($referer)
    {
        $this->referer = $referer;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }
    
}
