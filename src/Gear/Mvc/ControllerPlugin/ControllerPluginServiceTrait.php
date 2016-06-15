<?php
namespace Gear\Mvc\ControllerPlugin;

trait ControllerPluginServiceTrait
{
    protected $controllerPluginService;

    public function getControllerPluginService()
    {
        if (!isset($this->controllerPluginService)) {
            $this->controllerPluginService = $this->getServiceLocator()->get(
                'Gear\Mvc\ControllerPlugin\ControllerPlugin'
            );
        }
        return $this->controllerPluginService;
    }

    public function setControllerPluginService($controllerPlugin)
    {
        $this->controllerPluginService = $controllerPlugin;
        return $this;
    }
}
