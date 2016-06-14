<?php
namespace Gear\Mvc\Spec\UnitTest;

use Gear\Mvc\Spec\UnitTest\UnitTestFactory;

trait UnitTestTrait
{
    protected $unitTest;

    public function getUnitTest()
    {
        if (!isset($this->unitTest)) {
            $name = 'Gear\Mvc\Spec\UnitTest\UnitTest';
            $this->unitTest = $this->getServiceLocator()->get($name);
        }
        return $this->unitTest;
    }

    public function setUnitTest(
        UnitTest $unitTest
    ) {
        $this->unitTest = $unitTest;
        return $this;
    }
}
