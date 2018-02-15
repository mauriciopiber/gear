<?php
namespace GearTest\DiagnosticTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\Composer\ComposerService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Edge\Composer\ComposerEdge;
use GearBase\Config\GearConfig;

/**
 * @group Diagnostic
 * @group ComposerService
 * @group ComposerDiagnostic
 */
class ComposerServiceTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/composer.json');
        $this->module = $this->prophesize(ModuleStructure::class);
        $this->gearConfig = $this->prophesize(GearConfig::class);
        $this->composerEdge = $this->prophesize(ComposerEdge::class);

        $this->composer = new ComposerService(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->composerEdge->reveal()
        );
    }


    /**
     * @group abc
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

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');
        $this->module->str('url', 'MyModule')->willReturn('my-module')->shouldBeCalled();

        $this->composerEdge->getComposerModule('web')->willReturn(
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

        $this->composer->setComposerEdge($this->composerEdge->reveal());

        $this->assertEquals([
            ComposerService::$missingName,
            ComposerService::$missingPackFalse,
            ComposerService::$missingSatis,
            ComposerService::$missingAutoload,
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-1', '1.0.0'),
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-2', '2.0.0'),
            sprintf(ComposerService::$requireNotFound, 'mpiber/package-3', '3.0.0'),
            sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-1', '^1.0.0'),
            sprintf(ComposerService::$requireDevNotFound, 'mpiber/unit-2', '*2.0.0')
        ***REMOVED***, $this->composer->diagnosticModule('web'));
    }

    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $this->composer->setProject('testing');
        $this->assertEquals('testing', $this->composer->getProject());
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

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');
        $this->module->str('url', 'MyModule')->willReturn('my-module')->shouldBeCalled();

        $yaml = $this->prophesize(ComposerEdge::class);
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

        $this->composer->setComposerEdge($yaml->reveal());

        $result = $this->composer->diagnosticModule('web');

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

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');
        $this->module->str('url', 'MyModule')->willReturn('my-module')->shouldBeCalled();

        $yaml = $this->prophesize(ComposerEdge::class);
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

        $this->composer->setComposerEdge($yaml->reveal());

        $result = $this->composer->diagnosticModule('web');

        $this->assertCount(5, $result);


        $this->assertEquals(sprintf(ComposerService::$requireVersion, 'mpiber/package-2', '1.0.0', '0.1.0'), $result[3***REMOVED***);
        $this->assertEquals(sprintf(ComposerService::$requireDevVersion, 'mpiber/unit-2', '^1.0.0', '3.0.0'), $result[4***REMOVED***);

    }
    //public function test
}
