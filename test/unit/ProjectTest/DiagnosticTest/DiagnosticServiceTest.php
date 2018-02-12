<?php
namespace GearTest\ProjectTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Project\Diagnostic\DiagnosticService;

/**
 * @group Project
 * @group Diagnostic
 * @group Dig
 * @group ProjectConstruct
 */
class DiagnosticServiceTest extends TestCase
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

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->diagnostic = new DiagnosticService($this->console->reveal());
        $this->diagnostic->setBaseDir(vfsStream::url('project'));

        $this->composer = $this->prophesize('Gear\Diagnostic\ComposerService');
        $this->diagnostic->setComposerDiagnosticService($this->composer->reveal());

        $this->npm = $this->prophesize('Gear\Diagnostic\NpmService');
        $this->diagnostic->setNpmService($this->npm->reveal());

        $this->ant = $this->prophesize('Gear\Diagnostic\Ant\AntService');
        $this->diagnostic->setAntService($this->ant->reveal());

        $this->file = $this->prophesize('Gear\Diagnostic\File\FileService');
        $this->diagnostic->setFileDiagnosticService($this->file->reveal());

        $this->dir = $this->prophesize('Gear\Diagnostic\Dir\DirService');
        $this->diagnostic->setDirDiagnosticService($this->dir->reveal());

    }

    /**
     * @group Diagnostic
     * @covers \Gear\Project\Diagnostic\DiagnosticService::diagnostic
     * @dataProvider getProjectType
     */
    public function testDiagostic($type)
    {
        $this->composer->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->npm->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->ant->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->file->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->dir->diagnosticProject($type)->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->diagnostic->diagnostic($type);

        $this->assertTrue($status);
    }

    public function testNotFoundJust()
    {
        $status = $this->diagnostic->diagnostic('web', 'nonono');
        $this->assertEquals($this->diagnostic->errors, [sprintf(DiagnosticService::NO_FOUND, 'nonono')***REMOVED***);
        $this->assertFalse($status);
    }

    public function getSpec()
    {
        return [
            ['composer'***REMOVED***,
            ['ant'***REMOVED***,
            ['file'***REMOVED***,
            ['dir'***REMOVED***,
            ['npm'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider getSpec
     */
    public function testJustDiagnostic($spec)
    {
        $this->{$spec}->diagnosticProject('web')->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->diagnostic->diagnostic('web', $spec);

        $this->assertTrue($status);
    }
}