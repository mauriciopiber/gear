<?php
namespace GearTest\UpgradeTest\AntTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Config\GearConfig;
use Gear\Edge\Ant\AntEdge;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Upgrade
 * @group Gear
 * @group AntUpgrade
 */
class AntUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $consolePrompt = $this->prophesize(ConsolePrompt::class);

        $this->container->get(ConsolePrompt::class)
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->container->get(StringService::class)
        ->willReturn($this->prophesize(StringService::class)->reveal())
        ->shouldBeCalled();

        $this->container->get(AntEdge::class)
        ->willReturn($this->prophesize(AntEdge::class)->reveal())
        ->shouldBeCalled();

        $module = $this->prophesize(ModuleStructure::class);
        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->container->get(GearConfig::class)->willReturn(
            $this->prophesize(GearConfig::class)->reveal()
        )->shouldBeCalled();

        $factory = new \Gear\Upgrade\Ant\AntUpgradeFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Ant\AntUpgrade', $instance);
    }
}
