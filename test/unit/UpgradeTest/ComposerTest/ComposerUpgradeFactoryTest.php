<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $factory = new \Gear\Upgrade\Composer\ComposerUpgradeFactory();

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->container->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->container->get('Gear\Edge\Composer\ComposerEdge')
        ->willReturn($this->prophesize('Gear\Edge\Composer\ComposerEdge'))
        ->shouldBeCalled();


        $this->container->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService'))
        ->shouldBeCalled();

        $this->container->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();


        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();



        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Composer\ComposerUpgrade', $instance);
    }
}
