<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Mvc\ControllerPlugin\ControllerPluginTestService;

trait ControllerPluginTestServiceTrait
{
    protected $controllerPluginTestService;

    public function getControllerPluginTestService()
    {
        return $this->controllerPluginTestService;
    }

    public function setControllerPluginTestService($controllerTest)
    {
        $this->controllerPluginTestService = $controllerTest;
        return $this;
    }
}
