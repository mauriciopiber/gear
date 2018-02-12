<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerTestServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerTestService;

/**
 * @group Gear
 * @group ApiControllerTestService
 * @group Service
 */
class ApiControllerTestServiceFactoryTest extends TestCase
{
    public function testApiControllerTestServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $factory = new ApiControllerTestServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ApiControllerTestService::class, $instance);
    }
}
