<?php
namespace GearTest\ConstructorTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\App\AppServiceTrait;

/**
 * @group Service
 */
class AppServiceTest extends AbstractTestCase
{
    use AppServiceTrait;

    /**
     * @group Gear
     * @group AppService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAppService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AppService
    */
    public function testGet()
    {
        $appService = $this->getAppService();
        $this->assertInstanceOf('Gear\Constructor\App\AppService', $appService);
    }

    /**
     * @group Gear
     * @group AppService
    */
    public function testSet()
    {
        $mockAppService = $this->getMockSingleClass(
            'Gear\Constructor\App\AppService'
        );
        $this->setAppService($mockAppService);
        $this->assertEquals($mockAppService, $this->getAppService());
    }
    public function testSetAppServiceService()
    {
        $mockAppService = $this->getMockSingleClass('Gear\Mvc\View\App\AppServiceService');
        $this->getAppService()->setAppServiceService($mockAppService);
        $this->assertEquals($mockAppService, $this->getAppService()->getAppServiceService());
    }

    public function testGetAppServiceService()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\View\App\AppServiceService',
            $this->getAppService()->getAppServiceService()
        );
    }
    public function testSetAppControllerService()
    {
        $mockAppController = $this->getMockSingleClass('Gear\Mvc\View\App\AppControllerService');
        $this->getAppService()->setAppControllerService($mockAppController);
        $this->assertEquals($mockAppController, $this->getAppService()->getAppControllerService());
    }

    public function testGetAppControllerService()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\View\App\AppControllerService',
            $this->getAppService()->getAppControllerService()
        );
    }
    public function testSetSchemaService()
    {
        $mockSchemaService = $this->getMockSingleClass('GearJson\Schema\SchemaService');
        $this->getAppService()->setSchemaService($mockSchemaService);
        $this->assertEquals($mockSchemaService, $this->getAppService()->getSchemaService());
    }

    public function testGetSchemaService()
    {
        $this->assertInstanceOf(
            'GearJson\Schema\SchemaService',
            $this->getAppService()->getSchemaService()
        );
    }
}
