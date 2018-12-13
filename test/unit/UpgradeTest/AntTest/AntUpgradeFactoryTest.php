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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $consolePrompt = $this->prophesize('Gear\Console\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Console\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get(AntEdge::class)
        ->willReturn($this->prophesize(AntEdge::class)->reveal())
        ->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->serviceLocator->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->serviceLocator->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $factory = new \Gear\Upgrade\Ant\AntUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\Ant\AntUpgrade', $instance);
    }
}
