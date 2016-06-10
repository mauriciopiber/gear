<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\ComposerService;

/**
 * @group Diagnostic
 * @group ComposerService
 * @group ComposerDiagnostic
 */
class ComposerServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');

    }


    /**
     * @group dia1
     */
    public function testDiagnosticWebProject()
    {

        vfsStream::setup('project');
        $this->file = vfsStream::url('project/composer.json');

        $fileConfig = <<<EOS
{
	"require" : {
	},
    "require-dev": {
    }
}

EOS;
        file_put_contents($this->file, $fileConfig);

        $composer = new ComposerService();
        $composer->setProject(vfsStream::url('project'));

        $yaml = $this->prophesize('Gear\Edge\ComposerEdge');
        $yaml->getComposerProject('web')->willReturn(
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

        $this->assertEquals([
            ComposerService::$missingName,
            ComposerService::$missingPackagistFalse,
            ComposerService::$missingSatis,
            //ComposerService::$missingAutoload,
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-1', '1.0.0'),
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-2', '2.0.0'),
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-3', '3.0.0'),
            sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-1', '^1.0.0'),
            sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-2', '*2.0.0')
        ***REMOVED***, $composer->diagnosticProject('web'));
    }


    /**
     * @group dia1
     */
    public function testDiagnosticWebModule()
    {

        $fileConfig = <<<EOS
{
	"require" : {
	},
    "require-dev": {
    }
}

EOS;
        file_put_contents($this->file, $fileConfig);

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new ComposerService($module->reveal());

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

        $this->assertEquals([
            ComposerService::$missingName,
            ComposerService::$missingPackagistFalse,
            ComposerService::$missingSatis,
            ComposerService::$missingAutoload,
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-1', '1.0.0'),
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-2', '2.0.0'),
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-3', '3.0.0'),
            sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-1', '^1.0.0'),
            sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-2', '*2.0.0')
        ***REMOVED***, $composer->diagnosticModule('web'));
    }

    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $composer = new ComposerService();
        $composer->setProject('testing');
        $this->assertEquals('testing', $composer->getProject());
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

        $composer = new ComposerService($module->reveal());

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

        $this->assertCount(5, $result);

        $this->assertEquals(sprintf(ComposerService::$requireNotFound, 'mpiber/package-1', '1.0.0'), $result[3***REMOVED***);
        $this->assertEquals(sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-1', '^1.0.0'), $result[4***REMOVED***);
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

        $composer = new ComposerService($module->reveal());

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

        $this->assertCount(5, $result);


        $this->assertEquals(sprintf(ComposerService::$requireVersion, 'mpiber/package-2', '0.1.0'), $result[3***REMOVED***);
        $this->assertEquals(sprintf(ComposerService::$requireDevVersion, 'mpiber/unit-2', '3.0.0'), $result[4***REMOVED***);

    }
    //public function test
}
