<?php
namespace Gear\Mvc\Config;

trait ControllerPluginManagerTrait {

    protected $controllerPlugin;

    public function getControllerPluginManager()
    {
        if (!isset($this->controllerPlugin)) {
            $this->controllerPlugin = $this->getServiceLocator()->get('Gear\Mvc\Config\ControllerPluginManager');
        }
        return $this->controllerPlugin;
    }

    public function setControllerPluginManager($controllerPlugin)
    {
        $this->controllerPlugin = $controllerPlugin;
        return $this;
    }
}
