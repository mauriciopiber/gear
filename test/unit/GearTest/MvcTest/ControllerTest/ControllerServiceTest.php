<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\SingleDbTableTrait;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-controller
 */
class ControllerServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use SingleDbTableTrait;

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


    public function tables()
    {
        /**
        $db = new Db(['table' => 'MyController'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'controller' => new Controller(['name' => 'MyController', 'object' => '%s\Controller\MyController'***REMOVED***),
            'db' => $db
        ***REMOVED***);


        return [
            [$action, $this->getAllPossibleColumns(), '', true, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsNotNull(), '.not.null', false, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsUnique(), '.unique', true, true***REMOVED***,
            [$action, $this->getAllPossibleColumnsUniqueNotNull(), '.unique.not.null', false, true***REMOVED***,
        ***REMOVED***;
        */
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', true, true, true, 'table'***REMOVED***,
            [$this->getSingleColumns(), 'single-db', true, false, false, 'single_db_table'***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), 'all-columsn-db-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), 'all-columsn-db-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), 'all-columsn-db-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group unit-test
     * @group RefactoringUnitTest
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName)
    {
        $this->testing = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $this->string->str('class', $tableName)***REMOVED***);//MyController'***REMOVED***);

        $this->controller = new \Gear\Mvc\Controller\ControllerService();
        $this->controller->setFileCreator($this->fileCreator);
        $this->controller->setStringService($this->string);
        $this->controller->setModule($this->module->reveal());
        $this->controller->setControllerTestService($this->testing->reveal());


        $this->controllerDependency = new \Gear\Creator\ControllerDependency();

        $this->controller->setControllerDependency($this->controllerDependency);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);

        $this->controller->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);

        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->controller->setTableService($this->table->reveal());

        $controller = new \GearJson\Controller\Controller([
            'name' => $this->string->str('class', $tableName).'Controller',
            'object' => '%s/Controller/'.$this->string->str('class', $tableName).'Controller'
        ***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getControllerByDb($this->db)->willReturn($controller);

        $this->controller->setSchemaService($schemaService->reveal());

        $file = $this->controller->introspectFromTable($this->db);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }


}

