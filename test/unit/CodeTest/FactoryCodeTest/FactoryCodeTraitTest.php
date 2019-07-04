<?php
namespace GearTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Code\FactoryCode\FactoryCode;
use Gear\Code\FactoryCode\FactoryCodeTrait;

/**
 * @group Gear
 * @group FactoryCode
 * @group Service
 */
class FactoryCodeTraitTest extends TestCase
{
    use FactoryCodeTrait;

    public function setUp() : void
    {
        $this->factoryCodeSetUp = $this->prophesize(FactoryCode::class);
    }

    public function testSet()
    {
        $this->setFactoryCode($this->factoryCodeSetUp->reveal());
        $factoryCodeSetUp = $this->getFactoryCode();

        $this->assertInstanceOf(
            FactoryCode::class,
            $factoryCodeSetUp
        );

        $this->assertEquals(
            $this->factoryCodeSetUp->reveal(),
            $factoryCodeSetUp
        );
    }
}
