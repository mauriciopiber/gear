<?php
namespace GearTest\MvcTest\ControllerTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\SingleDbTableTrait;
use GearTest\ControllerScopeTrait;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use GearTest\MvcTest\ControllerTest\ControllerDataTrait;

/**
 * @group Fixing
 * @group fix8
 * @group Controller
 * @group db-controller
 */
class ControllerServiceTest extends TestCase
{
    use ControllerDataTrait;
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

        $templatePath = (new \Gear\Module)->getLocation().'/../../view';

        $resolver = new AggregateResolver();

        $map = new TemplatePathStack(array(
            'script_paths' => array(
                'template' => $templatePath,
            )
        ));

        $resolver->attach($map);

        $view = new PhpRenderer();

        $view->setResolver($resolver);

        $template->setRenderer($view);
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/controller';


        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);

        $this->controllerService = new \Gear\Mvc\Controller\ControllerService();
        $this->controllerService->setFileCreator($this->fileCreator);
        $this->controllerService->setStringService($this->string);
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setInjector($this->injector);

        $this->controllerService->setFactoryService($this->factory->reveal());
        $this->controllerService->setArrayService($this->arrayService);

        $this->controllerDependency = new \Gear\Creator\ControllerDependency();
        $this->controllerDependency->setModule($this->module->reveal());
        $this->controllerService->setControllerDependency($this->controllerDependency);


        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setControllerDependency($this->controllerDependency);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        $this->controllerService->setCode($this->code);


        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->controllerService->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->controllerService->setTableService($this->table->reveal());

        $this->testing = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');
        $this->controllerService->setControllerTestService($this->testing->reveal());

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->controllerService->setSchemaService($this->schema->reveal());
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

    /**
     * @dataProvider tables
     * @group unit-test
     * @group RefactoringUnitTest
     * @group db-docs
     * @group db-controller1
     */
    public function testInstrospectTable(
        $columns,
        $template,
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace
    ) {
        $table = $this->string->str('class', $tableName);

        $controller = new \GearJson\Controller\Controller([
            'name' => $this->string->str('class', $tableName).'Controller',
            'namespace' => $namespace,
            'service' => $service,
            'dependency' => [
                sprintf('%s\%sService', ($namespace !== null) ? $namespace : 'Service', $table),
                sprintf('%s\%sForm', ($namespace !== null) ? $namespace : 'Form', $table),
                sprintf('%s\%sSearchForm',  ($namespace !== null) ? $namespace : 'Form\Search', $table)
            ***REMOVED***
        ***REMOVED***);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if ($namespace === null) {

            $location = 'module/src/MyModule/Controller';

            $this->module->map('Controller')
                ->willReturn(vfsStream::url($location))
                ->shouldBeCalled();
        } else {

            $location = 'module/src/MyModule';

            $this->module->getSrcModuleFolder()
                ->willReturn(vfsStream::url($location))
                ->shouldBeCalled();

            $location .= '/'.str_replace('\\', '/', $namespace);
        }

        $this->db = new \GearJson\Db\Db(['table' => $this->string->str('class', $tableName)***REMOVED***);

        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')
            ->willReturn($hasTableImage)
            ->shouldBeCalled();

        $this->schema->getControllerByDb($this->db)->willReturn($controller)->shouldBeCalled();


        if ($service == 'factories') {
            $this->factory->createFactory($controller, vfsStream::url($location))->shouldBeCalled();
        }

        $this->testing->introspectFromTable($this->db)->shouldBeCalled();

        $file = $this->controllerService->introspectFromTable($this->db);

        $expected = $this->template.'/db/'.$template.'.phtml';

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

        //echo file_get_contents($file);die();

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
