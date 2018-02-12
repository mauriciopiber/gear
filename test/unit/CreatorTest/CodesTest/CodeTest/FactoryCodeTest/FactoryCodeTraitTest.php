<?php
namespace GearTest\CreatorTest\CodesTest\CodeTest\FactoryCodeTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\Codes\Code\FactoryCode\FactoryCodeTrait;

/**
 * @group Gear
 * @group FactoryCode
 * @group Service
 */
class FactoryCodeTraitTest extends TestCase
{
    use FactoryCodeTrait;

    public function setUp()
    {
        $this->factoryCodeSetUp = $this->prophesize('Gear\Creator\Codes\Code\FactoryCode\FactoryCode');
    }

    public function testSet()
    {
        $this->setFactoryCode($this->factoryCodeSetUp->reveal());
        $factoryCodeSetUp = $this->getFactoryCode();

        $this->assertInstanceOf(
            'Gear\Creator\Codes\Code\FactoryCode\FactoryCode',
            $factoryCodeSetUp
        );

        $this->assertEquals(
            $this->factoryCodeSetUp->reveal(),
            $factoryCodeSetUp
        );
    }
}
