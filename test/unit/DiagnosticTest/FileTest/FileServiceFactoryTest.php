<?php
namespace GearTest\DiagnosticTest\FileTest;

use PHPUnit\Framework\TestCase;
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
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->serviceLocator->get(ModuleStructure::class)->willReturn($module->reveal())->shouldBeCalled();

        $this->serviceLocator->get('GearBase\GearConfig')
        ->willReturn($this->prophesize('GearBase\Config\GearConfig')->reveal())
        ->shouldBeCalled();

        $fileEdge = $this->prophesize(FileEdge::class);
        $this->serviceLocator->get(FileEdge::class)->willReturn($fileEdge->reveal())->shouldBeCalled();

        $factory = new \Gear\Diagnostic\File\FileServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Diagnostic\File\FileService', $instance);
    }
}
