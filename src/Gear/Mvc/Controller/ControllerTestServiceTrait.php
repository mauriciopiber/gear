<?php
namespace Gear\Mvc\Controller;

trait ControllerTestServiceTrait
{
    protected $controllerTestService;

    public function getControllerTestService()
    {
        if (!isset($this->controllerTestService)) {
            $this->controllerTestService = $this->getServiceLocator()->get('Gear\Mvc\Controller\ControllerTest');
        }
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTest)
    {
        $this->controllerTestService = $controllerTest;
        return $this;
    }
}
