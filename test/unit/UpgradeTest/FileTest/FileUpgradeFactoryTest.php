<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Module\Tests\ModuleTestsService;
use Gear\Module\ModuleService;
use Gear\Config\GearConfig;
use Gear\Edge\File\FileEdge;
use Gear\Module\Docs\Docs;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group FileUpgrade
 */
class FileUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(GearConfig::class)->willReturn(
            $this->prophesize(GearConfig::class)->reveal()
        )->shouldBeCalled();

        $this->container->get(ConsolePrompt::class)
          ->willReturn($this->prophesize(ConsolePrompt::class)->reveal())
          ->shouldBeCalled();

        $this->container->get('Gear\Module')
          ->willReturn($this->prophesize(ModuleService::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(ModuleTestsService::class)
          ->willReturn($this->prophesize(ModuleTestsService::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(ModuleStructure::class)
          ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(FileEdge::class)
          ->willReturn($this->prophesize(FileEdge::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(Docs::class)
          ->willReturn($this->prophesize(Docs::class)->reveal())
          ->shouldBeCalled();

        $factory = new \Gear\Upgrade\File\FileUpgradeFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\File\FileUpgrade', $instance);
    }
}
