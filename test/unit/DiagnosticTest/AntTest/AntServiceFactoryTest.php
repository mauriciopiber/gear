<?php
namespace GearTest\DiagnosticTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Ant\AntEdge;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group Diagnostic
 * @group AntService
 */
class AntServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize('Interop\Container\ContainerInterface');

        $this->container->get('Gear\Util\String\StringService')
        ->willReturn($this->prophesize('Gear\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $this->container->get(AntEdge::class)
            ->willReturn($this->prophesize(AntEdge::class)->reveal())
            ->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();


        $this->container->get('Gear\Config\GearConfig')
        ->willReturn($this->prophesize('Gear\Config\GearConfig')->reveal())
        ->shouldBeCalled();

        $factory = new \Gear\Diagnostic\Ant\AntServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Diagnostic\Ant\AntService', $instance);
    }
}
