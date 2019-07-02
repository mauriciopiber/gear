<?php
namespace GearTest\KubeTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Kube\KubeServiceFactory;
use Gear\Kube\KubeService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Code\Code;

/**
 * @group Gear
 * @group KubeService
 * @group Service
 */
class KubeServiceFactoryTest extends TestCase
{
    public function testKubeServiceFactory()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(StringService::class)
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(Code::class)
            ->willReturn($this->prophesize(Code::class)->reveal())
            ->shouldBeCalled();

        $factory = new KubeServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null);

        $this->assertInstanceOf(KubeService::class, $instance);
    }
}
