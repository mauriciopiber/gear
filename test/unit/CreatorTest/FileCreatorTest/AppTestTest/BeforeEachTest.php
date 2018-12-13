<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTestTest;

use PHPUnit\Framework\TestCase;
use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;

/**
 * @group Service
 */
class BeforeEachTest extends TestCase
{
    use BeforeEachTrait;

    /**
     * @group Gear
     * @group BeforeEach
    */
    public function testSet()
    {
        $mockBeforeEach = $this->prophesize(
            'Gear\Creator\FileCreator\AppTest\BeforeEach'
        );
        $this->setBeforeEach($mockBeforeEach->reveal());
        $this->assertEquals($mockBeforeEach->reveal(), $this->getBeforeEach());
    }
}
