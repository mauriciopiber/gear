<?php
namespace GearTest\ModuleTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
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

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->composer = $this->prophesize('Gear\Diagnostic\Composer\ComposerService');

        $this->npm = $this->prophesize('Gear\Diagnostic\Npm\NpmService');

        $this->ant = $this->prophesize('Gear\Diagnostic\Ant\AntService');

        $this->file = $this->prophesize('Gear\Diagnostic\File\FileService');

        $this->dir = $this->prophesize('Gear\Diagnostic\Dir\DirService');

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