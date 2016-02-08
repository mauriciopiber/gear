<?php
namespace Gear\Mvc\ValueObject;

trait ValueObjectServiceTrait {

    protected $valueObjectService;

    public function getValueObjectService()
    {
        if (!isset($this->valueObjectService)) {
            $this->valueObjectService = $this->getServiceLocator()->get('valueObjectService');
        }
        return $this->valueObjectService;
    }

    public function setValueObjectService($valueObjectService)
    {
        $this->valueObjectService = $valueObjectService;
        return $this;
    }
}