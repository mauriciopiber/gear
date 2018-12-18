<?php
namespace GearTest\UpgradeTest;

use PHPUnit\Framework\TestCase;
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
    public function setUp()
    {
        parent::setUp();

        vfsStream::setup('module');

        $this->console = $this->prophesize('Zend\Console\Adapter\Posix');
        $this->moduleService = $this->prophesize('Gear\Module\ModuleService');
        $this->projectService = $this->prophesize('Gear\Project\ProjectService');
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->moduleTests = $this->prophesize('Gear\Module\Tests\ModuleTestsService');
        $this->consolePrompt = $this->prophesize('Gear\Console\Prompt\ConsolePrompt');
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
     * @group ProjectUpgrade
     */
    public function testProjectTrait()
    {
        $this->fileUpgrade->setModuleFolder('testing');
        $this->assertEquals('testing', $this->fileUpgrade->getModuleFolder());
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
    public function testFactoryUpgradeModuleWeb()
    {
        $this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptDevelopment('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getGulpfileConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getGulpfileJs()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getProtractorConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getKarmaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->mockDocs();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptTesting('web')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getStagingScript()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getInstallStagingScript()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptLoad('web')->willReturn(true)->shouldBeCalled();

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
        $target = $yaml->load((new \Gear\Module())->getLocation().'/../data/edge-technologic/module/web/file.yml');


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
        //$this->moduleService->getCodeception()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptDevelopment('cli')->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getPhinxConfig()->willReturn(true)->shouldBeCalled();

        $this->mockDocs();

        $this->moduleService->getPhpdoxConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getSchemaConfig()->willReturn(true)->shouldBeCalled();

        //$this->moduleService->getUnitSuiteConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getScriptTesting('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createGitIgnore('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->createJenkinsFile('cli')->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpmdConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleService->getPhpcsDocsConfig()->willReturn(true)->shouldBeCalled();

        $this->moduleTests->createPhpunitConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitCoverageCiConfigFile()->willReturn(true)->shouldBeCalled();
        $this->moduleTests->createPhpunitBenchmarkConfigFile()->willReturn(true)->shouldBeCalled();

        $file = $this->yaml->load((new \Gear\Module())->getLocation().'/../data/edge-technologic/module/cli/file.yml');
        $common = $this->yaml->load((new \Gear\Module())->getLocation().'/../data/edge-technologic/module/common/file.yml');

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
