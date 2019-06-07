<?php
namespace Gear\Mvc\Controller\Web;

use Gear\Mvc\Controller\Web\WebControllerTestService;

trait WebControllerTestServiceTrait
{
    protected $controllerTestService;

    public function getControllerTestService()
    {
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTest)
    {
        $this->controllerTestService = $controllerTest;
        return $this;
    }
}
