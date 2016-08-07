<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\SingleDbTableTrait;
use GearTest\ControllerScopeTrait;

/**
 * @group Fixing
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

        $this->template =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/controller';


        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);

        $this->controllerService = new \Gear\Mvc\Controller\ControllerService();
        $this->controllerService->setFileCreator($this->fileCreator);
        $this->controllerService->setStringService($this->string);
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setInjector($this->injector);

        $this->controllerService->setFactoryService($this->factoryService->reveal());
        $this->controllerService->setArrayService($this->arrayService);

        $this->controllerDependency = new \Gear\Creator\ControllerDependency();
        $this->controllerService->setControllerDependency($this->controllerDependency);


        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setControllerDependency($this->controllerDependency);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        $this->controllerService->setCode($this->code);
    }

    public function testCreateModuleController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();

        $file = $this->controllerService->module();

        $expected = $this->template.'/module/IndexController.phtml';

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

        $expected = $this->template.'/module/IndexControllerFactory.phtml';

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

        $expected = $this->template.'/'.$template.'.phtml';

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

        $this->controllerService->setCode($this->code);

        $file = $this->controllerService->buildController($controller);

        if (!empty($controller->getActions())) {

            $this->controllerService->buildAction($controller);

        }

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
