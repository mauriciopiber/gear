<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $this->container->get('Gear\Util\Prompt\ConsolePrompt')
          ->willReturn($this->prophesize('Gear\Util\Prompt\ConsolePrompt')->reveal())
          ->shouldBeCalled();

        $this->container->get('Gear\Module')
          ->willReturn($this->prophesize('Gear\Module\ModuleService')->reveal())
          ->shouldBeCalled();

        $this->container->get('Gear\Module\Tests\ModuleTestsService')
          ->willReturn($this->prophesize('Gear\Module\Tests\ModuleTestsService')->reveal())
          ->shouldBeCalled();

        $this->container->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
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
