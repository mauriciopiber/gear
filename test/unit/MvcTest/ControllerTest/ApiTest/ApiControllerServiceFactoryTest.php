<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Controller\Api\ApiControllerServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Code\Code;
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
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(Code::class)
            ->willReturn($this->prophesize(Code::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(FactoryService::class)
            ->willReturn($this->prophesize(FactoryService::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(Injector::class)
            ->willReturn($this->prophesize(Injector::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ArrayService::class)
            ->willReturn($this->prophesize(ArrayService::class)->reveal())
            ->shouldBeCalled();
        $factory = new ApiControllerServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(ApiControllerService::class, $instance);
    }
}
