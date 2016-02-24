<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\View\App\AppServiceSpecServiceTrait;

/**
 * @group Service
 */
class AppServiceSpecServiceTest extends AbstractTestCase
{
    use AppServiceSpecServiceTrait;

    /**
     * @group Gear
     * @group AppServiceSpecService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAppServiceSpecService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AppServiceSpecService
    */
    public function testGet()
    {
        $appServiceSpec = $this->getAppServiceSpecService();
        $this->assertInstanceOf('Gear\Mvc\View\App\AppServiceSpecService', $appServiceSpec);
    }

    /**
     * @group Gear
     * @group AppServiceSpecService
    */
    public function testSet()
    {
        $mockAppServiceSpec = $this->getMockSingleClass(
            'Gear\Mvc\View\App\AppServiceSpecService'
        );
        $this->setAppServiceSpecService($mockAppServiceSpec);
        $this->assertEquals($mockAppServiceSpec, $this->getAppServiceSpecService());
    }
}
