<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Config\GearConfig;
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
        $this->container    = $this->prophesize(ContainerInterface::class);


        $this->container->get(ConsolePrompt::class)
          ->willReturn($this->prophesize(ConsolePrompt::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(ModuleStructure::class)
          ->willReturn($this->prophesize(ModuleStructure::class)->reveal())
          ->shouldBeCalled();

        $this->container->get(GearConfig::class)->willReturn(
            $this->prophesize(GearConfig::class)->reveal()
        )->shouldBeCalled();

        $this->container->get(StringService::class)->willReturn(
            $this->prophesize(StringService::class)->reveal()
        )->shouldBeCalled();

        $this->container->get(NpmEdge::class)
        ->willReturn($this->prophesize(NpmEdge::class)->reveal())
        ->shouldBeCalled();


        $factory = new \Gear\Upgrade\Npm\NpmUpgradeFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Upgrade\Npm\NpmUpgrade', $instance);
    }
}
