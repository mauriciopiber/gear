<?php
namespace Gear\Mvc\Service;

trait ServiceServiceTrait
{
    protected $serviceService;

    public function getServiceService()
    {
        if (!isset($this->serviceService)) {
            $this->serviceService = $this->getServiceLocator()->get('serviceService');
        }
        return $this->serviceService;
    }

    public function setServiceService($serviceService)
    {
        $this->serviceService = $serviceService;
        return $this;
    }
}
