<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\FileCreator\App\InjectTrait;

/**
 * @group Service
 */
class InjectTest extends TestCase
{
    use InjectTrait;

    /**
     * @group Gear
     * @group Inject
    */
    public function testSet()
    {
        $mockInject = $this->prophesize(
            'Gear\Creator\FileCreator\App\Inject'
        );
        $this->setInject($mockInject->reveal());
        $this->assertEquals($mockInject->reveal(), $this->getInject());
    }
}
