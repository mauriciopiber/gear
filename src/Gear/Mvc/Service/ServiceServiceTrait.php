<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\Service\ServiceService;

trait ServiceServiceTrait
{
    protected $serviceService;

    public function getServiceService()
    {
        if (!isset($this->serviceService)) {
            $this->serviceService = $this->getServiceLocator()->get(ServiceService::class);
        }
        return $this->serviceService;
    }

    public function setServiceService($serviceService)
    {
        $this->serviceService = $serviceService;
        return $this;
    }
}
