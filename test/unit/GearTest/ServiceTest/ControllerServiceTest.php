<?php
namespace GearTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use Gear\Service\ControllerServiceTrait;

/**
 * @group Service
 */
class ControllerServiceTest extends AbstractTestCase
{
    use ControllerServiceTrait;

    /**
     * @group Gear
     * @group ControllerService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getControllerService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ControllerService
    */
    public function testGet()
    {
        $controllerService = $this->getControllerService();
        $this->assertInstanceOf('Gear\Service\ControllerService', $controllerService);
    }

    /**
     * @group Gear
     * @group ControllerService
    */
    public function testSet()
    {
        $mockController = $this->getMockSingleClass(
            'Gear\Service\ControllerService'
        );
        $this->setControllerService($mockController);
        $this->assertEquals($mockController, $this->getControllerService());
    }
}
