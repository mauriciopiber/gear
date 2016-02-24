<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\View\App\AppControllerSpecServiceTrait;

/**
 * @group Service
 */
class AppControllerSpecServiceTest extends AbstractTestCase
{
    use AppControllerSpecServiceTrait;

    /**
     * @group Gear
     * @group AppControllerSpecService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAppControllerSpecService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AppControllerSpecService
    */
    public function testGet()
    {
        $appControllerSpec = $this->getAppControllerSpecService();
        $this->assertInstanceOf('Gear\Mvc\View\App\AppControllerSpecService', $appControllerSpec);
    }

    /**
     * @group Gear
     * @group AppControllerSpecService
    */
    public function testSet()
    {
        $mockAppController = $this->getMockSingleClass(
            'Gear\Mvc\View\App\AppControllerSpecService'
        );
        $this->setAppControllerSpecService($mockAppController);
        $this->assertEquals($mockAppController, $this->getAppControllerSpecService());
    }
}
