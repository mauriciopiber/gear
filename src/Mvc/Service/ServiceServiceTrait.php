<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\Service\ServiceService;

trait ServiceServiceTrait
{
    protected $serviceService;

    public function getServiceService()
    {
        return $this->serviceService;
    }

    public function setServiceService($serviceService)
    {
        $this->serviceService = $serviceService;
        return $this;
    }
}
