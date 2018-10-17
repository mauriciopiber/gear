<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerTestServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Creator\CodeTest;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Mvc\Config\ControllerManager;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Creator\Injector\Injector;

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


        $this->serviceLocator->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(CodeTest::class)
            ->willReturn($this->prophesize(CodeTest::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ControllerManager::class)
            ->willReturn($this->prophesize(ControllerManager::class)->reveal())
            ->shouldBeCalled();


        $this->serviceLocator->get(Injector::class)
            ->willReturn($this->prophesize(Injector::class)->reveal())
            ->shouldBeCalled();


        $this->serviceLocator->get(FactoryTestService::class)
            ->willReturn($this->prophesize(FactoryTestService::class)->reveal())
            ->shouldBeCalled();

        $factory = new ApiControllerTestServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ApiControllerTestService::class, $instance);
    }
}
