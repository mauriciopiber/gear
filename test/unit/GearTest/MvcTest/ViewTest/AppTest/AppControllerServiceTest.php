<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\View\App\AppControllerServiceTrait;

/**
 * @group Service
 */
class AppControllerServiceTest extends AbstractTestCase
{
    use AppControllerServiceTrait;

    /**
     * @group Gear
     * @group AppControllerService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAppControllerService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AppControllerService
    */
    public function testGet()
    {
        $appControllerService = $this->getAppControllerService();
        $this->assertInstanceOf('Gear\Mvc\View\App\AppControllerService', $appControllerService);
    }



    /**
     * @group Gear
     * @group AppControllerService
    */
    public function testSet()
    {
        $mockAppController = $this->getMockSingleClass(
            'Gear\Mvc\View\App\AppControllerService'
        );
        $this->setAppControllerService($mockAppController);
        $this->assertEquals($mockAppController, $this->getAppControllerService());
    }
    public function testSetAppControllerSpecService()
    {
        $mockAppController = $this->getMockSingleClass('Gear\Mvc\View\App\AppControllerSpecService');
        $this->getAppControllerService()->setAppControllerSpecService($mockAppController);
        $this->assertEquals($mockAppController, $this->getAppControllerService()->getAppControllerSpecService());
    }

    public function testGetAppControllerSpecService()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\View\App\AppControllerSpecService',
            $this->getAppControllerService()->getAppControllerSpecService()
        );
    }
}
