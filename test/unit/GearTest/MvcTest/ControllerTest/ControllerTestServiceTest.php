<?php
namespace GearTest\MvcTest\ControllerTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ControllerScopeTrait;
use GearTest\MvcTest\ControllerTest\ControllerDataTrait;

/**
 * @group Controller
 * @group fix8
 * @group Fix3
 * @group db-controller
 */
class ControllerTestServiceTest extends AbstractTestCase
{
    use ControllerDataTrait;
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

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);

        $this->controllerTest = new \Gear\Mvc\Controller\ControllerTestService();
        $this->controllerTest->setFileCreator($this->fileCreator);
        $this->controllerTest->setStringService($this->string);
        $this->controllerTest->setModule($this->module->reveal());
        $this->controllerTest->setInjector($this->injector);
        $this->controllerTest->setFactoryTestService($this->factoryTestService->reveal());

        $this->controllerDependency = new \Gear\Creator\ControllerDependency();
        $this->controllerDependency->setStringService($this->string);
        $this->controllerDependency->setModule($this->module->reveal());

        $this->codeTest = new \Gear\Creator\CodeTest();
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setControllerDependency($this->controllerDependency);
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());

        $this->controllerTest->setCodeTest($this->codeTest);

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->controllerTest->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->controllerTest->setTableService($this->table->reveal());


    }

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

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     * @group db-controller2
     */
    public function testInstrospectTable($columns, $template, $nullable, $hasColumnImage, $hasTableImage, $tableName, $service, $namespace)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => $this->string->str('class', $tableName)***REMOVED***);


        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn($hasColumnImage);
        $this->column->renderColumnPart('staticTest')->willReturn('');

        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $controller = new \GearJson\Controller\Controller([
            'name' => $this->string->str('class', $tableName).'Controller',
            'namespace' => $namespace,
            'service' => $service,
            sprintf('%s\%sService', ($namespace !== null) ? $namespace : 'Service', $table),
            sprintf('%s\%sForm', ($namespace !== null) ? $namespace : 'Form', $table),
            sprintf('%s\%sSearchForm',  ($namespace !== null) ? $namespace : 'Form\Search', $table)
        ***REMOVED***);

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schemaService->getControllerByDb($this->db)->willReturn($controller);

        $this->controllerTest->setSchemaService($this->schemaService->reveal());

        $file = $this->controllerTest->introspectFromTable($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

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

        $file = $this->controllerTest->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controllerTest->buildAction($controller);
        }

        $expected = $this->templates.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
