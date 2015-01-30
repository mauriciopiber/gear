<?php
namespace Gear\Common;

trait ServiceTestServiceTrait {

    protected $serviceTestService;

    public function getServiceTestService()
    {
        if (!isset($this->serviceTestService)) {
            $this->serviceTestService = $this->getServiceLocator()->get('serviceTestService');
        }
        return $this->serviceTestService;
    }

    public function setServiceTestService($serviceTestService)
    {
        $this->serviceTestService = $serviceTestService;
        return $this;
    }
}
