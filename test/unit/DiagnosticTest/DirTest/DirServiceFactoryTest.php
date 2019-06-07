<?php
namespace GearTest\DiagnosticTest\DirTest;

use PHPUnit\Framework\TestCase;
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
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->container->get('Gear\Config\GearConfig')
        ->willReturn($this->prophesize('Gear\Config\GearConfig')->reveal())
        ->shouldBeCalled();

        $dirEdge = $this->prophesize(DirEdge::class);
        $this->container->get(DirEdge::class)->willReturn($dirEdge->reveal())->shouldBeCalled();

        $factory = new \Gear\Diagnostic\Dir\DirServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Diagnostic\Dir\DirService', $instance);
    }
}
