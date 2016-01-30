<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\ControllerService;

trait ControllerServiceTrait
{
    protected $controllerService;

    public function setControllerService(ControllerService $controllerService)
    {
        $this->controllerService = $controllerService;
        return $this;
    }

    public function getControllerService()
    {
        if (!isset($this->controllerService)) {
            $this->controllerService = $this->getServiceLocator()->get('controllerConstructor');
        }
        return $this->controllerService;
    }
}
