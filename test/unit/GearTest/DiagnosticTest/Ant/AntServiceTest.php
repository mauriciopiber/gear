<?php
namespace GearTest\DiagnosticTest\AntTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\Ant\AntService;

/**
 * @group Diagnostic
 * @group AntService
 * @group AntDiagnostic
 */
class AntServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/build.xml');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
    }


    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $ant = new AntService($this->stringService->reveal());
        $ant->setProject('testing');
        $this->assertEquals('testing', $ant->getProject());
    }

    /**
     * @group diag1
     */
    public function testThrowMissingDefaultModule()
    {
        $ant = new AntService($this->stringService->reveal(), $this->module->reveal());

        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntModule('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingDefault');

        $ant->setAntEdge($edge->reveal());

        $ant->diagnosticModule('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingTargetModule()
    {
        $ant = new AntService($this->stringService->reveal(), $this->module->reveal());

        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntModule('web')->willReturn([
            'default' => 'piber'
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingTarget');

        $ant->setAntEdge($edge->reveal());

        $ant->diagnosticModule('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingDefaultProject()
    {
        $ant = new AntService($this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntProject('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingDefault');

        $ant->setAntEdge($edge->reveal());

        $ant->diagnosticProject('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingTargetProject()
    {
        $ant = new AntService($this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntProject('web')->willReturn([
            'default' => 'piber'
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingTarget');

        $ant->setAntEdge($edge->reveal());

        $ant->diagnosticProject('web');
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

        $composer = new AntService($this->stringService->reveal(), $this->module->reveal());

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntModule('web')->willReturn([
            'target' => [
                'clean' => null,
                'prepare' => ['clean'***REMOVED***,
                'set-vendor' => ['isRunningAsModule isRunningAsProject isRunningAsVendor'***REMOVED***,
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
            AntService::$missingName,
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


    public function testDiagnosticWebProject()
    {
        vfsStream::setup('project');

        $this->file = vfsStream::url('project/build.xml');

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

        $composer = new AntService($this->stringService->reveal());
        $composer->setProject(vfsStream::url('project'));

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntProject('web')->willReturn([
            'target' => [
                'clean' => null,
                'prepare' => ['clean'***REMOVED***,
                'set-vendor' => ['isRunningAsModule, isRunningAsProject, isRunningAsVendor'***REMOVED***,
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
            //'Está faltando o nome corretamente na build.xml',
            'Está faltando target clean no arquivo build.xml',
            'Está faltando target prepare no arquivo build.xml',
            'Está faltando target set-vendor no arquivo build.xml',
            'Está faltando target isRunningAsModule no arquivo build.xml',
            'Está faltando target isRunningAsProject no arquivo build.xml',
            'Está faltando target isRunningAsVendor no arquivo build.xml',
            'Está faltando target check.runningAsVendor no arquivo build.xml',
            'Está faltando target check.runningAsModule no arquivo build.xml',
            'Está faltando target check.runningAsProject no arquivo build.xml',
        ***REMOVED***, $composer->diagnosticProject('web'));
    }

}
