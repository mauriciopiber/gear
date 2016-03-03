<?php
namespace Gear\Mvc\Entity;

use Gear\Mvc\Entity\EntityService;

trait EntityServiceTrait
{
    protected $entityService;

    public function getEntityService()
    {
        if (!isset($this->entityService)) {
            $this->entityService = $this->getServiceLocator()->get('Gear\Mvc\Entity\EntityService');
        }
        return $this->entityService;
    }

    public function setEntityService(EntityService $entityService)
    {
        $this->entityService = $entityService;
        return $this;
    }
}
