<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Controller\Api\ApiControllerServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Mvc\Factory\FactoryService;
use Gear\Creator\Injector\Injector;
use Gear\Util\Vector\ArrayService;

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

        $this->serviceLocator->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(Code::class)
            ->willReturn($this->prophesize(Code::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FactoryService::class)
            ->willReturn($this->prophesize(FactoryService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(Injector::class)
            ->willReturn($this->prophesize(Injector::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ArrayService::class)
            ->willReturn($this->prophesize(ArrayService::class)->reveal())
            ->shouldBeCalled();
        $factory = new ApiControllerServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(ApiControllerService::class, $instance);
    }
}
