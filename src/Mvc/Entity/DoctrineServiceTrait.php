<?php
namespace Gear\Mvc\Entity;

use Gear\Mvc\Entity\DoctrineService;

trait DoctrineServiceTrait
{
    protected $doctrineService;

    public function getDoctrineService()
    {
        return $this->doctrineService;
    }

    public function setDoctrineService(DoctrineService $doctrineService)
    {
        $this->doctrineService = $doctrineService;
        return $this;
    }
}
