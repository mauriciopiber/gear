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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');


        $this->container->get('Gear\Util\Prompt\ConsolePrompt')
          ->willReturn($this->prophesize('Gear\Util\Prompt\ConsolePrompt')->reveal())
          ->shouldBeCalled();

        $this->container->get(ModuleStructure::class)
          ->willReturn($this->prophesize('Gear\Module\Structure\ModuleStructure')->reveal())
          ->shouldBeCalled();

        $this->container->get('Gear\Config\GearConfig')->willReturn(
            $this->prophesize('Gear\Config\GearConfig')->reveal()
        )->shouldBeCalled();

        $this->container->get('Gear\Util\String\StringService')->willReturn(
            $this->prophesize('Gear\Util\String\StringService')->reveal()
        )->shouldBeCalled();

        $this->container->get(NpmEdge::class)
        ->willReturn($this->prophesize(NpmEdge::class)->reveal())
        ->shouldBeCalled();


        $factory = new \Gear\Upgrade\Npm\NpmUpgradeFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Npm\NpmUpgrade', $instance);
    }
}
