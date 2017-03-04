<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\FileUpgrade;
use Gear\Util\Yaml\YamlService;

/**
 * @group FileUpgrade
 * @group EdgeFile
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


        $this->fileUpgrade = new FileUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->projectService->reveal(),
            $this->module->reveal()
        );

        $this->yaml = new YamlService();

    }


    /**
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $this->fileUpgrade->setProject('testing');
        $this->assertEquals('testing', $this->fileUpgrade->getProject());
    }

    /**
     * @group fix2
     */
    public function testDependency()
    {
        $this->assertEquals($this->fileUpgrade->getModuleService(), $this->moduleService->reveal());
        $this->assertEquals($this->fileUpgrade->getProjectService(), $this->projectService->reveal());
        $this->assertEquals($this->fileUpgrade->getConsole(), $this->console->reveal());
        $this->assertEquals($this->fileUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($this->fileUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }


    /**
     * @group xmxm
     */
    public function testFactoryUpgradeModuleWeb()
    {
        $this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptDevelopment('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getGulpfileConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getGulpfileJs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getProtractorConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getKarmaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getConfigDocs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getIndexDocs()->willReturn(true)->shouldBeCalled();
        
        $this->moduleService->getChangelogDocs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptTesting('web')->willReturn(true)->shouldBeCalled();
        
        $this->moduleService->getStagingScript()->willReturn(true)->shouldBeCalled();
        
        $this->moduleService->getInstallStagingScript()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptLoad('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createGitIgnore('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createJenkinsFile('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getReadme()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpunitCoverageBenchmarkConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpunitBenchmarkConfig()->willReturn(true)->shouldBeCalled();

        $yaml = new YamlService();
        $target = $yaml->load((new \Gear\Module())->getLocation().'/../../data/edge-technologic/module/web/file.yml');

        $this->fileEdge = $this->prophesize('Gear\Edge\FileEdge');
        $this->fileEdge->getFileModule('web')->willReturn($target)->shouldBeCalled();

        $this->fileUpgrade->setFileEdge($this->fileEdge->reveal());

        $upgrades = $this->fileUpgrade->upgradeModule('web', true);

        $expected = [***REMOVED***;

        foreach ($target['files'***REMOVED*** as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Module');
        }

        $this->assertEquals($expected, $upgrades);

    }

    /**
     * @group xmxm
     */
    public function testFactoryUpgradeModuleCli()
    {
        $this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptDevelopment('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getConfigDocs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getIndexDocs()->willReturn(true)->shouldBeCalled();
        
        $this->moduleService->getChangelogDocs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptTesting('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createGitIgnore('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createJenkinsFile('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getReadme()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpunitCoverageBenchmarkConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpunitBenchmarkConfig()->willReturn(true)->shouldBeCalled();


        $target = $this->yaml->load((new \Gear\Module())->getLocation().'/../../data/edge-technologic/module/cli/file.yml');

        $this->fileEdge = $this->prophesize('Gear\Edge\FileEdge');
        $this->fileEdge->getFileModule('cli')->willReturn($target)->shouldBeCalled();

        $this->fileUpgrade->setFileEdge($this->fileEdge->reveal());

        $upgrades = $this->fileUpgrade->upgradeModule('cli', true);

        $expected = [***REMOVED***;

        foreach ($target['files'***REMOVED*** as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Module');
        }

        $this->assertEquals($expected, $upgrades);

    }
    /**
     * @group xmxm1
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
        
        $this->projectService->getChangelogDocs()->willReturn(true)->shouldBeCalled();

        $this->projectService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptTesting()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptLoad()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptStaging()->willReturn(true)->shouldBeCalled();

        $this->projectService->getScriptProduction()->willReturn(true)->shouldBeCalled();
        
        $this->projectService->getScriptInstallProduction()->willReturn(true)->shouldBeCalled();
        
        $this->projectService->getScriptInstallStaging()->willReturn(true)->shouldBeCalled();

        $this->projectService->getReadme()->willReturn(true)->shouldBeCalled();

        //$this->projectService->getBuildpath()->willReturn(true)->shouldBeCalled();

        $this->projectService->copyPHPMD()->willReturn(true)->shouldBeCalled();

        $this->projectService->createJenkinsFile()->willReturn(true)->shouldBeCalled();

        $this->projectService->createGitIgnore()->willReturn(true)->shouldBeCalled();

        $this->projectService->getPhpcsDocs()->willReturn(true)->shouldBeCalled();

        $target = $this->yaml->load((new \Gear\Module())->getLocation().'/../../data/edge-technologic/project/web/file.yml');

        $this->edge = $this->prophesize('Gear\Edge\FileEdge');
        $this->edge->getFileProject('web')->willReturn($target)->shouldBeCalled();

        vfsStream::setup('project');
        $this->fileUpgrade->setProject(vfsStream::url('project'));

        $this->fileUpgrade->setFileEdge($this->edge->reveal());

        $upgrades = $this->fileUpgrade->upgradeProject('web', $force = true);

        $expected = [***REMOVED***;

        foreach ($target['files'***REMOVED*** as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Project');
        }

        $this->assertEquals($expected, $upgrades);
    }

}
