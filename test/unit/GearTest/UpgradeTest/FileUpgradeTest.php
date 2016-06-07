<?php
namespace GearTest\UpgradeTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

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
     * @dataProvider types
     */
    public function testFactoryUpgrade($type)
    {
        $this->moduleService->codeception()->willReturn(true)->shouldBeCalled();

        $this->moduleService->scriptDevelopment($type)->willReturn(true)->shouldBeCalled();
        //$this->moduleService->karma()->willReturn(true)->shouldBeCalled();
        //$this->moduleService->protractor()->willReturn(true)->shouldBeCalled();
        //$this->moduleService->mkdocs()->willReturn(true)->shouldBeCalled();
        //$this->moduleService->phpdocs()->willReturn(true)->shouldBeCalled();

        $fileEdge = $this->prophesize('Gear\Edge\FileEdge');
        $fileEdge->getFileModule($type)->willReturn(
            [
                'files' => [
                    /*
                    'data/config.json',
                    'schema/module.json',
                    'public/js/spec/end2end.conf.js',
                    'public/js/spec/karma.conf.js',

                    'phinx.yml',

                    'mkdocs.yml',
                    'phpdox.xml',
                    'test/unit.suite.yml',
                    */
                    'script/deploy-development.sh',
                    'codeception.yml',
                ***REMOVED***,
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

        $this->assertEquals([
            'Arquivo script/deploy-development.sh do Module criado',
            'Arquivo codeception.yml do Module criado'
        ***REMOVED***, $upgrades);
    }

}
