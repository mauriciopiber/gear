<?php
namespace Gear\Service\Constructor;

use Gear\Service\Constructor\TestService;

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
