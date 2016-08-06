<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\SingleDbTableTrait;
use GearTest\ControllerScopeTrait;

/**
 * @group Fix1
 * @group Controller
 */
class ControllerServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use SingleDbTableTrait;
    use ControllerScopeTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('src')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule/Controller')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/src/MyModule/Controller');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');


        $this->arrayService = new \Gear\Util\Vector\ArrayService();

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

        $this->controllerService = new \Gear\Mvc\Controller\ControllerService();
        $this->controllerService->setFileCreator($this->fileCreator);
        $this->controllerService->setStringService($this->string);
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setInjector($this->injector);
        $this->controllerService->setCode($this->code->reveal());
        $this->controllerService->setFactoryService($this->factoryService->reveal());
        $this->controllerService->setArrayService($this->arrayService);

        $this->controllerDependency = new \Gear\Creator\ControllerDependency();
        $this->controllerService->setControllerDependency($this->controllerDependency);

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

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getExtends($controller)->willReturn('AbstractActionController')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getNamespace($controller)->willReturn('MyModule\Controller')->shouldBeCalled();

        $this->factoryService->createFactory($controller, vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $file = $this->controllerService->buildController($controller);

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

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getUseAttribute($controller)->willReturn('')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getFunctionsNameFromFile(vfsStream::url('module/src/MyModule/Controller/MyController.php'))->willReturn([***REMOVED***)->shouldBeCalled();

        $file = $this->controllerService->buildAction($controller);

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

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getUseAttribute($controller)->willReturn('')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getFunctionsNameFromFile(vfsStream::url('module/src/MyModule/Controller/MyController.php'))->willReturn([***REMOVED***)->shouldBeCalled();

        $file = $this->controllerService->buildAction($controller);

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

        $this->code->getLocation($controller)->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->code->getUseAttribute($controller)->willReturn('')->shouldBeCalled();
        $this->code->getUse($controller)->willReturn('use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL)->shouldBeCalled();
        $this->code->getFunctionsNameFromFile(vfsStream::url('module/src/MyModule/Controller/MyController.php'))->willReturn([***REMOVED***)->shouldBeCalled();

        $file = $this->controllerService->buildAction($controller);

        $expected = $this->templates.'/CreateController.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }


    public function testCreateModuleController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $file = $this->controllerService->module();

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

        $file = $this->controllerService->moduleFactory();

        $expected = $this->template.'/IndexControllerFactory.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }


    public function tables()
    {
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
        $this->controllerService->setControllerTestService($this->testing->reveal());

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $this->string->str('class', $tableName)***REMOVED***);//MyController'***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);

        $this->controllerService->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);

        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->controllerService->setTableService($this->table->reveal());

        $controller = new \GearJson\Controller\Controller([
            'name' => $this->string->str('class', $tableName).'Controller',
            'object' => '%s/Controller/'.$this->string->str('class', $tableName).'Controller'
        ***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getControllerByDb($this->db)->willReturn($controller);
        $this->controllerService->setSchemaService($schemaService->reveal());

        $file = $this->controllerService->introspectFromTable($this->db);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }

    public function controller()
    {
        return $this->getControllerScope('Action');
    }

    /**
     * @group src-mvc
     * @group src-mvc-controller
     * @dataProvider controller
     */
    public function testConstructController($controller, $expected)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('Controller')->willReturn(vfsStream::url('module'));
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module'));

        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setControllerDependency($this->controllerDependency);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        $this->controllerService->setCode($this->code);

        $file = $this->controllerService->buildController($controller);

        if (!empty($controller->getActions())) {

            foreach ($controller->getActions() as $action) {
                $this->controllerService->buildAction($action);
            }
        }

        $expected = $this->templates.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
