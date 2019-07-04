<?php
namespace GearTest\MvcTest\ControllerTest\ConsoleTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Vector\ArrayService;
use Gear\Util\String\StringService;
use Gear\Mvc\Controller\Console\ConsoleControllerTestService;
use Gear\Module;
use Gear\Creator\Injector\Injector;
use Gear\Code\CodeTest;
use Gear\Mvc\TraitTestService;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ControllerScopeTrait;
use Gear\Schema\Controller\Controller;
use GearTest\UtilTestTrait;
use Gear\Util\Dir\DirService;
use Gear\Table\TableService\TableService;

/**
 * @group Fix4
 */
class ConsoleControllerTestTest extends TestCase
{
    use UtilTestTrait;

    use ControllerScopeTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('test')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit/MyModuleTest')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit/MyModuleTest/ControllerTest')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/test/unit/MyModuleTest/ControllerTest');

        $this->module = $this->prophesize(ModuleStructure::class);

        $this->string = new StringService();

        $this->dirService = new DirService();
;
        $this->fileCreator    = $this->createFileCreator();

        $this->template = (new Module())->getLocation().'/../test/template/module/mvc/console-test';

        $this->array = new ArrayService();

        $this->codeTest = new CodeTest(
            $this->module->reveal(),
            $this->string,
            $this->dirService,
            $this->array
        );
        $this->injector = new Injector($this->array);

        $this->controller = new ConsoleControllerTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->codeTest,
            $this->prophesize(TableService::class)->reveal(),
            $this->injector
        );


        //$this->controller->setArrayService($this->array);


        // $this->factoryService = $this->prophesize(FactoryTestService::class);
        // $this->controller->setFactoryTestService($this->factoryService->reveal());

        // $this->traitService = $this->prophesize(TraitTestService::class);
        // $this->controller->setTraitTestService($this->traitService->reveal());
    }

    /**
     * @group fix-dependency3
     */
    public function testCreateConsoleControllerTestWithSpecialDependency()
    {
        $controller = new Controller(require __DIR__.'/../../_gearfiles/console-with-special-dependency.php');

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('ControllerTest')->willReturn(vfsStream::url('module'));
        $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module'));
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module'));


        $file = $this->controller->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controller->buildAction($controller);
        }

        $expected = $this->template.'/src/console-with-special-dependency.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

    public function testCreateModuleController()
    {
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest/ControllerTest'))->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->controller->module();

        $expected = $this->template.'/module/IndexControllerTest.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateModuleControllerFactory()
    {
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest/ControllerTest'))->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->controller->moduleFactory();

        $expected = $this->template.'/module/IndexControllerFactoryTest.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function controller()
    {
        return $this->getControllerScope('Console');
    }

    /**
     * @group src-mvc
     * @group src-mvc-console-test
     * @dataProvider controller
     */
    public function testConstructControllerTest($controller, $expected)
    {
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('ControllerTest')->willReturn(vfsStream::url('module'));
        $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module'));
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module'));

        $file = $this->controller->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controller->buildAction($controller);
        }

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
