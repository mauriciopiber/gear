<?php
namespace GearTest\ModuleTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Module
 * @group ModuleServiceTest
 */
class ModuleServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->module = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/script';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);



        $this->moduleService = new \Gear\Module\ModuleService();
        $this->moduleService->setFileCreator($fileCreator);
        $this->moduleService->setStringService($stringService);
    }

    /**
     * @group create1
     */
    public function testScriptDeploy()
    {
        $this->module->getScriptFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->moduleService->setModule($this->module->reveal());
        $this->moduleService->scriptDevelopment('cli');

        $expected = $this->templates.'/deploy-development-cli.sh';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents(vfsStream::url('module/deploy-development.sh'))
        );
    }

    /**
     * @group create1

    public function testCreateModuleAsProject()
    {
        //$this->moduleService->moduleAsProject('MyModule', vfsStream::url('module'));

    }

    public function testCreateModule()
    {

    }

    public function testDeleteModule()
    {

    }
    */
}