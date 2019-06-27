<?php
namespace GearTest\CreatorTest\CodesTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
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
        $this->factoryCodeSetUp = $this->prophesize('Gear\Code\FactoryCode\FactoryCode');
    }

    public function testSet()
    {
        $this->setFactoryCode($this->factoryCodeSetUp->reveal());
        $factoryCodeSetUp = $this->getFactoryCode();

        $this->assertInstanceOf(
            'Gear\Code\FactoryCode\FactoryCode',
            $factoryCodeSetUp
        );

        $this->assertEquals(
            $this->factoryCodeSetUp->reveal(),
            $factoryCodeSetUp
        );
    }
}
