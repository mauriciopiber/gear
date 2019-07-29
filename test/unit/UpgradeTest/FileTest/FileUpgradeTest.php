<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
use Gear\Module;
use Zend\Console\Adapter\Posix;
use Gear\Util\Prompt\ConsolePrompt;
use Gear\Project\ProjectService;
use Gear\Module\Tests\ModuleTestsService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\ModuleService;
use org\bovigo\vfs\vfsStream;
use Gear\Upgrade\File\FileUpgrade;
use Gear\Util\Yaml\YamlService;
use Gear\Edge\File\FileEdge;
use Gear\Config\GearConfig;
use Gear\Module\Docs\Docs;

/**
 * @group FileUpgrade
 * @group EdgeFile
 */
class FileUpgradeTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize(Posix::class);
        $this->moduleService = $this->prophesize(ModuleService::class);
        $this->projectService = $this->prophesize(ProjectService::class);
        $this->module = $this->prophesize(ModuleStructure::class);
        $this->moduleTests = $this->prophesize(ModuleTestsService::class);
        $this->consolePrompt = $this->prophesize(ConsolePrompt::class);
        $this->fileEdge = $this->prophesize(FileEdge::class);
        $this->gearConfig = $this->prophesize(GearConfig::class);
        $this->docs = $this->prophesize(Docs::class);

        $this->fileUpgrade = new FileUpgrade(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->fileEdge->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->moduleTests->reveal(),
            $this->docs->reveal()
        );

        $this->yaml = new YamlService();
    }

    /**
     * @group fix2
     */
    public function testDependency()
    {
        $this->assertEquals($this->fileUpgrade->getModuleTestsService(), $this->moduleTests->reveal());
        $this->assertEquals($this->fileUpgrade->getModuleService(), $this->moduleService->reveal());
        $this->assertEquals($this->fileUpgrade->getModule(), $this->module->reveal());
        $this->assertEquals($this->fileUpgrade->getConsolePrompt(), $this->consolePrompt->reveal());
    }


    /**
     * @group xmxm
     */
    public function testFactoryUpgradeModuleApi()
    {
        //$this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getScriptDevelopment('api')->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getGulpfileConfig()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getGulpfileJs()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getProtractorConfig()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getKarmaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->mockDocs();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getScriptTesting('api')->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getStagingScript()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getInstallStagingScript()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getScriptLoad('api')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createGitIgnore('api')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createJenkinsFile('api')->willReturn(true)->shouldBeCalled();
        $this->moduleService->createJenkinsPipeline('api')->willReturn(true)->shouldBeCalled();


        $this->moduleService->createDockerCompose()->willReturn(true)->shouldBeCalled();
        $this->moduleService->createDockerFile()->willReturn(true)->shouldBeCalled();
        $this->moduleService->createKube()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->create

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleTests->createPhpunitConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageCiConfigFile()->willReturn(true)->shouldBeCalled();
        //$this->moduleTests->createPhpunitBenchmarkConfigFile()->willReturn(true)->shouldBeCalled();

        $yaml = new YamlService();
        $target = $yaml->load((new Module())->getLocation().'/../data/edge-technologic/module/api/file.yml');

        $common = $yaml->load((new Module())->getLocation().'/../data/edge-technologic/module/common/file.yml');

        $this->fileEdge->getFileModule('api')->willReturn(array_merge($common, $target))->shouldBeCalled();

        $upgrades = $this->fileUpgrade->upgradeModule('api', true);

        $expected = [***REMOVED***;

        foreach ($target['files'***REMOVED*** as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Module');
        }

        $this->assertEquals($expected, $upgrades);
    }


    /**
     * @group xmxm
     */
    public function testFactoryUpgradeModuleWeb()
    {
        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->mockDocs();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();


        $this->moduleService->createGitIgnore('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createJenkinsFile('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleTests->createPhpunitConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitBenchmarkConfigFile()->willReturn(true)->shouldBeCalled();

        $yaml = new YamlService();
        $target = $yaml->load((new Module())->getLocation().'/../data/edge-technologic/module/web/file.yml');


        $this->fileEdge->getFileModule('web')->willReturn($target)->shouldBeCalled();

        $upgrades = $this->fileUpgrade->upgradeModule('web', true);

        $expected = [***REMOVED***;

        foreach ($target['files'***REMOVED*** as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Module');
        }

        $this->assertEquals($expected, $upgrades);
    }

    public function mockDocs()
    {

        $this->docs->createConfig()->willReturn(true)->shouldBeCalled();

        $this->docs->createChangelog()->willReturn(true)->shouldBeCalled();

        $this->docs->createIndex()->willReturn(true)->shouldBeCalled();

        $this->docs->createReadme()->willReturn(true)->shouldBeCalled();
    }

    /**
     * @group xmxm
     */
    public function testFactoryUpgradeModuleCli()
    {
        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();
        //$this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();
        //$this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();


        $this->moduleService->createJenkinsFile('cli')->willReturn(true)->shouldBeCalled();
        $this->moduleService->createJenkinsPipeline('cli')->willReturn(true)->shouldBeCalled();

        $this->mockDocs();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->createGitIgnore('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createJenkinsFile('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleTests->createPhpunitConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitBenchmarkConfigFile()->willReturn(true)->shouldBeCalled();

        $file = $this->yaml->load((new Module())->getLocation().'/../data/edge-technologic/module/cli/file.yml');
        $common = $this->yaml->load((new Module())->getLocation().'/../data/edge-technologic/module/common/file.yml');

        $target = array_merge_recursive($file, $common);

        $this->fileEdge = $this->prophesize(FileEdge::class);
        $this->fileEdge->getFileModule('cli')->willReturn($target)->shouldBeCalled();

        $this->fileUpgrade->setFileEdge($this->fileEdge->reveal());

        $upgrades = $this->fileUpgrade->upgradeModule('cli', true);

        $expected = [***REMOVED***;

        foreach ($target['files'***REMOVED*** as $file) {
            $expected[***REMOVED*** = sprintf(FileUpgrade::$created, $file, 'Module');
        }

        $this->assertEquals($expected, $upgrades);

    }
}
