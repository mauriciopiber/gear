<?php
namespace Gear\Mvc\ValueObject;

use Gear\Mvc\ValueObject\ValueObjectService;

trait ValueObjectServiceTrait
{
    protected $valueObjectService;

    public function getValueObjectService()
    {
        if (!isset($this->valueObjectService)) {
            $this->valueObjectService = $this->getServiceLocator()->get(ValueObjectService::class);
        }
        return $this->valueObjectService;
    }

    public function setValueObjectService($valueObjectService)
    {
        $this->valueObjectService = $valueObjectService;
        return $this;
    }
}
