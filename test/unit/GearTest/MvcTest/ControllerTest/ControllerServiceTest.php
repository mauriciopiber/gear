<?php
namespace GearTest\MvcTest\ControllerTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use GearBase\Util\String\StringService;
use GearBase\Util\File\FileService;
use Gear\Module;
use Gear\Mvc\Controller\ControllerService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\Template\TemplateService;
use Gear\Creator\Injector\Injector;
use Gear\Creator\ControllerDependency;
use Gear\Creator\Code;
use Gear\Util\Vector\ArrayService;
use GearTest\MvcTest\ControllerTest\ControllerDataTrait;
use GearTest\UtilTestTrait;
use GearTest\ControllerScopeTrait;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;

/**
 * @group Fixing
 * @group fix8
 * @group Controller
 * @group db-controller
 */
class ControllerServiceTest extends TestCase
{
    use UtilTestTrait;
    use ControllerDataTrait;
    use ControllerScopeTrait;

    public function setUp()
    {
        parent::setUp();
        $this->vfsLocation = 'module/src/MyModule/Controller';
        $this->createVirtualDir($this->vfsLocation);
        $this->assertFileExists(vfsStream::url($this->vfsLocation));

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');


        $this->arrayService = new ArrayService();

        $this->string = new StringService();

        $template       = new TemplateService();

        $templatePath = (new Module)->getLocation().'/../../view';

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
        $fileService    = new FileService();
        $this->fileCreator    = new FileCreator($fileService, $template);

        $this->template =  (new Module())->getLocation().'/../../test/template/module/mvc/controller';


        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');


        $this->injector = new Injector($this->arrayService);

        $this->controllerService = new ControllerService();
        $this->controllerService->setFileCreator($this->fileCreator);
        $this->controllerService->setStringService($this->string);
        $this->controllerService->setModule($this->module->reveal());
        $this->controllerService->setInjector($this->injector);

        $this->controllerService->setFactoryService($this->factory->reveal());
        $this->controllerService->setArrayService($this->arrayService);


        $this->code = new Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        $constructorParams = new ConstructorParams($this->string);
        $this->code->setConstructorParams($constructorParams);

        $this->controllerService->setCode($this->code);

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->controllerService->setTableService($this->table->reveal());

        $this->testing = $this->prophesize('Gear\Mvc\Controller\ControllerTestService');
        $this->controllerService->setControllerTestService($this->testing->reveal());

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->controllerService->setSchemaService($this->schema->reveal());

        $uploadImage = new \Gear\Table\UploadImage(
            $this->string,
            $this->module->reveal()
        );

        $this->controllerService->setUploadImage($uploadImage);
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
     * @group mvc
     * @group mvc-controller
     */
    public function testInstrospectTable(
        $columns,
        $template,
        $nullable,
        $hasColumnImage,
        $hasTableImage,
        $tableName,
        $service,
        $namespace,
        $userType
    ) {
        $table = $this->string->str('class', $tableName);

        $controller = new \GearJson\Controller\Controller([
            'name' => $this->string->str('class', $tableName).'Controller',
            'namespace' => $namespace,
            'service' => $service,
            'dependency' => [
                sprintf('%s\%sService', ($namespace !== null) ? $namespace : 'Service', $table),
                sprintf('%s\%sForm', ($namespace !== null) ? $namespace : 'Form', $table),
                sprintf('%s\%sForm', ($namespace !== null) ? $namespace : 'Form', $table),
                sprintf('%s\%sSearchForm',  ($namespace !== null) ? $namespace : 'Form\Search', $table)
            ***REMOVED***,
            'user' => $userType,
            'db' =>  $this->string->str('class', $tableName)
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

        $this->db = new \GearJson\Db\Db(
            [
                'table' => $this->string->str('class', $tableName),
                'user' => $userType
            ***REMOVED***
        );

        $this->db->setColumnManager(new ColumnManager($columns));

        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')
            ->willReturn($hasTableImage)
            ->shouldBeCalled();

        $this->schema->getControllerByDb($this->db)->willReturn($controller)->shouldBeCalled();

        $this->factory->createFactory($controller)->shouldBeCalled();

        $this->testing->introspectFromTable($this->db)->shouldBeCalled();

        $file = $this->controllerService->introspectFromTable($this->db);

        $expected = $this->template.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$controller->getName().'.php', $file);
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
