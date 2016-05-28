<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Diagnostic
 */
class AntServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/build.xml');

    }


    public function testDiagnosticWebModule()
    {

        $fileConfig = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="build" basedir=".">
  <target name="phpcs-dev" description="Code Sniffer">
    <exec executable="\${vendor}/bin/phpcs" failonerror="true">
      <arg value="--standard=PSR2"/>
      <arg path="\${basedir}/src"/>
    </exec>
  </target>
</project>
EOS;
        file_put_contents($this->file, $fileConfig);

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));
        $module->getModuleName()->willReturn('Gearing');
        $module->getModuleName()->willReturn('Gearing');

        $stringService = $this->prophesize('GearBase\Util\String\StringService');

        $composer = new \Gear\Diagnostic\AntService($module->reveal(), $stringService->reveal());


        $yaml = $this->prophesize('Gear\Edge\AntEdge');
        $yaml->getAntModule('web')->willReturn([
            'target' => [
                'clean' => null,
                'prepare' => ['clean'***REMOVED***,
                'set-vendor' => ['isRunningAsModule', 'isRunningAsProject', 'isRunningAsVendor'***REMOVED***,
                'isRunningAsModule' => ['check.runningAsModule'***REMOVED***,
                'isRunningAsProject' => ['check.runningAsProject'***REMOVED***,
                'isRunningAsVendor' => ['check.runningAsVendor'***REMOVED***,
                'check.runningAsVendor' => null,
                'check.runningAsModule' => null,
                'check.runningAsProject' => null,
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $composer->setAntEdge($yaml->reveal());

        $this->assertEquals([
            'Está faltando o nome corretamente na build.xml',
            'Está faltando target clean no arquivo build.xml',
            'Está faltando target prepare no arquivo build.xml',
            'Está faltando target set-vendor no arquivo build.xml',
            'Está faltando target isRunningAsModule no arquivo build.xml',
            'Está faltando target isRunningAsProject no arquivo build.xml',
            'Está faltando target isRunningAsVendor no arquivo build.xml',
            'Está faltando target check.runningAsVendor no arquivo build.xml',
            'Está faltando target check.runningAsModule no arquivo build.xml',
            'Está faltando target check.runningAsProject no arquivo build.xml',
        ***REMOVED***, $composer->diagnosticModule('web'));
    }

}
