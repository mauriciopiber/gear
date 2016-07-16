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



        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/index-web';

        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/controller';


        $this->code = $this->prophesize('Gear\Creator\Code');

        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }


    /**
     * @group now2
     */
    public function testCreateController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

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



        $controllerService->setInjector($this->injector);

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


    /**
     * @group now6
     */
    public function testCreateMultipleActionController()
    {
        file_put_contents(
            vfsStream::url('module/src/MyModule/Controller/MyController.php'),
            file_get_contents($this->templates.'/CreateController.phtml')
            );

        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController',
            'service' => 'factories',
            'actions' => [
                [
                    'name' => 'MyOneAction',
                    'controller' => 'MyController'
                ***REMOVED***,
                [
                    'name' => 'MyTwoAction',
                    'controller' => 'MyController'
                ***REMOVED***,
                [
                    'name' => 'MyThreeAction',
                    'controller' => 'MyController'
                ***REMOVED***,
                [
                    'name' => 'MyFourAction',
                    'controller' => 'MyController'
                ***REMOVED***,
                [
                    'name' => 'MyFiveAction',
                    'controller' => 'MyController'
                ***REMOVED***,

            ***REMOVED***
        ***REMOVED***);



        $controllerService = new \Gear\Mvc\Controller\ControllerService();
        $controllerService->setFileCreator($this->fileCreator);
        $controllerService->setStringService($this->string);
        $controllerService->setModule($this->module->reveal());

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getUseAttribute($controller)->willReturn('')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getFunctionsNameFromFile(vfsStream::url('module/src/MyModule/Controller/MyController.php'))->willReturn([***REMOVED***)->shouldBeCalled();



        $controllerService->setInjector($this->injector);

        $controllerService->setCode($this->code->reveal());

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $controllerService->setArrayService($this->arrayService);

        $file = $controllerService->buildAction($controller);

        $expected = $this->templates.'/CreateMultipleActionController.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }


    /**
     * @group now1
     */
    public function testCreateActionController()
    {
        file_put_contents(
            vfsStream::url('module/src/MyModule/Controller/MyController.php'),
            file_get_contents($this->templates.'/CreateController.phtml')
        );

        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController',
            'service' => 'factories',
            'actions' => [
                [
                    'name' => 'MyAction',
                    'controller' => 'MyController'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***);



        $controllerService = new \Gear\Mvc\Controller\ControllerService();
        $controllerService->setFileCreator($this->fileCreator);
        $controllerService->setStringService($this->string);
        $controllerService->setModule($this->module->reveal());

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getUseAttribute($controller)->willReturn('')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getFunctionsNameFromFile(vfsStream::url('module/src/MyModule/Controller/MyController.php'))->willReturn([***REMOVED***)->shouldBeCalled();



        $controllerService->setInjector($this->injector);

        $controllerService->setCode($this->code->reveal());

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $controllerService->setArrayService($this->arrayService);

        $file = $controllerService->buildAction($controller);

        $expected = $this->templates.'/CreateActionController.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

    /**
     * @group now3
     */
    public function testCreateActionControllerWithNoAction()
    {
        file_put_contents(
            vfsStream::url('module/src/MyModule/Controller/MyController.php'),
            file_get_contents($this->templates.'/CreateController.phtml')
        );

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
        $this->code->getUseAttribute($controller)->willReturn('')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getFunctionsNameFromFile(vfsStream::url('module/src/MyModule/Controller/MyController.php'))->willReturn([***REMOVED***)->shouldBeCalled();


        $controllerService->setInjector($this->injector);

        /**
        $this->code
          ->inject(explode(PHP_EOL, file_get_contents(vfsStream::url('module/src/MyModule/Controller/MyController.php'))), [""***REMOVED***)
          ->willReturn(explode(PHP_EOL, file_get_contents(vfsStream::url('module/src/MyModule/Controller/MyController.php'))))->shouldBeCalled();
*/
        $controllerService->setCode($this->code->reveal());

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $controllerService->setArrayService($this->arrayService);

        $file = $controllerService->buildAction($controller);

        $expected = $this->templates.'/CreateController.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }


    public function testCreateModuleController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
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
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
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

