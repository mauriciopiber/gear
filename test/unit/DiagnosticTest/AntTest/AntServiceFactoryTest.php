<?php
namespace GearTest\DiagnosticTest\AntTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Gear
 * @group Diagnostic
 * @group AntService
 */
class AntServiceFactoryTest extends AbstractTestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $this->serviceLocator->get('GearBase\Util\String')
        ->willReturn($this->prophesize('GearBase\Util\String\StringService')->reveal())
        ->shouldBeCalled();

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();


        $this->serviceLocator->get('GearBase\GearConfig')->willReturn($this->prophesize('GearBase\Config\GearConfig')->reveal())
        ->shouldBeCalled();

        $factory = new \Gear\Diagnostic\Ant\AntServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Diagnostic\Ant\AntService', $instance);
    }
}
