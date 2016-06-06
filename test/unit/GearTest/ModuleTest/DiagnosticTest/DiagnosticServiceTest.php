<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Module
 * @group Diagnostic
 * @group Dig
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
        $composer->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->diagnostic->setComposerDiagnosticService($composer->reveal());


        $npm = $this->prophesize('Gear\Diagnostic\NpmService');
        $npm->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->diagnostic->setNpmService($npm->reveal());

        $ant = $this->prophesize('Gear\Diagnostic\Ant\AntService');
        $ant->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->diagnostic->setAntService($ant->reveal());

        $file = $this->prophesize('Gear\Diagnostic\FileService');
        $file->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->diagnostic->setFileDiagnosticService($file->reveal());

        $dir = $this->prophesize('Gear\Diagnostic\DirService');
        $dir->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->diagnostic->setDirDiagnosticService($dir->reveal());

        $status = $this->diagnostic->diagnostic($type);

        $this->assertTrue($status);
    }
}