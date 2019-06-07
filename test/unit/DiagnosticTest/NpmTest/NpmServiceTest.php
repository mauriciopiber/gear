<?php
namespace GearTest\DiagnosticTest\NpmTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\Npm\NpmService;
use Gear\Edge\Npm\NpmEdge;
use Gear\Config\GearConfig;

/**
 * @group Diagnostic
 * @group NpmDiagnostic
 */
class NpmServiceTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/package.json');

        $this->npmEdge = $this->prophesize(NpmEdge::class);
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->gearConfig = $this->prophesize(GearConfig::class);

        $this->npmService = new NpmService(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->npmEdge->reveal()
        );
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

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->npmEdge->getNpmModule('web')->willReturn(
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

        $this->assertEquals([***REMOVED***, $this->npmService->diagnosticModule('web'));
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

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->npmEdge->getNpmModule('web')->willReturn(
            [
                'devDependencies' => [
                    'package-1' => '1.0.0',
                    'package-2' => '0.1.0',
                    'package-3' => '0.0.1',
                ***REMOVED***,
            ***REMOVED***
        );

        $result = $this->npmService->diagnosticModule('web');

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

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->npmEdge->getNpmModule('web')->willReturn(
            [
                'devDependencies' => [
                    'bower' => '3.1.0',
                    'protractor' => '4.1.0',
                ***REMOVED***,


            ***REMOVED***
        );

        $result = $this->npmService->diagnosticModule('web');

        $this->assertCount(2, $result);
        $this->assertEquals(sprintf(NpmService::$requireDevVersion, 'bower', '~1.6', '3.1.0'), $result[0***REMOVED***);
        $this->assertEquals(sprintf(NpmService::$requireDevVersion, 'protractor', '^3.0.0', '4.1.0'), $result[1***REMOVED***);
    }

}
