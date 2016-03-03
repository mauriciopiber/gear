<?php
namespace Gear\Mvc\Entity;

use Gear\Mvc\Entity\EntityTestService;

trait EntityTestServiceTrait
{
    protected $entityTestService;

    public function getEntityTestService()
    {
        if (! isset($this->entityTestService)) {
            $this->entityTestService = $this->getServiceLocator()->get('Gear\Mvc\Entity\EntityTestService');
        }
        return $this->entityTestService;
    }

    public function setEntityTestService(EntityTestService $entityTestService)
    {
        $this->entityTestService = $entityTestService;
        return $this;
    }
}
