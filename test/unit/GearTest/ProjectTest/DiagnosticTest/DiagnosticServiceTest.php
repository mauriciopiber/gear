<?php
namespace GearTest\ProjectTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Project
 * @group Diagnostic
 * @group Dig
 * @group ProjectConstruct
 */
class DiagnosticServiceTest extends AbstractTestCase
{
    public function getProjectType()
    {
        return [
            ['cli'***REMOVED***, ['web'***REMOVED***
        ***REMOVED***;
    }

    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('project');
    }

    /**
     * @group Diagnostic
     * @covers \Gear\Project\Diagnostic\DiagnosticService::diagnostic
     * @dataProvider getProjectType
     */
    public function testDiagostic($type)
    {
        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->diagnostic = new \Gear\Project\Diagnostic\DiagnosticService($console->reveal());
        $this->diagnostic->setBaseDir(vfsStream::url('project'));

        $composer = $this->prophesize('Gear\Diagnostic\ComposerService');
        $composer->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->diagnostic->setComposerDiagnosticService($composer->reveal());


        $npm = $this->prophesize('Gear\Diagnostic\NpmService');
        $npm->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->diagnostic->setNpmService($npm->reveal());

        $ant = $this->prophesize('Gear\Diagnostic\Ant\AntService');
        $ant->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->diagnostic->setAntService($ant->reveal());

        $file = $this->prophesize('Gear\Diagnostic\File\FileService');
        $file->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->diagnostic->setFileDiagnosticService($file->reveal());

        $dir = $this->prophesize('Gear\Diagnostic\Dir\DirService');
        $dir->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->diagnostic->setDirDiagnosticService($dir->reveal());

        $status = $this->diagnostic->diagnostic($type);

        $this->assertTrue($status);
    }
}