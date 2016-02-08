<?php
namespace GearTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use Gear\Service\AppServiceTrait;

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
        $this->assertInstanceOf('Gear\Service\AppService', $appService);
    }

    /**
     * @group Gear
     * @group AppService
    */
    public function testSet()
    {
        $mockAppService = $this->getMockSingleClass(
            'Gear\Service\AppService'
        );
        $this->setAppService($mockAppService);
        $this->assertEquals($mockAppService, $this->getAppService());
    }
}
