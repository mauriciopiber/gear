<?php
namespace Gear\Mvc\Entity;

use Gear\Mvc\Entity\DoctrineService;

trait DoctrineServiceTrait
{
    protected $doctrineService;

    public function getDoctrineService()
    {
        if (!isset($this->doctrineService)) {
            $this->doctrineService = $this->getServiceLocator()->get(DoctrineService::class);
        }
        return $this->doctrineService;
    }

    public function setDoctrineService(DoctrineService $doctrineService)
    {
        $this->doctrineService = $doctrineService;
        return $this;
    }
}
