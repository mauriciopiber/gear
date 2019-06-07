<?php
namespace GearTest\MvcTest\ControllerTest\ConsoleTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ControllerScopeTrait;
use Gear\Schema\Controller\Controller;
use GearTest\UtilTestTrait;

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

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->string = new \Gear\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/console-test';

        $this->controller = new \Gear\Mvc\Controller\Console\ConsoleControllerTestService();
        $this->controller->setFileCreator($this->fileCreator);
        $this->controller->setStringService($this->string);
        $this->controller->setModule($this->module->reveal());


        $this->array = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\Injector\Injector($this->array);

        $this->controller->setInjector($this->injector);

        $this->controller->setArrayService($this->array);


        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->controller->setFactoryTestService($this->factoryService->reveal());

        $this->traitService = $this->prophesize('Gear\Mvc\TraitTestService');
        $this->controller->setTraitTestService($this->traitService->reveal());
    }

    /**
     * @group fix-dependency3
     */
    public function testCreateConsoleControllerTestWithSpecialDependency()
    {
        $controller = new Controller(require __DIR__.'/../../_gearfiles/console-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('ControllerTest')->willReturn(vfsStream::url('module'));
        $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module'));
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module'));

        $this->codeTest = new \Gear\Creator\CodeTest();
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setDirService(new \Gear\Util\Dir\DirService());
        $this->codeTest->setArrayService($this->array);

        $this->controllerManager = new \Gear\Mvc\Config\ControllerManager();
        $this->controllerManager->setModule($this->module->reveal());

        $this->controller->setControllerManager($this->controllerManager);

        $this->controller->setCodeTest($this->codeTest);

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
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

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
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

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
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('ControllerTest')->willReturn(vfsStream::url('module'));
        $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module'));
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module'));

        $this->codeTest = new \Gear\Creator\CodeTest();
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());
        $this->codeTest->setDirService(new \Gear\Util\Dir\DirService());
        $this->codeTest->setArrayService($this->array);

        $this->controllerManager = new \Gear\Mvc\Config\ControllerManager();
        $this->controllerManager->setModule($this->module->reveal());

        $this->controller->setControllerManager($this->controllerManager);

        $this->controller->setCodeTest($this->codeTest);

        $file = $this->controller->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controller->buildAction($controller);
        }

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
