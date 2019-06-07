<?php
namespace GearTest\ModuleTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Module\ComposerServiceFactory;
use Gear\Module\ComposerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Vector\ArrayService;
use Gear\Util\String\StringService;

/**
 * @group Gear
 * @group ComposerService
 * @group Factory
 */
class ComposerServiceFactoryTest extends TestCase
{
    public function testComposerServiceFactory()
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->get(ModuleStructure::class)
            ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ComposerEdge::class)
            ->willReturn($this->prophesize(ComposerEdge::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(FileCreator::class)
            ->willReturn($this->prophesize(FileCreator::class)->reveal())
            ->shouldBeCalled();

        $this->container->get(ArrayService::class)
            ->willReturn($this->prophesize(ArrayService::class)->reveal())
            ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
            ->willReturn($this->prophesize(StringService::class)->reveal())
            ->shouldBeCalled();

        $factory = new ComposerServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(ComposerService::class, $instance);
    }
}
