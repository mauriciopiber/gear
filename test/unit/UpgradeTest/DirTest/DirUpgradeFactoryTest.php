<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Util\Dir\DirService;
use Gear\Config\GearConfig;
use Gear\Edge\Dir\DirEdge;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group DirUpgrade
 */
class DirUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);


        $dir = $this->prophesize(DirService::class);
        $this->container->get(DirService::class)->willReturn($dir->reveal())->shouldBeCalled();

        $edge = $this->prophesize(DirEdge::class);
        $this->container->get(DirEdge::class)->willReturn($edge->reveal())->shouldBeCalled();

        $module = $this->prophesize(ModuleStructure::class);

        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $consolePrompt = $this->prophesize(ConsolePrompt::class);

        $this->container->get(ConsolePrompt::class)
            ->willReturn($consolePrompt->reveal())
            ->shouldBeCalled();


        $this->container->get(GearConfig::class)->willReturn(
            $this->prophesize(GearConfig::class)->reveal()
        )->shouldBeCalled();


        $factory = new \Gear\Upgrade\Dir\DirUpgradeFactory();


        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Dir\DirUpgrade', $instance);
    }
}
