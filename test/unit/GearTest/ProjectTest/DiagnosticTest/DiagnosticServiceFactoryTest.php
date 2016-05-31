<?php
namespace GearTest\ProjectTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Project
 * @group Diagnostic
 * @group Dig
 * @group ProjectConstruct
 */
class DiagnosticServiceFactoryTest extends AbstractTestCase
{
    public function testCreateDiagnostic()
    {
        $this->serviceLocator    = $this->prophesize('Zend\ServiceManager\ServiceLocatorInterface');

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->serviceLocator->get('console')->willReturn($console);

        $factory = new \Gear\Project\Diagnostic\DiagnosticServiceFactory();

        $diagnostic = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf('Gear\Project\Diagnostic\DiagnosticService', $diagnostic);
    }
}
