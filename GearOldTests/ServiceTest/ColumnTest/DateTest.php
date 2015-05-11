<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class DateTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $dateColumn = new \Gear\Service\Column\Date($this->getDefaultColumnByDataType('date'));
        $this->assertInstanceOf('\Gear\Service\Column\Date', $dateColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $dateColumn = new \Gear\Service\Column\Date($this->getDefaultColumnByDataType('datetime'));
    }
}
