<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Upgrade
 * @group Gear
 * @group ComposerUpgrade
 */
class ComposerUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Upgrade\ComposerUpgradeFactory();

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Edge\Composer\ComposerEdge')
        ->willReturn($this->prophesize('Gear\Edge\Composer\ComposerEdge'))
        ->shouldBeCalled();


        $this->serviceLocator->get('GearBase\Util\String')
        ->willReturn($this->prophesize('GearBase\Util\String\StringService'))
        ->shouldBeCalled();

        $this->serviceLocator->get('config')->willReturn([***REMOVED***)->shouldBeCalled();


        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();



        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\ComposerUpgrade', $instance);
    }
}
