<?php
namespace GearTest\DiagnosticTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Diagnostic\Ant\AntServiceFactory;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Config\GearConfig;
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
        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->container->get(StringService::class)
        ->willReturn($this->prophesize(StringService::class)->reveal())
        ->shouldBeCalled();

        $this->container->get(AntEdge::class)
            ->willReturn($this->prophesize(AntEdge::class)->reveal())
            ->shouldBeCalled();

        $module = $this->prophesize(ModuleStructure::class);

        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();


        $this->container->get(GearConfig::class)
        ->willReturn($this->prophesize(GearConfig::class)->reveal())
        ->shouldBeCalled();

        $factory = new AntServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Diagnostic\Ant\AntService', $instance);
    }
}
