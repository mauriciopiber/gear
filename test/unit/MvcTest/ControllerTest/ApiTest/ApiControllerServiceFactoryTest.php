<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerService;

/**
 * @group Gear
 * @group ApiControllerService
 * @group Service
 */
class ApiControllerServiceFactoryTest extends TestCase
{
    public function testApiControllerServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $factory = new ApiControllerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ApiControllerService::class, $instance);
    }
}
