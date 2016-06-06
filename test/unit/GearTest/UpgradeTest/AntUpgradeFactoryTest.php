<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group AntUpgrade
 */
class AntUpgradeFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console->reveal())->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $factory = new \Gear\Upgrade\AntUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\AntUpgrade', $instance);
    }
}
