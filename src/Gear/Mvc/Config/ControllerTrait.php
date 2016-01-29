<?php
namespace Gear\Mvc\Config;

trait ControllerTrait {

    protected $controllerConfig;

    public function getController()
    {
        if (!isset($this->controllerConfig)) {
            $this->controllerConfig = $this->getServiceLocator()->get('Gear\Mvc\Config\Controller');
        }
        return $this->controllerConfig;
    }

    public function setController($controller)
    {
        $this->controllerConfig = $controller;
        return $this;
    }
}
