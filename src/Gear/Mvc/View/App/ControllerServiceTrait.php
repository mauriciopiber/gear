<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\ControllerService;

trait ControllerServiceTrait
{
    protected $controllerService;

    public function getControllerService()
    {
        if (!isset($this->controllerService)) {
            $serviceName = 'Gear\Mvc\View\App\ControllerService';
            $this->controllerService = $this->getServiceLocator()->get($serviceName);
        }
        return $this->controllerService;
    }

    public function setControllerService(
        ControllerService $controllerService
    ) {
        $this->controllerService = $controllerService;
        return $this;
    }
}
