<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;

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

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console->reveal())->shouldBeCalled();


        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')
        ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $this->serviceLocator->get('config')->willReturn([***REMOVED***)->shouldBeCalled();

        $this->serviceLocator->get('GearBase\GearConfig')->willReturn(
            $this->prophesize('GearBase\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $factory = new \Gear\Upgrade\AntUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\AntUpgrade', $instance);
    }
}
