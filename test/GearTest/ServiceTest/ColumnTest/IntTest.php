<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class IntTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $intColumn = new \Gear\Service\Column\Int($this->getDefaultColumnByDataType('int'));
        $this->assertInstanceOf('\Gear\Service\Column\Int', $intColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $intColumn = new \Gear\Service\Column\Int($this->getDefaultColumnByDataType('varchar'));
    }
}
