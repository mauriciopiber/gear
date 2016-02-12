<?php
namespace Gear\Mvc\Config;

trait ControllerManagerTrait
{
    protected $controllerConfig;

    public function getControllerManager()
    {
        if (!isset($this->controllerConfig)) {
            $this->controllerConfig = $this->getServiceLocator()->get('Gear\Mvc\Config\Controller');
        }
        return $this->controllerConfig;
    }

    public function setControllerManager($controller)
    {
        $this->controllerConfig = $controller;
        return $this;
    }
}
