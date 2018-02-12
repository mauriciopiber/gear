<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTestTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\FileCreator\AppTest\VarsTrait;

/**
 * @group Service
 */
class VarsTest extends TestCase
{
    use VarsTrait;


    /**
     * @group Gear
     * @group Vars
    */
    public function testSet()
    {
        $mockVars = $this->prophesize(
            'Gear\Creator\FileCreator\AppTest\Vars'
        );
        $this->setVars($mockVars->reveal());
        $this->assertEquals($mockVars->reveal(), $this->getVars());
    }
}
