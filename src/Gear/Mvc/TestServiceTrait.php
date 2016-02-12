<?php
namespace Gear\Mvc;

trait TestServiceTrait
{
    protected $testService;

    public function getTestService()
    {
        if (!isset($this->testService)) {
            $this->testService = $this->getServiceLocator()->get('Gear\Mvc\TestService');
        }
        return $this->testService;
    }

    public function setTestService($testService)
    {
        $this->testService = $testService;
        return $this;
    }
}
