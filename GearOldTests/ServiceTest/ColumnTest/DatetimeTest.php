<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class DatetimeTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $datetimeColumn = new \Gear\Service\Column\Datetime($this->getDefaultColumnByDataType('datetime'));
        $this->assertInstanceOf('\Gear\Service\Column\Datetime', $datetimeColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $datetimeColumn = new \Gear\Service\Column\Datetime($this->getDefaultColumnByDataType('time'));
    }
}
