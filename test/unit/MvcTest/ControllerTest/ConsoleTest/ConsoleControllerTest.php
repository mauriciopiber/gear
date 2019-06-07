<?php
namespace GearTest\MvcTest\ControllerTest\ConsoleTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ControllerScopeTrait;
use Gear\Schema\Controller\Controller;
use Gear\Creator\Component\Constructor\ConstructorParams;
use GearTest\UtilTestTrait;

/**
 * @group Fix2
 */
class ConsoleControllerTest extends TestCase
{
    use UtilTestTrait;

    use ControllerScopeTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('src')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule/Controller')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/src/MyModule/Controller');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->string = new \Gear\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view'));

        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/console';

        $this->controller = new \Gear\Mvc\Controller\Console\ConsoleControllerService();
        $this->controller->setFileCreator($this->fileCreator);
        $this->controller->setStringService($this->string);
        $this->controller->setModule($this->module->reveal());

        $this->array = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\Injector\Injector($this->array);

        $this->controller->setInjector($this->injector);
        $this->controller->setArrayService($this->array);

        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->controller->setFactoryService($this->factoryService->reveal());

        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');
        $this->controller->setTraitService($this->traitService->reveal());

        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setDirService(new \Gear\Util\Dir\DirService());
        $this->code->setArrayService($this->array);
        $this->controller->setCode($this->code);

        $constructorParams = new ConstructorParams($this->string);
        $this->code->setConstructorParams($constructorParams);
    }


    /**
     * @group fix-dependency3
     */
    public function testCreateConsoleControllerWithSpecialDependency()
    {
        $controller = new Controller(require __DIR__.'/../../_gearfiles/console-with-special-dependency.php');

        $this->module->getControllerFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('Controller')->willReturn(vfsStream::url('module'));
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module'));



        $file = $this->controller->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controller->buildAction($controller);
        }

        $expected = $this->template.'/src/console-with-special-dependency.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));

    }

    public function testCreateModuleController()
    {
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->controller->module();

        $expected = $this->template.'/module/IndexController.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateModuleControllerFactory()
    {
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/MyModule/Controller'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->controller->moduleFactory();

        $expected = $this->template.'/module/IndexControllerFactory.phtml';

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
     * @group src-mvc-console
     * @dataProvider controller
     */
    public function testConstructConsoleController($controller, $expected)
    {
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('Controller')->willReturn(vfsStream::url('module'));
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module'));

        $this->controller->setCode($this->code);

        $file = $this->controller->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->controller->buildAction($controller);
        }

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }

}

