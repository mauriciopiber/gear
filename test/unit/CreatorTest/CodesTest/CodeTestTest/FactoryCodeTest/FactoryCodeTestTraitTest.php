<?php
namespace GearTest\CreatorTest\CodesTest\CodeTestTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTestTrait;

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
        $this->factoryCodeTestSetUp = $this->prophesize('Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest');
    }

    public function testSet()
    {
        $this->setFactoryCodeTest($this->factoryCodeTestSetUp->reveal());
        $factoryCodeTestSetUp = $this->getFactoryCodeTest();

        $this->assertInstanceOf(
            'Gear\Creator\Codes\CodeTest\FactoryCode\FactoryCodeTest',
            $factoryCodeTestSetUp
        );

        $this->assertEquals(
            $this->factoryCodeTestSetUp->reveal(),
            $factoryCodeTestSetUp
        );
    }
}
