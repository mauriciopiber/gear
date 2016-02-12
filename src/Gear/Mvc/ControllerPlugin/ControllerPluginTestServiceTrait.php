<?php
namespace Gear\Mvc\ControllerPlugin;

trait ControllerPluginTestServiceTrait
{
    protected $controllerPluginTestService;

    public function getControllerPluginTestService()
    {
        if (!isset($this->controllerPluginTestService)) {
            $this->controllerPluginTestService = $this->getServiceLocator()->get('Gear\Mvc\ControllerPlugin\ControllerPluginTest');
        }
        return $this->controllerPluginTestService;
    }

    public function setControllerPluginTestService($controllerPluginTestService)
    {
        $this->controllerPluginTestService = $controllerPluginTestService;
        return $this;
    }
}
