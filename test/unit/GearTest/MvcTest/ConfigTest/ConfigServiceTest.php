<?php
namespace GearTest\MvcTest\ConfigTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-config
 */
class ConfigServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        //vfsStream::newDirectory('module')->at(vfsStreamWrapper::getRoot());
        //vfsStream::newDirectory('module', 777)->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        //var_dump(vfsStream::url('module/config'));die();
        $this->assertFileExists('vfs://module/config');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        //$this->module->getMainFolder(vfsStream::url('module'));
        $this->module->getConfigFolder()->willReturn(vfsStream::url('module/config'))->shouldBeCalled();
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->controllerPluginManager = $this->prophesize('Gear\Mvc\Config\ControllerPluginManager');
        $this->controllerManager  = $this->prophesize('Gear\Mvc\Config\ControllerManager');
        $this->serviceManager = $this->prophesize('Gear\Mvc\Config\ServiceManager');
        $this->viewHelperManager = $this->prophesize('Gear\Mvc\Config\ViewHelperManager');
        $this->assetManager = $this->prophesize('Gear\Mvc\Config\AssetManager');
        $this->consoleRouterManager = $this->prophesize('Gear\Mvc\Config\ConsoleRouterManager');
        $this->routerManager = $this->prophesize('Gear\Mvc\Config\RouterManager');
        $this->navigationManager = $this->prophesize('Gear\Mvc\Config\NavigationManager');
        $this->uploadImageManager = $this->prophesize('Gear\Mvc\Config\UploadImageManager');
    }

    /**
     * @group con10
     */
    public function testConfigWeb()
    {
        $config = new \Gear\Mvc\Config\ConfigService();
        $config->setModule($this->module->reveal());
        $config->setFileCreator($this->fileCreator);
        $config->setStringService($this->string);
        $config->setControllerPluginManager($this->controllerPluginManager->reveal());
        $config->setViewHelperManager($this->viewHelperManager->reveal());
        $config->setServiceManager($this->serviceManager->reveal());
        $config->setControllerManager($this->controllerManager->reveal());
        $config->setAssetManager($this->assetManager->reveal());
        $config->setRouterManager($this->routerManager->reveal());
        $config->setConsoleRouterManager($this->consoleRouterManager->reveal());
        $config->setNavigationManager($this->navigationManager->reveal());
        $config->setUploadImageManager($this->uploadImageManager->reveal());

        $this->assertTrue($config->module('web'));
    }


    public function testConfigCli()
    {
        $config = new \Gear\Mvc\Config\ConfigService();
        $config->setModule($this->module->reveal());
        $config->setFileCreator($this->fileCreator);
        $config->setStringService($this->string);
        $config->setControllerPluginManager($this->controllerPluginManager->reveal());
        $config->setViewHelperManager($this->viewHelperManager->reveal());
        $config->setServiceManager($this->serviceManager->reveal());
        $config->setControllerManager($this->controllerManager->reveal());
        $config->setAssetManager($this->assetManager->reveal());
        $config->setRouterManager($this->routerManager->reveal());
        $config->setConsoleRouterManager($this->consoleRouterManager->reveal());
        $config->setNavigationManager($this->navigationManager->reveal());
        $config->setUploadImageManager($this->uploadImageManager->reveal());

        $this->assertTrue($config->module('cli'));
    }
}
