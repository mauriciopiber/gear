<?php
namespace GearTest\DiagnosticTest\FileTest;

use PHPUnit\Framework\TestCase;

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

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $factory = new \Gear\Diagnostic\File\FileServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Diagnostic\File\FileService', $instance);
    }
}
