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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $factory = new \Gear\Upgrade\Composer\ComposerUpgradeFactory();

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
        ->willReturn($consolePrompt->reveal())
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Edge\Composer\ComposerEdge')
        ->willReturn($this->prophesize('Gear\Edge\Composer\ComposerEdge'))
        ->shouldBeCalled();


        $this->serviceLocator->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService'))
        ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();


        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->serviceLocator->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();



        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\Composer\ComposerUpgrade', $instance);
    }
}
