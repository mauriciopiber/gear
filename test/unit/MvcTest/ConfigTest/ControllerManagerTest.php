<?php
namespace GearTest\MvcTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-config
 * @group module-mvc-config-controller
 */
class ControllerManagerTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/config/ext');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);


        $this->controllerManager  = new \Gear\Mvc\Config\ControllerManager();
        $this->controllerManager->setFileCreator($this->fileCreator);
        $this->controllerManager->setStringService($this->string);
        $this->controllerManager->setModule($this->module->reveal());

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/config';
    }

    public function testCreateModuleControllerConfig()
    {
        $controllers = ["MyModule\Controller\IndexController" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;


        $file = $this->controllerManager->module($controllers);

        $expected = $this->template.'/controller.config.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}