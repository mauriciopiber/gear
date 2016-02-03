<?php
namespace Gear\Mvc\Config;

trait ControllerTrait {

    protected $controllerConfig;

    public function getControllerConfig()
    {
        if (!isset($this->controllerConfig)) {
            $this->controllerConfig = $this->getServiceLocator()->get('Gear\Mvc\Config\Controller');
        }
        return $this->controllerConfig;
    }

    public function setControllerConfig($controller)
    {
        $this->controllerConfig = $controller;
        return $this;
    }
}
