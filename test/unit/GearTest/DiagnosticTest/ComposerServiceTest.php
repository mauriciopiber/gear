<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Diagnostic
 */
class ComposerServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

    }

    public function testDiagnosticWebModule()
    {

        $fileConfig = <<<EOS
{
	"name" : "mauriciopiber/gear",
	"require" : {
		"mpiber/package-1" : "1.0.0",
		"mpiber/package-2" : "2.0.0",
		"mpiber/package-3" : "3.0.0"
	},
    "require-dev": {
        "mpiber/unit-1" : "^1.0.0",
        "mpiber/unit-2" : "*2.0.0"
    }
}

EOS;
        file_put_contents($this->file, $fileConfig);

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new \Gear\Diagnostic\ComposerService($module->reveal());

        $yaml = $this->prophesize('Gear\Edge\ComposerEdge');
        $yaml->getComposerModule('web')->willReturn(
            [
                'require' => [
                    'mpiber/package-1' => '1.0.0',
                    'mpiber/package-2' => '2.0.0',
                    'mpiber/package-3' => '3.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-1' => '^1.0.0',
                    'mpiber/unit-2' => '*2.0.0'
                ***REMOVED***

            ***REMOVED***
        );

        $composer->setComposerEdge($yaml->reveal());

        $this->assertEquals([***REMOVED***, $composer->diagnosticModule('web'));
    }


    public function testPackageNotFound()
    {

        file_put_contents($this->file, <<<EOS
{
	"name" : "mauriciopiber/gear",
	"require" : {
		"mpiber/package-2" : "1.0.0"
	},
    "require-dev": {
        "mpiber/unit-2" : "^1.0.0"
    }
}

EOS
        );

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new \Gear\Diagnostic\ComposerService($module->reveal());

        $yaml = $this->prophesize('Gear\Edge\ComposerEdge');
        $yaml->getComposerModule('web')->willReturn(
            [
                'require' => [
                    'mpiber/package-1' => '1.0.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-1' => '^1.0.0',
                ***REMOVED***

            ***REMOVED***
        );

        $composer->setComposerEdge($yaml->reveal());

        $result = $composer->diagnosticModule('web');

        $this->assertCount(2, $result);
        $this->assertEquals('Package require "mpiber/package-1" com versão "1.0.0"', $result[0***REMOVED***);
        $this->assertEquals('Package require-dev "mpiber/unit-1" com versão "^1.0.0"', $result[1***REMOVED***);
    }


    public function testPackageVersion()
    {

        file_put_contents($this->file, <<<EOS
{
	"name" : "mauriciopiber/gear",
	"require" : {
		"mpiber/package-2" : "1.0.0"
	},
    "require-dev": {
        "mpiber/unit-2" : "^1.0.0"
    }
}

EOS
            );

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new \Gear\Diagnostic\ComposerService($module->reveal());

        $yaml = $this->prophesize('Gear\Edge\ComposerEdge');
        $yaml->getComposerModule('web')->willReturn(
            [
                'require' => [
                    'mpiber/package-2' => '0.1.0',
                ***REMOVED***,
                'require-dev' => [
                    'mpiber/unit-2' => '3.0.0',
                ***REMOVED***

            ***REMOVED***
        );

        $composer->setComposerEdge($yaml->reveal());

        $result = $composer->diagnosticModule('web');

        $this->assertCount(2, $result);
        $this->assertEquals('Package require "mpiber/package-2" mudar para versão "0.1.0"', $result[0***REMOVED***);
        $this->assertEquals('Package require-dev "mpiber/unit-2" mudar para versão "3.0.0"', $result[1***REMOVED***);
    }
    //public function test
}
