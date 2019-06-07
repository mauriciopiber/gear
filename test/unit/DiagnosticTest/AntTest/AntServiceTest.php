<?php
namespace GearTest\DiagnosticTest\AntTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\Ant\AntService;
use Gear\Util\String\StringService;
use Gear\Edge\Ant\AntEdge;

/**
 * @group Diagnostic
 * @group AntService
 * @group AntDiagnostic
 */
class AntServiceTest extends TestCase
{

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');
        //$this->rootProject = vfsStream::setup('project');
        $this->file = vfsStream::url('module/build.xml');
        vfsStream::newDirectory('test')->at($this->root);

        $this->assertFileExists(vfsStream::url('module/test'));

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->stringService = new StringService();

        $this->gearConfig = $this->prophesize('Gear\Config\GearConfig');
        $this->antEdge = $this->prophesize(AntEdge::class);

        $this->ant = new AntService(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->antEdge->reveal(),
            $this->stringService
        );
    }

    /**
     * @group diag1
     */
    public function testThrowMissingDefaultModule()
    {
        $this->antEdge->getAntModule('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\Ant\Exception\MissingDefault');

        $this->ant->diagnosticModule('web');
    }

    /**
     * @group diag1
     */
    public function testThrowMissingTargetModule()
    {
        $edge = $this->prophesize(AntEdge::class);
        $edge->getAntModule('web')->willReturn([
            'default' => 'piber'
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\Ant\Exception\MissingTarget');

        $this->ant->setAntEdge($edge->reveal());

        $this->ant->diagnosticModule('web');
    }

    /**
     * @group mtof
     */
    public function testMissingTargetOnFile()
    {

        $namespace = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing-namespace" default="build" basedir=".">
    <target name="parallel-lint" depends="set-vendor" description="Run PHP parallel lint For Continuous Integration">
        <exec executable="\${vendor}/bin/parallel-lint" failonerror="true">
            <arg line="--exclude"/>
            <arg path="\${basedir}/vendor"/>
            <arg path="\${basedir}"/>
        </exec>
    </target>
    <target name="phpcs-ci" description="PHP_CodeSniffer Continuous Integration" depends="set-vendor">
        <exec executable="\${vendor}/bin/phpcs" output="/dev/null">
            <arg value="--report=checkstyle"/>
            <arg value="--report-file=\${basedir}/build/logs/checkstyle.xml"/>
            <arg value="--standard=PSR2"/>
            <arg path="\${basedir}/src"/>
        </exec>
    </target>
</project>

EOS;

        $build = <<<EOS
<?xml version="1.0" encoding="UTF-8"?>
<project name="gearing" default="build" basedir=".">
    <import file="./test/ant-namespace.xml"/>
    <target name="phpcs-file" description="Code Sniffer" depends="set-vendor">
        <exec executable="\${vendor}/bin/phpcs">
            <arg value="--standard=PSR2"/>
            <arg path="\${basedir}/src/\${file}"/>
        </exec>
    </target>
</project>

EOS;

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->gearConfig->getCurrentName()->willReturn('Gearing')->shouldBeCalled();

        $this->ant->setModule($this->module->reveal());

        file_put_contents(vfsStream::url('module/build.xml'), $build);
        file_put_contents(vfsStream::url('module/test/ant-namespace.xml'), $namespace);

        $this->yaml = $this->prophesize(AntEdge::class);
        $this->yaml->getAntModule('web')->willReturn([
            'import' => [
                'ant-namespace'
            ***REMOVED***,
            'target' => [
                'phpcs-file' => 'set-vendor'
            ***REMOVED***,
            'files' => [
                'ant-namespace' => [
                    'parallel-lint' => 'set-vendor',
                    'phpcs-ci' => 'set-vendor',
                    'phpmd-ci' => 'set-vendor',
                ***REMOVED***,
            ***REMOVED***,
            'default' => 'clean'
        ***REMOVED***)->shouldBeCalled();

        $this->ant->setAntEdge($this->yaml->reveal());

        $this->assertEquals(
            [sprintf(AntService::$missingTargetDepend, 'phpmd-ci', 'set-vendor', 'test/ant-namespace.xml')***REMOVED***,
            $this->ant->diagnosticModule('web')
        );
    }

    /**
     * @group maf
     */
    public function testMissingAllFiles()
    {
        $yaml = $this->prophesize(AntEdge::class);
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

        $this->assertEquals(
            [
                sprintf(AntService::MISSING_FILE, 'build.xml'),
                sprintf(AntService::MISSING_FILE, 'test/ant-namespace.xml'),
                sprintf(AntService::MISSING_FILE, 'test/ant-ci.xml'),
                sprintf(AntService::MISSING_FILE, 'test/ant-dev.xml'),
            ***REMOVED***,
            $this->ant->diagnosticModule('web')
        );
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
     * @group maf4
     */
    public function testEmptyEdge()
    {
        file_put_contents(vfsStream::url('module/build.xml'), $this->createConfig('project'));

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('Project');

        $this->gearConfig->getCurrentName()->willReturn('Project')->shouldBeCalled();

        $yaml = $this->prophesize(AntEdge::class);
        $yaml->getAntModule('web')->willReturn([
            'target' => [
                'namespace' => 'unit-namespace'
            ***REMOVED***,
            'default' => 'clean'
        ***REMOVED***)->shouldBeCalled();

        $this->ant->setAntEdge($yaml->reveal());

        $this->assertEquals([
            sprintf(AntService::$missingTargetDepend, 'namespace', 'unit-namespace', 'build.xml')
        ***REMOVED***, $this->ant->diagnosticModule('web'));
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

        $yaml = $this->prophesize(AntEdge::class);
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



        $yaml = $this->prophesize(AntEdge::class);
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
