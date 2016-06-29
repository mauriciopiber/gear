<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-controller
 */
class ControllerServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('src')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule/Controller')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/src/MyModule/Controller');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/index-web';

        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/controller';


        $this->code = $this->prophesize('Gear\Creator\Code');

        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');
    }

    /**
     * @group now
     */
    public function testCreateController()
    {
        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController',
            'service' => 'factories'
        ***REMOVED***);

        $controllerService = new \Gear\Mvc\Controller\ControllerService();
        $controllerService->setFileCreator($this->fileCreator);
        $controllerService->setStringService($this->string);
        $controllerService->setModule($this->module->reveal());

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getExtends($controller)->willReturn('AbstractActionController')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getNamespace($controller)->willReturn('MyModule\Controller')->shouldBeCalled();

        $controllerService->setCode($this->code->reveal());

        $this->factoryService->createFactory($controller, vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $controllerService->setFactoryService($this->factoryService->reveal());

        $file = $controllerService->buildController($controller);

        $expected = $this->templates.'/CreateController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }


    public function testCreateModuleController()
    {
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $controller = new \Gear\Mvc\Controller\ControllerService();
        $controller->setFileCreator($this->fileCreator);
        $controller->setStringService($this->string);
        $controller->setModule($this->module->reveal());


        $file = $controller->module();

        $expected = $this->template.'/IndexController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateModuleControllerFactory()
    {
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $controller = new \Gear\Mvc\Controller\ControllerService();
        $controller->setFileCreator($this->fileCreator);
        $controller->setStringService($this->string);
        $controller->setModule($this->module->reveal());

        $file = $controller->moduleFactory();

        $expected = $this->template.'/IndexControllerFactory.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }


}

