<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class EmailTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $varcharColumn = new \Gear\Service\Column\Varchar\Email($this->getDefaultColumnByDataType('varchar'));
        $this->assertInstanceOf('\Gear\Service\Column\Varchar\Email', $varcharColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $varcharColumn = new \Gear\Service\Column\Varchar\Email($this->getDefaultColumnByDataType('int'));
    }
}
