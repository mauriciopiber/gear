<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Npm\NpmEdge;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group NpmUpgrade
 */
class NpmUpgradeFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');


        $this->serviceLocator->get('Gear\Console\Prompt\ConsolePrompt')
          ->willReturn($this->prophesize('Gear\Console\Prompt\ConsolePrompt')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $this->serviceLocator->get('Gear\Util\String\StringService')->willReturn(
            $this->prophesize('Gear\Util\String\StringService')->reveal()
        )->shouldBeCalled();

        $this->serviceLocator->get(NpmEdge::class)
        ->willReturn($this->prophesize(NpmEdge::class)->reveal())
        ->shouldBeCalled();


        $factory = new \Gear\Upgrade\Npm\NpmUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\Npm\NpmUpgrade', $instance);
    }
}
