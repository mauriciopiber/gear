<?php
namespace GearTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\FactoryCode\FactoryCodeTestTrait;

/**
 * @group Gear
 * @group FactoryCodeTest
 * @group Service
 */
class FactoryCodeTestTraitTest extends TestCase
{
    use FactoryCodeTestTrait;

    public function setUp() : void
    {
        $this->factoryCodeTestSetUp = $this->prophesize('Gear\Code\FactoryCode\FactoryCodeTest');
    }

    public function testSet()
    {
        $this->setFactoryCodeTest($this->factoryCodeTestSetUp->reveal());
        $factoryCodeTestSetUp = $this->getFactoryCodeTest();

        $this->assertInstanceOf(
            'Gear\Code\FactoryCode\FactoryCodeTest',
            $factoryCodeTestSetUp
        );

        $this->assertEquals(
            $this->factoryCodeTestSetUp->reveal(),
            $factoryCodeTestSetUp
        );
    }
}
