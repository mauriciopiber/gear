<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTestTest;

use GearBaseTest\AbstractTestCase;
use Gear\Creator\FileCreator\AppTest\BeforeEachTrait;

/**
 * @group Service
 */
class BeforeEachTest extends AbstractTestCase
{
    use BeforeEachTrait;

    /**
     * @group Gear
     * @group BeforeEach
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getBeforeEach()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group BeforeEach
    */
    public function testGet()
    {
        $beforeEach = $this->getBeforeEach();
        $this->assertInstanceOf('Gear\Creator\FileCreator\AppTest\BeforeEach', $beforeEach);
    }

    /**
     * @group Gear
     * @group BeforeEach
    */
    public function testSet()
    {
        $mockBeforeEach = $this->getMockSingleClass(
            'Gear\Creator\FileCreator\AppTest\BeforeEach'
        );
        $this->setBeforeEach($mockBeforeEach);
        $this->assertEquals($mockBeforeEach, $this->getBeforeEach());
    }
}
