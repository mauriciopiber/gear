<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class MoneyPtBrTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $moneyPtBrColumn = new \Gear\Service\Column\Decimal\MoneyPtBr($this->getDefaultColumnByDataType('decimal'));
        $this->assertInstanceOf('\Gear\Service\Column\Decimal\MoneyPtBr', $moneyPtBrColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $moneyPtBrColumn = new \Gear\Service\Column\Decimal\MoneyPtBr($this->getDefaultColumnByDataType('int'));
    }
}
