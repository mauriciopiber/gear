<?php
namespace GearTest\DiagnosticTest\FileTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Diagnostic
 * @group FileService
 */
class FileServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/build.xml');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
    }

    public function testThrowMissingFiles()
    {
        $file = new \Gear\Diagnostic\File\FileService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\FileEdge');
        $edge->getFileModule('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\FileEdge\Exception\MissingFiles');

        $file->setFileEdge($edge->reveal());

        $file->diagnosticModule('web');
    }

    public function testDiagnosticModule()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        file_put_contents(vfsStream::url('module/need-one'), '...');
        file_put_contents(vfsStream::url('module/need-three.yml'), '...');

        $file = new \Gear\Diagnostic\File\FileService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\FileEdge');
        $edge->getFileModule('web')->willReturn([
            'files' => [
                'need-one',
                'need-two.xml',
                'need-three.yml',
                'need-four.php'
            ***REMOVED***,

        ***REMOVED***)->shouldBeCalled();

        $file->setFileEdge($edge->reveal());

        $errors = $file->diagnosticModule('web');

        $this->assertEquals([
            sprintf(\Gear\Diagnostic\File\FileService::$missingFile, 'need-two.xml'),
            sprintf(\Gear\Diagnostic\File\FileService::$missingFile, 'need-four.php')
        ***REMOVED***, $errors);
    }

    /**


    public function testThrowMissingTarget()
    {
        $ant = new \Gear\Diagnostic\Ant\AntService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntModule('web')->willReturn([
            'default' => 'piber'
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingTarget');

        $ant->setAntEdge($edge->reveal());

        $ant->diagnosticModule('web');
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


        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('Gearing');
        $this->module->getModuleName()->willReturn('Gearing');

        $composer = new \Gear\Diagnostic\Ant\AntService($this->module->reveal(), $this->stringService->reveal());

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
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
            ***REMOVED***,
            'default' => 'clean'
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
    */

}
