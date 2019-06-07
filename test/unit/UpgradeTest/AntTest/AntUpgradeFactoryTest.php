<?php
namespace GearTest\UpgradeTest\AntTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->container->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->container->get(AntEdge::class)
        ->willReturn($this->prophesize(AntEdge::class)->reveal())
        ->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->container->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $factory = new \Gear\Upgrade\Ant\AntUpgradeFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Ant\AntUpgrade', $instance);
    }
}
