<?php
namespace Gear\Mvc\Controller;

trait ControllerTestServiceTrait
{
    protected $controllerTestService;

    public function getControllerTestService()
    {
        if (!isset($this->controllerTestService)) {
            $this->controllerTestService = $this->getServiceLocator()->get('controllerTestService');
        }
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTestService)
    {
        $this->controllerTestService = $controllerTestService;
        return $this;
    }
}
