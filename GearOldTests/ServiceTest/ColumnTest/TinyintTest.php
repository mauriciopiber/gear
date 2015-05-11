<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class TinyintTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $tinyintColumn = new \Gear\Service\Column\Tinyint($this->getDefaultColumnByDataType('tinyint'));
        $this->assertInstanceOf('\Gear\Service\Column\Tinyint', $tinyintColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $tinyintColumn = new \Gear\Service\Column\Tinyint($this->getDefaultColumnByDataType('varchar'));
    }
}
