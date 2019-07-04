<?php
namespace GearTest\ModuleTest\DocsTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Docs\DocsFactory;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group Docs
 */
class DocsFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(ModuleStructure::class)
          ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(StringService::class)
          ->willReturn($this->prophesize(StringService::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(FileCreator::class)
          ->willReturn($this->prophesize(FileCreator::class)->reveal())
          ->shouldBeCalled();

        $factory = new DocsFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Module\Docs\Docs', $instance);
    }
}
