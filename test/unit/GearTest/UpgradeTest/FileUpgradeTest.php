<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\FileUpgrade;

/**
 * @group FileUpgrade
 */
class FileUpgradeTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->moduleService = $this->prophesize('Gear\Module\ModuleService');
        $this->projectService = $this->prophesize('Gear\Project\ProjectService');
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');
    }


    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $ant = new FileUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->projectService->reveal()
        );
        $ant->setProject('testing');
        $this->assertEquals('testing', $ant->getProject());
    }

    /**
     * @group fix2
     */
    public function testDependency()
    {

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $consolePrompt = $this->prophesize('Gear\Util\Prompt\ConsolePrompt');

        $fileUpgrade = new \Gear\Upgrade\FileUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->projectService->reveal(),
            $this->module->reveal()
        );

        $this->assertEquals($fileUpgrade->getModuleService(), $this->moduleService->reveal());
        $this->assertEquals($fileUpgrade->getProjectService(), $this->projectService->reveal());
        $this->assertEquals($fileUpgrade->getConsole(), $this->console->reveal());
        $this->assertEquals($fileUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($fileUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }


    public function types()
    {
        return [['cli'***REMOVED***, ['web'***REMOVED******REMOVED***;
    }

    /**
     * @group fil1
     * @dataProvider types
     */
    public function testFactoryUpgradeModule($type)
    {
        $this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptDevelopment($type)->willReturn(true)->shouldBeCalled();

        $this->moduleService->getGulpfileConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getGulpfileJs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getProtractorConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getKarmaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getConfigDocs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getIndexDocs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptTesting()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getReadme()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpunitCoverageBenchmarkConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpunitBenchmarkConfig()->willReturn(true)->shouldBeCalled();

        $files = [
            'data/config.json',
            'schema/module.json',
            'docs/index.md',
            'public/js/spec/end2end.conf.js',
            'public/js/spec/karma.conf.js',
            'test/phpunit-coverage-benchmark.xml',
            'test/phpunit-benchmark.xml',
            'test/phpmd.xml',
            'test/phpcs-docs.xml',
            'test/unit.suite.yml',
            'script/deploy-development.sh',
            'script/deploy-testing.sh',
            'gulpfile.js',
            'phinx.yml',
            'mkdocs.yml',
            'phpdox.xml',
            'codeception.yml',
            'README.md'
        ***REMOVED***;

        $fileEdge = $this->prophesize('Gear\Edge\FileEdge');
        $fileEdge->getFileModule($type)->willReturn(
            [
                'files' => $files
            ***REMOVED***
        )->shouldBeCalled();

        $fileUpgrade = new \Gear\Upgrade\FileUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->projectService->reveal(),
            $this->module->reveal()
        );

        $fileUpgrade->setFileEdge($fileEdge->reveal());

        $upgrades = $fileUpgrade->upgradeModule($type, $force = true);

        $expected = [***REMOVED***;

        foreach ($files as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Module');
        }

        $this->assertEquals($expected, $upgrades);
    }

    /**
     * @group fil2
     */
    public function testFactoryUpgradeProject($type = 'web')
    {
        $this->projectService->getCodeception()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptDevelopment($type)->willReturn(true)->shouldBeCalled();

        $this->projectService->getGulpfileConfig()->willReturn(true)->shouldBeCalled();

        $this->projectService->getGulpfileJs()->willReturn(true)->shouldBeCalled();

        $this->projectService->getProtractorConfig()->willReturn(true)->shouldBeCalled();

        $this->projectService->getProtractorReportConfig()->willReturn(true)->shouldBeCalled();

        $this->projectService->getKarmaConfig()->willReturn(true)->shouldBeCalled();

        $this->projectService->getPhinxConfig(null, null, null, null)->willReturn(true)->shouldBeCalled();

        $this->projectService->getConfigDocs()->willReturn(true)->shouldBeCalled();

        $this->projectService->getIndexDocs()->willReturn(true)->shouldBeCalled();

        $this->projectService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptTesting()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptStaging()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptProduction()->willReturn(true)->shouldBeCalled();

        $this->projectService->getReadme()->willReturn(true)->shouldBeCalled();

        $this->projectService->getBuildpath()->willReturn(true)->shouldBeCalled();

        $files = [
            '.buildpath',
            'gulpfile.js',
            'data/config.json',
            'data/report.js',
            'end2end.conf.js',
            'karma.conf.js',
            'phinx.yml',
            'mkdocs.yml',
            'docs/index.md',
            'phpdox.xml',
            'script/deploy-development.sh',
            'script/deploy-testing.sh',
            'script/deploy-production.sh',
            'script/deploy-staging.sh',
            'codeception.yml',
            'README.md'
        ***REMOVED***;

        $fileEdge = $this->prophesize('Gear\Edge\FileEdge');
        $fileEdge->getFileProject($type)->willReturn(
            [
                'files' => $files
            ***REMOVED***
        )->shouldBeCalled();

        $fileUpgrade = new \Gear\Upgrade\FileUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->projectService->reveal(),
            $this->module->reveal()
        );

        vfsStream::setup('project');
        $fileUpgrade->setProject(vfsStream::url('project'));

        $fileUpgrade->setFileEdge($fileEdge->reveal());

        $upgrades = $fileUpgrade->upgradeProject($type, $force = true);

        $expected = [***REMOVED***;

        foreach ($files as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Project');
        }

        $this->assertEquals($expected, $upgrades);
    }

}
