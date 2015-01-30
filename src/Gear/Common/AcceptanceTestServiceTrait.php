<?php
namespace Gear\Common;

trait AcceptanceTestServiceTrait {

    protected $acceptanceTestService;

    public function getAcceptanceTestService()
    {
        if (!isset($this->acceptanceTestService)) {
            $this->acceptanceTestService = $this->getServiceLocator()->get('acceptanceTestService');
        }
        return $this->acceptanceTestService;
    }

    public function setAcceptanceTestService($acceptanceTestService)
    {
        $this->acceptanceTestService = $acceptanceTestService;
        return $this;
    }
}
