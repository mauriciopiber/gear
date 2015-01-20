<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class VarcharTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $varcharColumn = new \Gear\Service\Column\Varchar($this->getDefaultColumnByDataType('varchar'));
        $this->assertInstanceOf('\Gear\Service\Column\Varchar', $varcharColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $varcharColumn = new \Gear\Service\Column\Varchar($this->getDefaultColumnByDataType('int'));
    }
}
