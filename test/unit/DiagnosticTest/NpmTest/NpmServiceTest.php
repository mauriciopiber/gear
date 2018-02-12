<?php
namespace GearTest\DiagnosticTest\NpmTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\Npm\NpmService;
use Gear\Edge\Npm\NpmEdge;

/**
 * @group Diagnostic
 * @group NpmDiagnostic
 */
class NpmServiceTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/package.json');

    }


    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $npm = new NpmService();
        $npm->setProject('testing');
        $this->assertEquals('testing', $npm->getProject());
    }


    public function testDiagnosticWebModule()
    {

        $fileConfig = <<<EOS
{
  "name": "pibernetwork-gear-admin",
  "version": "0.1.0",
  "description": "Pibernetwork Website",
  "devDependencies": {
    "bower": "~1.6",
    "gulp": "^3.0.0",
    "jasmine": "~2.3",
    "karma": "~0.13",
    "protractor": "^3.0.0",
    "q": "latest",
    "require-dir": "~0.3"
  }
}


EOS;
        file_put_contents($this->file, $fileConfig);

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new NpmService($module->reveal());


        $yaml = $this->prophesize(NpmEdge::class);
        $yaml->getNpmModule('web')->willReturn(
            [
                'devDependencies' => [
                    'bower' => '~1.6',
                    'gulp' => '^3.0.0',
                    'jasmine' => '~2.3',
                    'karma' => '~0.13',
                    'protractor' => '^3.0.0',
                    'q' => 'latest',
                    'require-dir' => '~0.3'
                ***REMOVED***
            ***REMOVED***
        );

        $composer->setNpmEdge($yaml->reveal());

        $this->assertEquals([***REMOVED***, $composer->diagnosticModule('web'));
    }

    public function testPackageNotFound()
    {

        file_put_contents($this->file, <<<EOS
{
  "name": "pibernetwork-gear-admin",
  "version": "0.1.0",
  "description": "Pibernetwork Website",
  "devDependencies": {
    "bower": "~1.6",
    "gulp": "^3.0.0",
    "jasmine": "~2.3",
    "karma": "~0.13",
    "protractor": "^3.0.0",
    "q": "latest",
    "require-dir": "~0.3"
  }
}

EOS
        );

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new NpmService($module->reveal());

        $yaml = $this->prophesize(NpmEdge::class);
        $yaml->getNpmModule('web')->willReturn(
            [
                'devDependencies' => [
                    'package-1' => '1.0.0',
                    'package-2' => '0.1.0',
                    'package-3' => '0.0.1',
                ***REMOVED***,
            ***REMOVED***
        );

        $composer->setNpmEdge($yaml->reveal());

        $result = $composer->diagnosticModule('web');

        $this->assertCount(3, $result);
        $this->assertEquals(sprintf(NpmService::$requireDevNotFound, 'package-1', '1.0.0'), $result[0***REMOVED***);
        $this->assertEquals(sprintf(NpmService::$requireDevNotFound, 'package-2', '0.1.0'), $result[1***REMOVED***);
        $this->assertEquals(sprintf(NpmService::$requireDevNotFound, 'package-3', '0.0.1'), $result[2***REMOVED***);

    }


    public function testPackageVersion()
    {

        file_put_contents($this->file, <<<EOS
{
  "name": "pibernetwork-gear-admin",
  "version": "0.1.0",
  "description": "Pibernetwork Website",
  "devDependencies": {
    "bower": "~1.6",
    "gulp": "^3.0.0",
    "jasmine": "~2.3",
    "karma": "~0.13",
    "protractor": "^3.0.0",
    "q": "latest",
    "require-dir": "~0.3"
  }
}

EOS
        );

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $composer = new NpmService($module->reveal());

        $yaml = $this->prophesize(NpmEdge::class);
        $yaml->getNpmModule('web')->willReturn(
            [
                'devDependencies' => [
                    'bower' => '3.1.0',
                    'protractor' => '4.1.0',
                ***REMOVED***,


            ***REMOVED***
        );

        $composer->setNpmEdge($yaml->reveal());

        $result = $composer->diagnosticModule('web');

        $this->assertCount(2, $result);
        $this->assertEquals(sprintf(NpmService::$requireDevVersion, 'bower', '~1.6', '3.1.0'), $result[0***REMOVED***);
        $this->assertEquals(sprintf(NpmService::$requireDevVersion, 'protractor', '^3.0.0', '4.1.0'), $result[1***REMOVED***);
    }

}
