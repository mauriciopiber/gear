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


    public function testFactoryUpgrade()
    {
        //$this->moduleService->

        $fileUpgrade = new \Gear\Upgrade\FileUpgrade(
            $this->console->reveal(),
            $this->consolePrompt->reveal(),
            $this->moduleService->reveal(),
            $this->projectService->reveal(),
            $this->module->reveal()
        );
        $fileUpgrade->upgradeModule('public/js/spec/end2end.conf.js');

    }

}
