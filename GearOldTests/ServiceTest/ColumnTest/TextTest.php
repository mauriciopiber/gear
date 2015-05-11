<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class TextTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $textColumn = new \Gear\Service\Column\Text($this->getDefaultColumnByDataType('text'));
        $this->assertInstanceOf('\Gear\Service\Column\Text', $textColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $textColumn = new \Gear\Service\Column\Text($this->getDefaultColumnByDataType('varchar'));
    }
}
