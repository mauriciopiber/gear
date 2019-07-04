<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Adapter\Posix;
use Gear\Module\Structure\ModuleStructure;
use Gear\Diagnostic\Npm\NpmService;
use Gear\Diagnostic\File\FileService;
use Gear\Diagnostic\Dir\DirService;
use Gear\Diagnostic\Composer\ComposerService;
use Gear\Diagnostic\Ant\AntService;
use Gear\Module\Diagnostic\DiagnosticService;

/**
 * @group Module
 * @group Diagnostic
 * @group Dig
 * @group ModuleConstruct
 */
class DiagnosticServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->console = $this->prophesize(Posix::class);

        $this->composer = $this->prophesize(ComposerService::class);

        $this->npm = $this->prophesize(NpmService::class);

        $this->ant = $this->prophesize(AntService::class);

        $this->file = $this->prophesize(FileService::class);

        $this->dir = $this->prophesize(DirService::class);

        $this->diagnostic = new DiagnosticService(
            $this->console->reveal(),
            $this->module->reveal(),
            $this->ant->reveal(),
            $this->composer->reveal(),
            $this->file->reveal(),
            $this->dir->reveal(),
            $this->npm->reveal()
        );


    }

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
        $this->composer->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->npm->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->ant->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->file->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();
        $this->dir->diagnosticModule($type)->willReturn([***REMOVED***)->shouldBeCalled();

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
        $this->{$spec}->diagnosticModule('web')->willReturn([***REMOVED***)->shouldBeCalled();

        $status = $this->diagnostic->diagnostic('web', $spec);

        $this->assertTrue($status);
    }
}