<?php
namespace Gear\Mvc\View\App;

use Gear\Mvc\View\App\ServiceService;

trait ServiceServiceTrait
{
    protected $serviceService;

    public function getServiceService()
    {
        if (!isset($this->serviceService)) {
            $serviceName = 'Gear\Mvc\View\App\ServiceService';
            $this->serviceService = $this->getServiceLocator()->get($serviceName);
        }
        return $this->serviceService;
    }

    public function setServiceService(
        ServiceService $serviceService
    ) {
        $this->serviceService = $serviceService;
        return $this;
    }
}
