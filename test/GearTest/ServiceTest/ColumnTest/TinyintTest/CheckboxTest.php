<?php
namespace Gear\ServiceTest\ColumnTest\TinyintTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class CheckboxTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $dateColumn = new \Gear\Service\Column\Tinyint\Checkbox($this->getDefaultColumnByDataType('int'));
        $this->assertInstanceOf('\Gear\Service\Column\Tinyint\Checkbox', $dateColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $dateColumn = new \Gear\Service\Column\Tinyint\Checkbox($this->getDefaultColumnByDataType('datetime'));
    }
}
