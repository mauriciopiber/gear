<?php
namespace GearTest\DiagnosticTest\AntTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\Ant\AntService;
use GearBase\Util\String\StringService;

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

        $this->root = vfsStream::setup('module');
        //$this->rootProject = vfsStream::setup('project');
        $this->file = vfsStream::url('module/build.xml');
        vfsStream::newDirectory('test')->at($this->root);
        $this->assertFileExists(vfsStream::url('module/test'));

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->stringService = new StringService();


        $this->gearConfig = $this->prophesize('GearBase\Config\GearConfig');

        $this->ant = new AntService($this->stringService, $this->module->reveal(), $this->gearConfig->reveal());
    }


    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $this->ant->setProject('testing');
        $this->assertEquals('testing', $this->ant->getProject());
    }

    /**
     * @group diag1
     */
    public function testThrowMissingDefaultModule()
    {
        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntModule('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingDefault');

        $this->ant->setAntEdge($edge->reveal());

        $this->ant->diagnosticModule('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingTargetModule()
    {
        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntModule('web')->willReturn([
            'default' => 'piber'
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingTarget');

        $this->ant->setAntEdge($edge->reveal());

        $this->ant->diagnosticModule('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingDefaultProject()
    {
        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntProject('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingDefault');

        $this->ant->setAntEdge($edge->reveal());

        $this->ant->diagnosticProject('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingTargetProject()
    {
        $edge = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $edge->getAntProject('web')->willReturn([
            'default' => 'piber'
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\AntEdge\Exception\MissingTarget');

        $this->ant->setAntEdge($edge->reveal());

        $this->ant->diagnosticProject('web');
    }


    /**
     * @group maf
     */
    public function testMissingAllFiles()
    {
        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntModule('web')->willReturn([
            'import' => [***REMOVED***,
            'target' => [
                'namespace' => 'unit-namespace'
            ***REMOVED***,
            'files' => [
                'ant-namespace' => [***REMOVED***,
                'ant-ci' => [***REMOVED***,
                'ant-dev' => [***REMOVED***,
            ***REMOVED***,
            'default' => 'clean'
        ***REMOVED***)->shouldBeCalled();

        $this->ant->setAntEdge($yaml->reveal());

        $this->assertEquals([
            sprintf(AntService::MISSING_FILE, 'build.xml'),
            sprintf(AntService::MISSING_FILE, 'test/ant-namespace.xml'),
            sprintf(AntService::MISSING_FILE, 'test/ant-ci.xml'),
            sprintf(AntService::MISSING_FILE, 'test/ant-dev.xml'),

        ***REMOVED***, $this->ant->diagnosticModule('web'));
    }

    /**
     * @group inf
     */
    public function testImportFound()
    {
        $xml = simplexml_load_string($this->createConfigImport('project'));

        $imports = [
            'ant-ci',
            'ant-namespace'
        ***REMOVED***;

        $this->assertEquals([***REMOVED***, $this->ant->getImports($xml, $imports));
    }

    /**
     * @group inf
     */
    public function testGetImportNotFull()
    {
        $xml = simplexml_load_string($this->createConfig('project'));

        $imports = [
            'ant-ci',
            'ant-namespace'
        ***REMOVED***;

        file_put_contents(vfsStream::url('module/build.xml'), $this->createConfigImport('project'));
        $this->assertEquals([
            sprintf(AntService::MISSING_IMPORT, 'ant-ci'),
            sprintf(AntService::MISSING_IMPORT, 'ant-namespace'),
        ***REMOVED***, $this->ant->getImports($xml, $imports));

    }

    /**
     * @group maf2
     */
    public function testEmptyFiles()
    {

        file_put_contents(vfsStream::url('module/build.xml'), $this->createConfig('project'));
        file_put_contents(vfsStream::url('module/test/ant-namespace.xml'), $this->createConfig('project-namespace'));
        file_put_contents(vfsStream::url('module/test/ant-ci.xml'), $this->createConfig('project-ci'));
        file_put_contents(vfsStream::url('module/test/ant-dev.xml'), $this->createConfig('project-dev'));


        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('Project');

        $this->gearConfig->getCurrentName()->willReturn('Project')->shouldBeCalled();

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntModule('web')->willReturn([
            'import' => [***REMOVED***,
            'target' => [
                'namespace' => 'unit-namespace'
            ***REMOVED***,
            'files' => [
                'ant-namespace' => [***REMOVED***,
                'ant-ci' => [***REMOVED***,
                'ant-dev' => [***REMOVED***,
            ***REMOVED***,
            'default' => 'clean'
        ***REMOVED***)->shouldBeCalled();

        $this->ant->setAntEdge($yaml->reveal());

        $this->assertEquals([
            sprintf(AntService::$missingTargetDepend, 'namespace', 'unit-namespace', 'build.xml')
        ***REMOVED***, $this->ant->diagnosticModule('web'));
    }

    public function createConfigImport($projectName)
    {
        return <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="{$projectName}" default="build" basedir=".">
    <import file="./test/ant-ci.xml"/>
    <import file="./test/ant-namespace.xml"/>
</project>
EOS;

    }

    public function createConfig($projectName)
    {
        return <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="{$projectName}" default="build" basedir=".">
</project>
EOS;

    }

    public function testMissingTargetsModule()
    {

        $fileConfig = $this->createConfig('gearing');
        file_put_contents($this->file, $fileConfig);


        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('Gearing');

        file_put_contents(vfsStream::url('module/test/ant-ci.xml'), $this->createConfig('gearing-ci'));



        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntModule('web')->willReturn($this->getCompleteAntFile())->shouldBeCalled();

        $this->ant->setAntEdge($yaml->reveal());

        $this->gearConfig->getCurrentName()->willReturn('Gearing')->shouldBeCalled();

        $this->assertEquals($this->getCompleteExpected(), $this->ant->diagnosticModule('web'));
    }

    public function getCompleteExpected()
    {
        return [
            //'Está faltando o nome corretamente na build.xml',
            sprintf(AntService::$missingTarget, 'clean', 'build.xml'),
            sprintf(AntService::$missingTargetDepend, 'prepare', 'clean', 'build.xml'),
            sprintf(AntService::$missingTargetDepend, 'set-vendor', 'isRunningAsModule, isRunningAsProject, isRunningAsVendor', 'build.xml'),
            sprintf(AntService::$missingTargetDepend, 'isRunningAsModule', 'check.runningAsModule', 'build.xml'),
            sprintf(AntService::$missingTargetDepend, 'isRunningAsProject', 'check.runningAsProject', 'build.xml'),
            sprintf(AntService::$missingTargetDepend, 'isRunningAsVendor', 'check.runningAsVendor', 'build.xml'),
            sprintf(AntService::$missingTarget, 'check.runningAsVendor', 'build.xml'),
            sprintf(AntService::$missingTarget, 'check.runningAsModule', 'build.xml'),
            sprintf(AntService::$missingTarget, 'check.runningAsProject', 'build.xml'),
            sprintf(AntService::$missingTargetDepend, 'unit-namespace', 'buildHelper, set-vendor', 'test/ant-ci.xml'),
            sprintf(AntService::$missingTargetDepend, 'phpcs', 'set-vendor', 'test/ant-ci.xml'),
        ***REMOVED***;
    }

    public function getCompleteAntFile()
    {
        return [
            'import' => [

            ***REMOVED***,
            'files' => [
                'ant-ci' => [
                    'unit-namespace' => 'buildHelper, set-vendor',
                    'phpcs' => 'set-vendor'
                ***REMOVED***
            ***REMOVED***,
            'target' => [
                'clean' => null,
                'prepare' => ['clean'***REMOVED***,
                'set-vendor' => 'isRunningAsModule, isRunningAsProject, isRunningAsVendor',
                'isRunningAsModule' => ['check.runningAsModule'***REMOVED***,
                'isRunningAsProject' => ['check.runningAsProject'***REMOVED***,
                'isRunningAsVendor' => ['check.runningAsVendor'***REMOVED***,
                'check.runningAsVendor' => null,
                'check.runningAsModule' => null,
                'check.runningAsProject' => null,
            ***REMOVED***,
            'default' => 'clean'
        ***REMOVED***;
    }

    /**
     * @group fff1
     */
    public function testMissingTargetsProject()
    {
        $this->root = vfsStream::setup('project');

        $this->file = vfsStream::url('project/build.xml');

        $fileConfig = $this->createConfig('gearing');


        file_put_contents($this->file, $fileConfig);

        vfsStream::newDirectory('test')->at($this->root);

        $this->assertFileExists(vfsStream::url('project/test'));


        file_put_contents(vfsStream::url('project/test/ant-ci.xml'), $this->createConfig('gearing-ci'));


        $this->ant->setProject(vfsStream::url('project'));

        $yaml = $this->prophesize('Gear\Edge\AntEdge\AntEdge');
        $yaml->getAntProject('web')->willReturn($this->getCompleteAntFile())->shouldBeCalled();

        $this->ant->setAntEdge($yaml->reveal());

        $this->gearConfig->getCurrentName()->willReturn('Gearing')->shouldBeCalled();

        $this->assertEquals($this->getCompleteExpected(), $this->ant->diagnosticProject('web'));
    }

    public function getNamesData()
    {
        return [
            ['project'***REMOVED***,
            ['module'***REMOVED***
        ***REMOVED***;

    }

    /**
     * @dataProvider getNamesData
     * @group pqq
     */
    public function testMissingNames($folder)
    {

        $this->root = vfsStream::setup($folder);

        vfsStream::newDirectory('test')->at($this->root);

        $this->assertFileExists(vfsStream::url(sprintf('%s/test', $folder)));

        file_put_contents(vfsStream::url(sprintf('%s/build.xml', $folder)), $this->createConfig('not-a-name'));

        $this->assertFileExists(vfsStream::url(sprintf('%s/build.xml', $folder)));

        file_put_contents(vfsStream::url(sprintf('%s/test/ant-ci.xml', $folder)), $this->createConfig('not-a-name-ci'));

        $this->assertFileExists(vfsStream::url(sprintf('%s/test/ant-ci.xml', $folder)));

        file_put_contents(vfsStream::url(sprintf('%s/test/ant-namespace.xml', $folder)), $this->createConfig('not-a-name-namespace'));

        $this->assertFileExists(vfsStream::url(sprintf('%s/test/ant-namespace.xml', $folder)));

        $this->ant->build = simplexml_load_string(file_get_contents(vfsStream::url(sprintf('%s/build.xml', $folder))));

        $this->gearConfig->getCurrentName()->willReturn('my-name')->shouldBeCalled();

        $edge = [
            'files' => [
                'ant-ci' => [***REMOVED***,
                'ant-namespace' => [***REMOVED***
            ***REMOVED***
        ***REMOVED***;


        $result = $this->ant->getNames(vfsStream::url($folder), $edge);

        $this->assertEquals(
            [
                sprintf(AntService::$missingName, 'my-name', 'build.xml'),
                sprintf(AntService::$missingName, 'my-name-ci', 'test/ant-ci.xml'),
                sprintf(AntService::$missingName, 'my-name-namespace', 'test/ant-namespace.xml')
            ***REMOVED***,
            $result
        );
    }

}
