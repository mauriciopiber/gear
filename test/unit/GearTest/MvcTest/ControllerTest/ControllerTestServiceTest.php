<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\SingleDbTableTrait;
use GearTest\ControllerScopeTrait;

/**
 * @group Controller
 * @group Fix3
 */
class ControllerTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use SingleDbTableTrait;
    use ControllerScopeTrait;

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

        $this->controllerTest = new \Gear\Mvc\Controller\ControllerTestService();
        $this->controllerTest->setFileCreator($this->fileCreator);
        $this->controllerTest->setStringService($this->string);
        $this->controllerTest->setModule($this->module->reveal());
        $this->controllerTest->setInjector($this->injector);
        $this->controllerTest->setCodeTest($this->codeTest->reveal());
        $this->controllerTest->setFactoryTestService($this->factoryTestService->reveal());

        $this->controllerDependency = new \Gear\Creator\ControllerDependency();
        $this->controllerDependency->setStringService($this->string);
        $this->controllerDependency->setModule($this->module->reveal());
    }

    public function testCreateTestController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $controller = new \GearJson\Controller\Controller([
            'name' => 'MyController',
            'object' => '%s\Controller\MyController',
            'service' => 'factories'
        ***REMOVED***);

        $this->factoryTestService->createControllerFactoryTest(
            $controller,
            vfsStream::url($this->vfsLocation)
        )->shouldBeCalled();

        $this->codeTest->getLocation($controller)->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $this->codeTest->getNamespace($controller)->willReturn('ControllerTest')->shouldBeCalled();
        $this->codeTest->getTestNamespace($controller)->willReturn('Controller')->shouldBeCalled();

        $file = $this->controllerTest->buildController($controller);


        $expected = $this->templates.'/CreateTestController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

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

        $file = $this->controllerTest->buildAction($controller);


        $expected = $this->templates.'/CreateTestController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @group now11
     */
    public function testCreateTestActionController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        file_put_contents(
            vfsStream::url($this->vfsLocation.'/MyControllerTest.php'),
            file_get_contents($this->templates.'/CreateTestController.phtml')
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

        $fileInject = file_get_contents(vfsStream::url($this->vfsLocation.'/MyControllerTest.php'));
        $fileExplode = explode(PHP_EOL, $fileInject);

        $this->codeTest->getFunctionsNameFromFile(vfsStream::url($this->vfsLocation.'/MyControllerTest.php'))->willReturn([***REMOVED***)->shouldBeCalled();
        $this->codeTest->getDependencyToInject($controller, $fileExplode)->willReturn([***REMOVED***)->shouldBeCalled();

        $this->codeTest->getLocation($controller)->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $file = $this->controllerTest->buildAction($controller);


        $expected = $this->templates.'/CreateTestActionController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
         );
    }

    /**
    public function testCreateTestMultipleActionController()
    {

    }
    */

    public function testCreateModuleController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $file = $this->controllerTest->module();

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

        $file = $this->controllerTest->moduleFactory();

        $expected = $this->template.'/IndexControllerFactoryTest.phtml';

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
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $this->string->str('class', $tableName)***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);
        $this->column->renderColumnPart('staticTest')->willReturn('');

        $this->controllerTest->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->controllerTest->setTableService($this->table->reveal());

        $controller = new \GearJson\Controller\Controller([
            'name' => $this->string->str('class', $tableName).'Controller',
            'object' => '%s/Controller/'.$this->string->str('class', $tableName).'Controller'
        ***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getControllerByDb($this->db)->willReturn($controller);

        $this->controllerTest->setSchemaService($schemaService->reveal());

        $file = $this->controllerTest->introspectFromTable($this->db);

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
     * @group src-mvc-controller-test
     * @dataProvider controller
     */
    public function testConstructControllerTest($controller, $expected)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('ControllerTest')->willReturn(vfsStream::url('module'));
        $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module'));

        $this->codeTest = new \Gear\Creator\CodeTest();
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setControllerDependency($this->controllerDependency);
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());

        $this->controllerTest->setCodeTest($this->codeTest);

        $file = $this->controllerTest->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controllerTest->buildAction($controller);
        }

        $expected = $this->templates.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
