<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\Controller\ControllerTestService;

trait ControllerTestServiceTrait
{
    protected $controllerTestService;

    public function getControllerTestService()
    {
        if (!isset($this->controllerTestService)) {
            $this->controllerTestService = $this->getServiceLocator()->get(ControllerTestService::class);
        }
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTest)
    {
        $this->controllerTestService = $controllerTest;
        return $this;
    }
}
