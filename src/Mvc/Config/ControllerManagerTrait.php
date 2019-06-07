<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ControllerManager;

trait ControllerManagerTrait
{
    protected $controllerConfig;

    public function getControllerManager()
    {
        return $this->controllerConfig;
    }

    public function setControllerManager($controller)
    {
        $this->controllerConfig = $controller;
        return $this;
    }
}
