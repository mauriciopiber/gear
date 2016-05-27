<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Module
 * @group Diagnostic
 * @group ModuleConstruct
 */
class DiagnosticServiceTest extends AbstractTestCase
{
    public function getModuleType()
    {
        return [
            ['cli'***REMOVED***, ['web'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @group Diagnostic
     * @covers \Gear\Module\Diagnostic\DiagnosticService::diagnostic
     * @dataProvider getModuleType
     */
    public function testDiagostic($type)
    {
        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->diagnostic = new \Gear\Module\Diagnostic\DiagnosticService($console->reveal(), $module->reveal());

        $composer = $this->prophesize('Gear\Diagnostic\ComposerService');
        $composer->diagnosticModule($type)->willReturn([***REMOVED***);

        $this->diagnostic->setComposerDiagnosticService($composer->reveal());


        $npm = $this->prophesize('Gear\Diagnostic\NpmService');
        $npm->diagnosticModule($type)->willReturn([***REMOVED***);

        $this->diagnostic->setNpmService($npm->reveal());

        $status = $this->diagnostic->diagnostic($type);

        $this->assertTrue($status);
    }
}