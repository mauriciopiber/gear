<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\Controller\ControllerServiceTest;

trait ControllerTestServiceTrait
{
    protected $controllerTestService;

    public function getControllerTestService()
    {
        if (!isset($this->controllerTestService)) {
            $this->controllerTestService = $this->getServiceLocator()->get(ControllerServiceTest::class);
        }
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTest)
    {
        $this->controllerTestService = $controllerTest;
        return $this;
    }
}
