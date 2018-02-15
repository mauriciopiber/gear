<?php
namespace GearTest\DiagnosticTest\DirTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Dir\DirEdge;

/**
 * @group Gear
 * @group Diagnostic
 * @group DirService
 */
class DirServiceFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->serviceLocator->get('moduleStructure')->willReturn($module->reveal())->shouldBeCalled();

        $this->serviceLocator->get('GearBase\GearConfig')
        ->willReturn($this->prophesize('GearBase\Config\GearConfig')->reveal())
        ->shouldBeCalled();

        $dirEdge = $this->prophesize(DirEdge::class);
        $this->serviceLocator->get(DirEdge::class)->willReturn($dirEdge->reveal())->shouldBeCalled();

        $factory = new \Gear\Diagnostic\Dir\DirServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Diagnostic\Dir\DirService', $instance);
    }
}
