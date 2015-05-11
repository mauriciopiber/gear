<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class ForeignKeyTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $foreignKeyColumn = new \Gear\Service\Column\Int\ForeignKey(
            $this->getDefaultColumnByDataType('int'),
            $this->getDefaultForeignKey()
        );
        $this->assertInstanceOf('\Gear\Service\Column\Int\ForeignKey', $foreignKeyColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $foreignKeyColumn = new \Gear\Service\Column\Int\ForeignKey($this->getDefaultColumnByDataType('varchar'), $this->getDefaultForeignKey());
    }

    public function testTryInstanciateClassWithWrongForeignKey()
    {
        $this->setExpectedException('\Gear\Exception\InvalidForeignKeyException');
        $foreignKeyColumn = new \Gear\Service\Column\Int\ForeignKey(
            $this->getDefaultColumnByDataType('int'),
            $this->getWrongForeignKey()
        );
    }
}
