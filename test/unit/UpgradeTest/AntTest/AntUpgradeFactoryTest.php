<?php
namespace GearTest\UpgradeTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Ant\AntEdge;

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

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
        ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get(AntEdge::class)
        ->willReturn($this->prophesize(AntEdge::class)->reveal())
        ->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $this->serviceLocator->get('GearBase\GearConfig')->willReturn(
            $this->prophesize('GearBase\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $factory = new \Gear\Upgrade\Ant\AntUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\Ant\AntUpgrade', $instance);
    }
}
