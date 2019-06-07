<?php
namespace Gear\Mvc\Entity;

use Gear\Mvc\Entity\EntityService;

trait EntityServiceTrait
{
    protected $entityService;

    public function getEntityService()
    {
        return $this->entityService;
    }

    public function setEntityService(EntityService $entityService)
    {
        $this->entityService = $entityService;
        return $this;
    }
}
