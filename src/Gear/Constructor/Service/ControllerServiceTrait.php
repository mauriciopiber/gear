<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\ControllerService;

trait ControllerServiceTrait
{
    protected $controllerConstructor;

    public function setControllerConstructor(ControllerService $controllerConstructor)
    {
        $this->controllerConstructor = $controllerConstructor;
        return $this;
    }

    public function getControllerConstructor()
    {
        if (!isset($this->controllerConstructor)) {
            $this->controllerConstructor = $this->getServiceLocator()->get('controllerConstructor');
        }
        return $this->controllerConstructor;
    }
}
