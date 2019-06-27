<?php
namespace GearTest\MvcTest\ControllerTest\WebTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;
use Gear\Util\String\StringService;
use Gear\Util\File\FileService;
use Gear\Module;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\Template\TemplateService;
use Gear\Creator\Injector\Injector;
use Gear\Creator\ControllerDependency;
use Gear\Code\Code;
use Gear\Util\Vector\ArrayService;
use GearTest\MvcTest\ControllerTest\WebTest\ControllerDataTrait;
use GearTest\UtilTestTrait;
use GearTest\ControllerScopeTrait;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;
use Gear\Module\Structure\ModuleStructure;
use Gear\Mvc\Factory\FactoryService;
use Gear\Table\TableService\TableService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Schema\Schema\SchemaService;
use Gear\Util\Dir\DirService;
use Gear\Table\UploadImage;
use Gear\Mvc\Config\ServiceManager;

/**
 * @group Fixing
 * @group fix8
 * @group Controller
 * @group db-controller
 */
class WebControllerServiceTest extends TestCase
{
    use UtilTestTrait;
    use ControllerDataTrait;
    use ControllerScopeTrait;

    public function setUp() : void
    {
        parent::setUp();
        $this->vfsLocation = 'module/src/MyModule/Controller';
        $this->createVirtualDir($this->vfsLocation);
        $this->assertFileExists(vfsStream::url($this->vfsLocation));

        $this->fileCreator = $this->createFileCreator();
        $this->template =  (new Module())->getLocation().'/../test/template/module/mvc/controller';


        $this->module = $this->prophesize(ModuleStructure::class);
        $this->array = new ArrayService();

        $this->string = new StringService();

        $this->factory = $this->prophesize(FactoryService::class);

        $this->injector = new Injector($this->array);

        $this->code = $this->createCode();

        $this->table = $this->prophesize(TableService::class);
        //$this->controllerService->setTableService($this->table->reveal());

        $this->controllerService = new WebControllerService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code,
            $this->prophesize(DirService::class)->reveal(),
            $this->table->reveal(),
            $this->array,
            $this->injector
        );

        // $this->controllerService->setFileCreator($this->fileCreator);
        // $this->controllerService->setStringService($this->string);
        // $this->controllerService->setModule($this->module->reveal());
        // $this->controllerService->setInjector($this->injector);

        // $this->controllerService->setFactoryService($this->factory->reveal());
        // $this->controllerService->setArrayService($this->arrayService);


        // $this->code = new Code();
        // $this->code->setStringService($this->string);
        // $this->code->setModule($this->module->reveal());
        // $this->code->setDirService(new DirService());

        // $constructorParams = new ConstructorParams($this->string);
        // $this->code->setConstructorParams($constructorParams);

        // $this->controllerService->setCode($this->code);

        $this->testing = $this->prophesize(WebControllerTestService::class);
        $this->controllerService->setControllerTestService($this->testing->reveal());

        $this->schema = $this->prophesize(SchemaService::class);
        $this->controllerService->setSchemaService($this->schema->reveal());

        $uploadImage = new UploadImage(
            $this->string,
            $this->module->reveal()
        );

        $this->controllerService->setUploadImage($uploadImage);
    }

    public function testCreateModuleController()
    {
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
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
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
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

        $controller = new \Gear\Schema\Controller\Controller([
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

        $this->db = new \Gear\Schema\Db\Db(
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

        //$this->factory->createFactory($controller)->shouldBeCalled();

        //$this->testing->introspectFromTable($this->db)->shouldBeCalled();

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

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
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
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
