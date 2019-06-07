<?php
namespace Gear\Mvc\ControllerPlugin;

use Gear\Mvc\ControllerPlugin\ControllerPluginService;

trait ControllerPluginServiceTrait
{
    protected $controllerPluginService;

    public function getControllerPluginService()
    {
        return $this->controllerPluginService;
    }

    public function setControllerPluginService($controllerPlugin)
    {
        $this->controllerPluginService = $controllerPlugin;
        return $this;
    }
}
