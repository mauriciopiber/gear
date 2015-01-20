<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class TimeTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $timeColumn = new \Gear\Service\Column\Time($this->getDefaultColumnByDataType('time'));
        $this->assertInstanceOf('\Gear\Service\Column\Time', $timeColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $timeColumn = new \Gear\Service\Column\Time($this->getDefaultColumnByDataType('varchar'));
    }
}
