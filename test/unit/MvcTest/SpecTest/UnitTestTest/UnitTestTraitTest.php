<?php
namespace GearTest\MvcTest\SpecTest\UnitTestTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Spec\UnitTest\UnitTestTrait;

/**
 * @group Gear
 * @group UnitTest
 */
class UnitTestTraitTest extends TestCase
{
    use UnitTestTrait;


    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Mvc\Spec\UnitTest\UnitTest')->reveal();
        $this->setUnitTest($mocking);
        $this->assertEquals($mocking, $this->getUnitTest());
    }
}
