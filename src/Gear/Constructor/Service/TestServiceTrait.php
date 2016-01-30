<?php
namespace Gear\Constructor\Service;

use Gear\Constructor\Service\TestService;

trait TestServiceTrait
{
    protected $testService;

    public function setTestService(TestService $testService)
    {
        $this->testService = $testService;
        return $this;
    }

    public function getTestService()
    {
        if (!isset($this->testService)) {
            $this->testService = $this->getServiceLocator()->get('testConstructor');
        }
        return $this->testService;
    }
}
