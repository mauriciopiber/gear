<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-controller
 * @group module-mvc-controller-test
 */
class ControllerTestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('test')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit/MyModuleTest')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit/MyModuleTest/ControllerTest')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/test/unit/MyModuleTest/ControllerTest');

        $this->vfsLocation = 'module/test/unit/MyModuleTest/ControllerTest';

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');


        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/index-web';


        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/controller-test';


        $this->codeTest = $this->prophesize('Gear\Creator\CodeTest');

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }

    public function testCreateTestController()
    {

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController',
            'service' => 'factories'
        ***REMOVED***);

        $controllerTestService = new \Gear\Mvc\Controller\ControllerTestService();
        $controllerTestService->setFileCreator($this->fileCreator);
        $controllerTestService->setStringService($this->string);
        $controllerTestService->setModule($this->module->reveal());

        $this->factoryTestService->createControllerFactoryTest(
            $controller,
            vfsStream::url($this->vfsLocation)
        )->shouldBeCalled();

        $this->codeTest->getLocation($controller)->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $this->codeTest->getNamespace($controller)->willReturn('ControllerTest')->shouldBeCalled();
        $this->codeTest->getTestNamespace($controller)->willReturn('Controller')->shouldBeCalled();
        /**

        $this->code->getExtends($controller)->willReturn('AbstractActionController')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();


        */
        //$this->factoryService->createFactory($controller, vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();


        $controllerTestService->setInjector($this->injector);


        $controllerTestService->setCodeTest($this->codeTest->reveal());

        $controllerTestService->setFactoryTestService($this->factoryTestService->reveal());

        $file = $controllerTestService->buildController($controller);


        $expected = $this->templates.'/CreateTestController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group now11
     */
    public function testCreateActionControllerWithNoAction()
    {
        file_put_contents(
            vfsStream::url($this->vfsLocation.'/MyControllerTest.php'),
            file_get_contents($this->templates.'/CreateTestController.phtml')
        );

        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController',
            'service' => 'factories'
        ***REMOVED***);

        $fileInject = file_get_contents(vfsStream::url($this->vfsLocation.'/MyControllerTest.php'));
        $fileExplode = explode(PHP_EOL, $fileInject);

        $this->codeTest->getFunctionsNameFromFile(vfsStream::url($this->vfsLocation.'/MyControllerTest.php'))->willReturn([***REMOVED***)->shouldBeCalled();
        $this->codeTest->getDependencyToInject($controller, $fileExplode)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->codeTest->getLocation($controller)->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $controllerTestService = new \Gear\Mvc\Controller\ControllerTestService();
        $controllerTestService->setFileCreator($this->fileCreator);
        $controllerTestService->setStringService($this->string);
        $controllerTestService->setModule($this->module->reveal());
        $controllerTestService->setInjector($this->injector);
        $controllerTestService->setCodeTest($this->codeTest->reveal());
        $controllerTestService->setFactoryTestService($this->factoryTestService->reveal());

        $file = $controllerTestService->buildAction($controller);


        $expected = $this->templates.'/CreateTestController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateTestActionController()
    {

    }

    public function testCreateTestMultipleActionController()
    {

    }

    public function testCreateModuleController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();


        $controller = new \Gear\Mvc\Controller\ControllerTestService();
        $controller->setFileCreator($this->fileCreator);
        $controller->setStringService($this->string);
        $controller->setModule($this->module->reveal());


        $file = $controller->module();

        $expected = $this->template.'/IndexControllerTest.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateModuleControllerFactory()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();


        $controller = new \Gear\Mvc\Controller\ControllerTestService();
        $controller->setFileCreator($this->fileCreator);
        $controller->setStringService($this->string);
        $controller->setModule($this->module->reveal());

        $file = $controller->moduleFactory();

        $expected = $this->template.'/IndexControllerFactoryTest.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }


}
