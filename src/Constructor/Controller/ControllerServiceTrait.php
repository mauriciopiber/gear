<?php
namespace Gear\Constructor\Controller;

use Gear\Constructor\Controller\ControllerService;

trait ControllerServiceTrait
{
    protected $controllerConstructor;

    public function setControllerConstructor(ControllerService $controller)
    {
        $this->controllerConstructor = $controller;
        return $this;
    }

    public function getControllerConstructor()
    {
        if (!isset($this->controllerConstructor)) {
            $this->controllerConstructor = $this->getServiceLocator()->get('Gear\Module\Constructor\Controller');
        }
        return $this->controllerConstructor;
    }
}
