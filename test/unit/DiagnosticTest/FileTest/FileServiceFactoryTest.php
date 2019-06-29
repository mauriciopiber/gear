<?php
namespace GearTest\DiagnosticTest\FileTest;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Gear\Config\GearConfig;
use Gear\Edge\File\FileEdge;
use Gear\Module\Structure\ModuleStructure;

/**
 * @group Gear
 * @group Diagnostic
 * @group FileService
 */
class FileServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);

        $module = $this->prophesize(ModuleStructure::class);
        $this->container->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->container->get(GearConfig::class)
        ->willReturn($this->prophesize(GearConfig::class)->reveal())
        ->shouldBeCalled();

        $fileEdge = $this->prophesize(FileEdge::class);
        $this->container->get(FileEdge::class)->willReturn($fileEdge->reveal())->shouldBeCalled();

        $factory = new \Gear\Diagnostic\File\FileServiceFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Diagnostic\File\FileService', $instance);
    }
}
