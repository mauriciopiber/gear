<?php
namespace GearTest\DockerTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Docker\DockerServiceFactory;
use Gear\Docker\DockerService;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group DockerService
 * @group Service
 */
class DockerServiceFactoryTest extends TestCase
{
    public function testDockerServiceFactory()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();
        $factory = new DockerServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(DockerService::class, $instance);
    }
}
