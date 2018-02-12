<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\FileCreator\App\ConstructorArgsTrait;

/**
 * @group Service
 */
class ConstructorArgsTest extends TestCase
{
    use ConstructorArgsTrait;

    /**
     * @group Gear
     * @group ConstructorArgs
    */
    public function testSet()
    {
        $mockConstructorArgs = $this->prophesize(
            'Gear\Creator\FileCreator\App\ConstructorArgs'
        );
        $this->setConstructorArgs($mockConstructorArgs->reveal());
        $this->assertEquals($mockConstructorArgs->reveal(), $this->getConstructorArgs());
    }
}
