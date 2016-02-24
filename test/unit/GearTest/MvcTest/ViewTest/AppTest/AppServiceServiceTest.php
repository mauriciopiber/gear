<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\View\App\AppServiceServiceTrait;

/**
 * @group Service
 */
class AppServiceServiceTest extends AbstractTestCase
{
    use AppServiceServiceTrait;

    /**
     * @group Gear
     * @group AppServiceService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAppServiceService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AppServiceService
    */
    public function testGet()
    {
        $appServiceService = $this->getAppServiceService();
        $this->assertInstanceOf('Gear\Mvc\View\App\AppServiceService', $appServiceService);
    }

    /**
     * @group Gear
     * @group AppServiceService
    */
    public function testSet()
    {
        $mockAppService = $this->getMockSingleClass(
            'Gear\Mvc\View\App\AppServiceService'
        );
        $this->setAppServiceService($mockAppService);
        $this->assertEquals($mockAppService, $this->getAppServiceService());
    }
    public function testSetAppServiceSpecService()
    {
        $mockAppServiceSpec = $this->getMockSingleClass('Gear\Mvc\View\App\AppServiceSpecService');
        $this->getAppServiceService()->setAppServiceSpecService($mockAppServiceSpec);
        $this->assertEquals($mockAppServiceSpec, $this->getAppServiceService()->getAppServiceSpecService());
    }

    public function testGetAppServiceSpecService()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\View\App\AppServiceSpecService',
            $this->getAppServiceService()->getAppServiceSpecService()
        );
    }
}
