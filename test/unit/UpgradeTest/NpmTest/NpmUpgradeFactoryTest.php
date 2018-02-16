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


        $this->serviceLocator->get('Gear\Util\Prompt\ConsolePrompt')
          ->willReturn($this->prophesize('Gear\Util\Prompt\ConsolePrompt')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

        $this->serviceLocator->get('GearBase\GearConfig')->willReturn(
            $this->prophesize('GearBase\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $this->serviceLocator->get('GearBase\Util\String')->willReturn(
            $this->prophesize('GearBase\Util\String\StringService')->reveal()
        )->shouldBeCalled();

        $this->serviceLocator->get(NpmEdge::class)
        ->willReturn($this->prophesize(NpmEdge::class)->reveal())
        ->shouldBeCalled();


        $factory = new \Gear\Upgrade\Npm\NpmUpgradeFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Upgrade\Npm\NpmUpgrade', $instance);
    }
}
