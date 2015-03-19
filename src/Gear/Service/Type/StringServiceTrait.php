<?php
namespace Gear\Service\Type;

trait StringServiceTrait {

    protected $stringService;

    public function getStringService()
    {
        if (!isset($this->stringService)) {
            $this->stringService = $this->getServiceLocator()->get('stringService');
        }
        return $this->stringService;
    }

    public function setStringService($stringService)
    {
        $this->stringService = $stringService;
        return $this;
    }
}
