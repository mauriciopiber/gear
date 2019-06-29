<?php
namespace GearTest\DiagnosticTest\DirTest;

use PHPUnit\Framework\TestCase;
use Gear\Diagnostic\Dir\DirServiceFactory;
use Interop\Container\ContainerInterface;
use Gear\Config\GearConfig;
use Gear\Edge\Dir\DirEdge;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group Diagnostic
 * @group DirService
 */
class DirServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $module = $this->prophesize(ModuleStructure::class);
        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->container->get(GearConfig::class)
        ->willReturn($this->prophesize(GearConfig::class)->reveal())
        ->shouldBeCalled();

        $dirEdge = $this->prophesize(DirEdge::class);
        $this->container->get(DirEdge::class)->willReturn($dirEdge->reveal())->shouldBeCalled();

        $factory = new DirServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Diagnostic\Dir\DirService', $instance);
    }
}
