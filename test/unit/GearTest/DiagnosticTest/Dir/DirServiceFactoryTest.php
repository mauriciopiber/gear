<?php
namespace GearTest\DiagnosticTest\DirTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Diagnostic
 * @group DirService
 */
class DirServiceFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $factory = new \Gear\Diagnostic\Dir\DirServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Diagnostic\Dir\DirService', $instance);
    }
}
