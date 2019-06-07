<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Controller\Api\ApiControllerTestServiceFactory;
use Gear\Mvc\Controller\Api\ApiControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
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
        $this->container = $this->prophesize(ContainerInterface::class);


        $this->container->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(CodeTest::class)
            ->willReturn($this->prophesize(CodeTest::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(Injector::class)
            ->willReturn($this->prophesize(Injector::class)->reveal())
            ->shouldBeCalled();


        $this->container->get(FactoryTestService::class)
            ->willReturn($this->prophesize(FactoryTestService::class)->reveal())
            ->shouldBeCalled();

        $factory = new ApiControllerTestServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(ApiControllerTestService::class, $instance);
    }
}
