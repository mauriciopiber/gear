<?php
namespace GearTest\MvcTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-config
 */
class ConfigServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        vfsStream::newDirectory('config')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('config/ext')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/config');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        //$this->module->getMainFolder(vfsStream::url('module'));
        $this->module->getConfigFolder()->willReturn(vfsStream::url('module/config'))->shouldBeCalled();
        $this->module->getConfigExtFolder()->willReturn(vfsStream::url('module/config/ext'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->controllerPluginManager = $this->prophesize('Gear\Mvc\Config\ControllerPluginManager');
        $this->controllerManager  = $this->prophesize('Gear\Mvc\Config\ControllerManager');

        $controllers = ["MyModule\Controller\Index" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;

        $this->controllerManager->module($controllers)->willReturn(true)->shouldBeCalled();

        $this->serviceManager = $this->prophesize('Gear\Mvc\Config\ServiceManager');
        $this->serviceManager->module()->willReturn(true)->shouldBeCalled();

        $this->viewHelperManager = $this->prophesize('Gear\Mvc\Config\ViewHelperManager');
        $this->assetManager = $this->prophesize('Gear\Mvc\Config\AssetManager');
        $this->consoleRouterManager = $this->prophesize('Gear\Mvc\Config\ConsoleRouterManager');
        $this->routerManager = $this->prophesize('Gear\Mvc\Config\RouterManager');
        $this->navigationManager = $this->prophesize('Gear\Mvc\Config\NavigationManager');
        $this->uploadImageManager = $this->prophesize('Gear\Mvc\Config\UploadImageManager');

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/config';///module.config.cli.php'
    }

    /**
     * @group con10
     */
    public function testConfigWeb()
    {
        $controllers = ["MyModule\Controller\Index" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;

        $this->assetManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->routerManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->navigationManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->viewHelperManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->uploadImageManager->module($controllers)->willReturn(true)->shouldBeCalled();


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

        $this->assertTrue($config->module('web', 'my-module.stag01.pibernetwork.com'));

        $this->assertEquals(
            file_get_contents(vfsStream::url('module/config/module.config.php')),
            file_get_contents($this->template.'/module.config.web.phtml')
        );
    }


    public function testConfigCli()
    {
        $controllers = ["MyModule\Controller\Index" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;


        $this->consoleRouterManager->module($controllers)->willReturn(true)->shouldBeCalled();

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

        $this->assertEquals(
            file_get_contents(vfsStream::url('module/config/module.config.php')),
            file_get_contents($this->template.'/module.config.cli.phtml')
        );
    }
}
