<?php
namespace Gear\Constructor\Test;

use Gear\Constructor\Test\TestService;

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
            $this->testService = $this->getServiceLocator()->get('Gear\Module\Constructor\Test');
        }
        return $this->testService;
    }
}
