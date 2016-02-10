<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;
use Gear\Mvc\View\App\ServiceServiceTrait;

/**
 * @group Service
 */
class ServiceServiceTest extends AbstractTestCase
{
    use ServiceServiceTrait;

    /**
     * @group Gear
     * @group ServiceService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getServiceService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ServiceService
    */
    public function testGet()
    {
        $serviceService = $this->getServiceService();
        $this->assertInstanceOf('Gear\Mvc\View\App\ServiceService', $serviceService);
    }

    /**
     * @group Gear
     * @group ServiceService
    */
    public function testSet()
    {
        $mockServiceService = $this->getMockSingleClass(
            'Gear\Mvc\View\App\ServiceService'
        );
        $this->setServiceService($mockServiceService);
        $this->assertEquals($mockServiceService, $this->getServiceService());
    }
}
