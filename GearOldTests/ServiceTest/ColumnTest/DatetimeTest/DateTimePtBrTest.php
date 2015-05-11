<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class DatetimePtBrTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $dateColumn = new \Gear\Service\Column\Datetime\DatetimePtBr($this->getDefaultColumnByDataType('datetime'));
        $this->assertInstanceOf('\Gear\Service\Column\Datetime\DatetimePtBr', $dateColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $dateColumn = new \Gear\Service\Column\Datetime\DatetimePtBr($this->getDefaultColumnByDataType('date'));
    }
}
