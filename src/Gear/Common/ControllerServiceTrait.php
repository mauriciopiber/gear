<?php
namespace Gear\Common;

trait ControllerServiceTrait {

    protected $controllerService;

    public function getControllerService()
    {
        if (!isset($this->controllerService)) {
            $this->controllerService = $this->getServiceLocator()->get('controllerService');
        }
        return $this->controllerService;
    }

    public function setControllerService($controllerService)
    {
        $this->controllerService = $controllerService;
        return $this;
    }
}