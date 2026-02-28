<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


    #[ORM\Entity]
    #[ORM\Table(name: 'csp_report')]
 
class CspReport
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $url;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $type;

    #[ORM\Column(type: 'json')]
    private $report;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId() { return $this->id; }

    public function getUrl() { return $this->url; }
    public function setUrl(?string $url) { $this->url = $url; return $this; }

    public function getType() { return $this->type; }
    public function setType(?string $type) { $this->type = $type; return $this; }

    public function getReport() { return $this->report; }
    public function setReport(array $report) { $this->report = $report; return $this; }

    public function getCreatedAt() { return $this->createdAt; }
}
