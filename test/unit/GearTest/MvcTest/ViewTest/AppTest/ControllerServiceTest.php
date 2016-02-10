<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\View\App\ControllerServiceTrait;

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
        $this->assertInstanceOf('Gear\Mvc\View\App\ControllerService', $controllerService);
    }

    /**
     * @group Gear
     * @group ControllerService
    */
    public function testSet()
    {
        $mockController = $this->getMockSingleClass(
            'Gear\Mvc\View\App\ControllerService'
        );
        $this->setControllerService($mockController);
        $this->assertEquals($mockController, $this->getControllerService());
    }
}
