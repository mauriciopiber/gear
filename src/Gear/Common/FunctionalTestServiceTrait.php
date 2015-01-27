<?php
namespace Gear\Common;

trait FunctionalTestServiceTrait {

    protected $functionalTestService;

    public function getFunctionalTestService()
    {
        if (!isset($this->functionalTestService)) {
            $this->functionalTestService = $this->getServiceLocator()->get('functionalTestService');
        }
        return $this->functionalTestService;
    }

    public function setFunctionalTestService($functionalTestService)
    {
        $this->functionalTestService = $functionalTestService;
        return $this;
    }

}