<?php
namespace Gear\Constructor\Controller;

use Gear\Constructor\Controller\ControllerConstructor;

trait ControllerConstructorTrait
{
    protected $controllerConstructor;

    public function setControllerConstructor(ControllerConstructor $controller)
    {
        $this->controllerConstructor = $controller;
        return $this;
    }

    public function getControllerConstructor()
    {
        return $this->controllerConstructor;
    }
}
