<?php
namespace GearTest\MvcTest\SpecTest\UnitTestTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Spec\UnitTest\UnitTestTrait;

/**
 * @group Service
 */
class UnitTestTest extends TestCase
{
    use UnitTestTrait;

    /**
     * @group Gear
     * @group UnitTest
    */
    public function testSet()
    {
        $mockUnitTest = $this->prophesize(
            'Gear\Mvc\Spec\UnitTest\UnitTest'
        );
        $this->setUnitTest($mockUnitTest->reveal());
        $this->assertEquals($mockUnitTest->reveal(), $this->getUnitTest());
    }
}
