<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

/**
 * @group column
 * @author piber
 *
 */
class UploadImagesTest extends AbstractGearTest
{
    public function testCanInstanciateClass()
    {
        $varcharColumn = new \Gear\Service\Column\Varchar\UploadImages($this->getDefaultColumnByDataType('varchar'));
        $this->assertInstanceOf('\Gear\Service\Column\Varchar\UploadImages', $varcharColumn);
    }

    public function testTryInstanciateClassWithAnotherDataType()
    {
        $this->setExpectedException('\Gear\Exception\InvalidDataTypeColumnException');
        $varcharColumn = new \Gear\Service\Column\Varchar\UploadImages($this->getDefaultColumnByDataType('int'));
    }
}
