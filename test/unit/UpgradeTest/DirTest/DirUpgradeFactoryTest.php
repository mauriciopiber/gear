<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Dir\DirEdge;

/**
 * @group Gear
 * @group DirUpgrade
 */
class DirUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console->reveal())->shouldBeCalled();

        $dir = $this->prophesize('GearBase\Util\Dir\DirService');
        $this->serviceLocator->get('GearBase\Util\Dir')->willReturn($dir->reveal())->shouldBeCalled();

        $edge = $this->prophesize(DirEdge::class);
        $this->serviceLocator->get(DirEdge::class)->willReturn($edge->reveal())->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
            ->willReturn($consolePrompt->reveal())
            ->shouldBeCalled();


        $this->serviceLocator->get('config')->willReturn([***REMOVED***)->shouldBeCalled();

        $factory = new \Gear\Upgrade\Dir\DirUpgradeFactory();


        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\Dir\DirUpgrade', $instance);
    }
}
