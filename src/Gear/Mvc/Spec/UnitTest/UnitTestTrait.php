<?php
namespace Gear\Mvc\Spec\UnitTest;

use Gear\Mvc\Spec\UnitTest\UnitTest;

trait UnitTestTrait
{
    protected $unitTest;

    public function getUnitTest()
    {
        if (!isset($this->unitTest)) {
            $name = 'Gear\Mvc\Spec\UnitTest\UnitTest';
            $this->unitTest = $this->getServiceLocator()->get(UnitTest::class);
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
