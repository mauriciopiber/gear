<?php
namespace GearTest\CreatorTest\FileCreatorTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Creator\FileCreator\App\InjectTrait;

/**
 * @group Service
 */
class InjectTest extends AbstractTestCase
{
    use InjectTrait;

    /**
     * @group Gear
     * @group Inject
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getInject()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group Inject
    */
    public function testGet()
    {
        $inject = $this->getInject();
        $this->assertInstanceOf('Gear\Creator\FileCreator\App\Inject', $inject);
    }

    /**
     * @group Gear
     * @group Inject
    */
    public function testSet()
    {
        $mockInject = $this->getMockSingleClass(
            'Gear\Creator\FileCreator\App\Inject'
        );
        $this->setInject($mockInject);
        $this->assertEquals($mockInject, $this->getInject());
    }
}
