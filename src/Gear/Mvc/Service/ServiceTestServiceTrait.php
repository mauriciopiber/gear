<?php
namespace Gear\Mvc\Service;

use Gear\Mvc\Service\ServiceTestService;

trait ServiceTestServiceTrait
{
    protected $serviceTestService;

    public function getServiceTestService()
    {
        if (!isset($this->serviceTestService)) {
            $this->serviceTestService = $this->getServiceLocator()->get(ServiceTestService::class);
        }
        return $this->serviceTestService;
    }

    public function setServiceTestService($serviceTestService)
    {
        $this->serviceTestService = $serviceTestService;
        return $this;
    }
}
