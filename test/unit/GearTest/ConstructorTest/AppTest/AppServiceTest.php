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
        $serviceLocator = $this->getAppConstructor()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AppService
    */
    public function testGet()
    {
        $appService = $this->getAppConstructor();
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
        $this->setAppConstructor($mockAppService);
        $this->assertEquals($mockAppService, $this->getAppConstructor());
    }
    public function testSetAppServiceService()
    {
        $mockAppService = $this->getMockSingleClass('Gear\Mvc\View\App\AppServiceService');
        $this->getAppConstructor()->setAppServiceService($mockAppService);
        $this->assertEquals($mockAppService, $this->getAppConstructor()->getAppServiceService());
    }

    public function testGetAppServiceService()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\View\App\AppServiceService',
            $this->getAppConstructor()->getAppServiceService()
        );
    }
    public function testSetAppControllerService()
    {
        $mockAppController = $this->getMockSingleClass('Gear\Mvc\View\App\AppControllerService');
        $this->getAppConstructor()->setAppControllerService($mockAppController);
        $this->assertEquals($mockAppController, $this->getAppConstructor()->getAppControllerService());
    }

    public function testGetAppControllerService()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\View\App\AppControllerService',
            $this->getAppConstructor()->getAppControllerService()
        );
    }
    public function testSetSchemaService()
    {
        $mockSchemaService = $this->getMockSingleClass('GearJson\Schema\SchemaService');
        $this->getAppConstructor()->setSchemaService($mockSchemaService);
        $this->assertEquals($mockSchemaService, $this->getAppConstructor()->getSchemaService());
    }

    public function testGetSchemaService()
    {
        $this->assertInstanceOf(
            'GearJson\Schema\SchemaService',
            $this->getAppConstructor()->getSchemaService()
        );
    }
}
