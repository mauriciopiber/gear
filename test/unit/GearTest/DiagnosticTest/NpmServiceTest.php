<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Diagnostic
 */
class NpmServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/package.json');

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

        $composer = new \Gear\Diagnostic\NpmService($module->reveal());


        $yaml = $this->prophesize('Gear\Edge\NpmEdge');
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

        $composer = new \Gear\Diagnostic\NpmService($module->reveal());

        $yaml = $this->prophesize('Gear\Edge\NpmEdge');
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
        $this->assertEquals('DevDependency "package-1" com versão "1.0.0"', $result[0***REMOVED***);
        $this->assertEquals('DevDependency "package-2" com versão "0.1.0"', $result[1***REMOVED***);
        $this->assertEquals('DevDependency "package-3" com versão "0.0.1"', $result[2***REMOVED***);

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

        $composer = new \Gear\Diagnostic\NpmService($module->reveal());

        $yaml = $this->prophesize('Gear\Edge\NpmEdge');
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
        $this->assertEquals('DevDependency "bower" mudar para versão "3.1.0"', $result[0***REMOVED***);
        $this->assertEquals('DevDependency "protractor" mudar para versão "4.1.0"', $result[1***REMOVED***);
    }

}
