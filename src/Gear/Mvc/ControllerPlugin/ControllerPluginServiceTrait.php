<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Mvc\ControllerPlugin\ControllerPluginService;

trait ControllerPluginServiceTrait
{
    protected $controllerPluginService;

    public function getControllerPluginService()
    {
        if (!isset($this->controllerPluginService)) {
            $this->controllerPluginService = $this->getServiceLocator()->get(
                ControllerPluginService::class
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
