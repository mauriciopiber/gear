<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class DatePtBrTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $dateColumn = new \Gear\Service\Column\Date\DatePtBr($this->getDefaultColumnByDataType('date'));
        $this->assertInstanceOf('\Gear\Service\Column\Date\DatePtBr', $dateColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $dateColumn = new \Gear\Service\Column\Date\DatePtBr($this->getDefaultColumnByDataType('datetime'));
    }
}
