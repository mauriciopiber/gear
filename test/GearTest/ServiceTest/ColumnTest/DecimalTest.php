<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class DecimalTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $decimalColumn = new \Gear\Service\Column\Decimal($this->getDefaultColumnByDataType('decimal'));
        $this->assertInstanceOf('\Gear\Service\Column\Decimal', $decimalColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $decimalColumn = new \Gear\Service\Column\Decimal($this->getDefaultColumnByDataType('int'));
    }
}
