<?php
namespace GearTest\MvcTest\ControllerTest\WebTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ControllerScopeTrait;
use GearTest\MvcTest\ControllerTest\WebTest\ControllerDataTrait;
use GearTest\UtilTestTrait;
use Gear\Column\ColumnManager;
use Gear\Creator\Injector\Injector;

/**
 * @group Controller
 * @group fix8
 * @group Fix3
 * @group db-controller
 */
class WebControllerTestServiceTest extends TestCase
{
    use UtilTestTrait;
    use ControllerDataTrait;
    use ControllerScopeTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/test/unit/MyModuleTest/ControllerTest';
        $this->createVirtualDir($this->vfsLocation);


        $this->templates =  (new \Gear\Module())->getLocation().'/../test/template/module/mvc/controller-test';

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->string = new \Gear\Util\String\StringService();
        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->codeTest = $this->createCodeTest();
        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->fileCreator = $this->createFileCreator();

        $this->injector = new Injector($this->arrayService);

        $this->controllerTest = new \Gear\Mvc\Controller\Web\WebControllerTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->codeTest,
            $this->table->reveal(),
            $this->injector
        );


        $this->schemaService = $this->prophesize('Gear\Schema\Schema\SchemaService');
        $this->controllerTest->setSchemaService($this->schemaService->reveal());

        $uploadImage = new \Gear\Table\UploadImage(
            $this->string,
            $this->module->reveal()
        );

        $this->controllerTest->setUploadImage($uploadImage);

    }

    public function testCreateModuleController()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $file = $this->controllerTest->module();

        $expected = $this->templates.'/module/IndexControllerTest.phtml';



        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateModuleControllerFactory()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url($this->vfsLocation))->shouldBeCalled();

        $file = $this->controllerTest->moduleFactory();

        $expected = $this->templates.'/module/IndexControllerFactoryTest.phtml';

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
                sprintf('%s\%sSearchForm',  ($namespace !== null) ? $namespace : 'Form\Search', $table)
            ***REMOVED***,
            'db' => $this->string->str('class', $tableName),
            'user' => $userType
        ***REMOVED***);

        $this->db = new \Gear\Schema\Db\Db(
            [
                'table' => $this->string->str('class', $tableName),
                'user' => $userType
            ***REMOVED***
        );

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();


        if ($namespace !== null) {

            $location = 'module/test/unit/MyModuleTest';

            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url($location))->shouldBeCalled();

            $data = explode('\\', $namespace);

            foreach ($data as $item) {
                $location .= '/'.$item.'Test';
            }

        } else {

            $location = $this->vfsLocation;
            $this->module->map('ControllerTest')->willReturn(vfsStream::url($location))->shouldBeCalled();
        }

        $this->db->setColumnManager(new ColumnManager($columns));

        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn($hasTableImage)->shouldBeCalled();

        $this->schemaService->getControllerByDb($this->db)->willReturn($controller)->shouldBeCalled();

        $this->service = $this->prophesize('Gear\Schema\Src\Src');
        $this->service->getName()->willReturn(sprintf('%sService', $table));
        $this->service->getType()->willReturn('Service');
        $this->service->getNamespace()->willReturn($namespace);

        $this->schemaService->getSrcByDb($this->db, 'Service')->willReturn($this->service->reveal())->shouldBeCalled();

        $this->form = $this->prophesize('Gear\Schema\Src\Src');
        $this->form->getName()->willReturn(sprintf('%sForm', $table));
        $this->form->getType()->willReturn('Form');
        $this->form->getNamespace()->willReturn($namespace);

        $this->schemaService->getSrcByDb($this->db, 'Form')->willReturn($this->form->reveal())->shouldBeCalled();

        $this->search  = $this->prophesize('Gear\Schema\Src\Src');
        $this->search->getName()->willReturn(sprintf('%sSearchForm', $table));
        $this->search->getType()->willReturn('SearchForm');
        $this->search->getNamespace()->willReturn($namespace);

        $this->schemaService->getSrcByDb($this->db, 'SearchForm')->willReturn($this->search->reveal())->shouldBeCalled();

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        //$this->factoryTest->createControllerFactoryTest($controller)->shouldBeCalled();

        $file = $this->controllerTest->introspectFromTable($this->db);

        $expected = $this->templates.'/db/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$controller->getName().'Test.php', $file);

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
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
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
