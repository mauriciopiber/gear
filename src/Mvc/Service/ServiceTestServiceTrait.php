<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\Service\ServiceTestService;

trait ServiceTestServiceTrait
{
    protected $serviceTestService;

    public function getServiceTestService()
    {
        return $this->serviceTestService;
    }

    public function setServiceTestService($serviceTestService)
    {
        $this->serviceTestService = $serviceTestService;
        return $this;
    }
}
