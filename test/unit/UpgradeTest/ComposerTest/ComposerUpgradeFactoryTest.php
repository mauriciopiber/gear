<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Upgrade\Composer\ComposerUpgradeFactory;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Config\GearConfig;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Upgrade
 * @group Gear
 * @group ComposerUpgrade
 */
class ComposerUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $factory = new ComposerUpgradeFactory();

        $consolePrompt = $this->prophesize(ConsolePrompt::class);

        $this->container->get(ConsolePrompt::class)
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->container->get(ComposerEdge::class)
        ->willReturn($this->prophesize(ComposerEdge::class))
        ->shouldBeCalled();


        $this->container->get(StringService::class)
        ->willReturn($this->prophesize(StringService::class))
        ->shouldBeCalled();

        $this->container->get(GearConfig::class)->willReturn(
            $this->prophesize(GearConfig::class)->reveal()
        )->shouldBeCalled();


        $module = $this->prophesize(ModuleStructure::class);

        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();



        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Composer\ComposerUpgrade', $instance);
    }
}
