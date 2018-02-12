<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Module
 * @group Diagnostic
 * @group Dig
 * @group ModuleConstruct
 */
class DiagnosticServiceFactoryTest extends TestCase
{
    public function testCreateDiagnostic()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console);
        $this->serviceLocator->get('moduleStructure')->willReturn($module);

        $factory = new \Gear\Module\Diagnostic\DiagnosticServiceFactory();

        $diagnostic = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Module\Diagnostic\DiagnosticService', $diagnostic);
    }
}
