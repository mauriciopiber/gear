<?php
namespace Gear\Module;

use Gear\Module\TestService;

trait TestServiceTrait
{
    protected $testService;

    public function getTestService()
    {
        if (!isset($this->testService)) {
            $this->testService = $this->getServiceLocator()->get('Gear\Module\Test');
        }
        return $this->testService;
    }

    public function setTestService(TestService $testService)
    {
        $this->testService = $testService;
        return $this;
    }
}
