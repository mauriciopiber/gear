<?php
namespace GearTest\MvcTest\ConfigTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;
use Gear\Mvc\Config\ConfigService;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-config
 */
class ConfigServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
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

        $this->string = new \Gear\Util\String\StringService();

        $this->fileCreator    = $this->createFileCreator();

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
        $this->config = new ConfigService(
            $this->module->reveal(),
            $this->string,
            $this->fileCreator,
            $this->assetManager->reveal(),
            $this->routerManager->reveal(),
            $this->consoleRouterManager->reveal(),
            $this->navigationManager->reveal(),
            $this->uploadImageManager->reveal(),
            $this->serviceManager->reveal(),
            $this->controllerManager->reveal(),
            $this->controllerPluginManager->reveal(),
            $this->viewHelperManager->reveal()
        );

    }

    /**
     * @group con10
     */
    public function testConfigWeb()
    {
        $controllers = ["MyModule\Controller\Index" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;

        $this->assetManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->routerManager->module('web', $controllers)->willReturn(true)->shouldBeCalled();
        $this->navigationManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->viewHelperManager->module($controllers)->willReturn(true)->shouldBeCalled();
        $this->uploadImageManager->module($controllers)->willReturn(true)->shouldBeCalled();



        $this->assertTrue($this->config->module('web', 'my-module.stag01.pibernetwork.com'));

        $this->assertEquals(
            file_get_contents(vfsStream::url('module/config/module.config.php')),
            file_get_contents($this->template.'/module.config.web.phtml')
        );
    }


    public function testConfigCli()
    {
        $controllers = ["MyModule\Controller\Index" => "MyModule\Controller\IndexControllerFactory"***REMOVED***;

        $this->consoleRouterManager->module($controllers)->willReturn(true)->shouldBeCalled();


        $this->assertTrue($this->config->module('cli'));

        $this->assertEquals(
            file_get_contents(vfsStream::url('module/config/module.config.php')),
            file_get_contents($this->template.'/module.config.cli.phtml')
        );
    }
}
