<?php
namespace Gear\Mvc\Controller\Web;

use Gear\Mvc\Controller\Web\WebControllerTestService;

trait WebControllerTestServiceTrait
{
    protected $controllerTestService;

    public function getControllerTestService()
    {
        if (!isset($this->controllerTestService)) {
            $this->controllerTestService = $this->getServiceLocator()->get(WebControllerTestService::class);
        }
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTest)
    {
        $this->controllerTestService = $controllerTest;
        return $this;
    }
}
