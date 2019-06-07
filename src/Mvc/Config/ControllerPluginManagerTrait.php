<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ControllerPluginManager;

trait ControllerPluginManagerTrait
{
    protected $controllerPlugin;

    public function getControllerPluginManager()
    {
        return $this->controllerPlugin;
    }

    public function setControllerPluginManager($controllerPlugin)
    {
        $this->controllerPlugin = $controllerPlugin;
        return $this;
    }
}
