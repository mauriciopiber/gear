<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Controller\Api\ApiControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Code\CodeTest;
use Gear\Creator\FileCreator\FileCreator;
use GearTest\UtilTestTrait;
use Gear\Module;
use org\bovigo\vfs\vfsStream;
use GearTest\ApiControllerScopeTrait;
use Gear\Mvc\Config\ControllerManager;
use Gear\Creator\Injector\Injector;
use Gear\Util\Vector\ArrayService;
use Gear\Mvc\Factory\FactoryTestService;

/**
 * @group Service
 */
class ApiControllerTestServiceTest extends TestCase
{
    use ApiControllerScopeTrait;

    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->string = new StringService();
        $this->codeTest = $this->prophesize(CodeTest::class);
        $this->fileCreator = $this->createFileCreator();


        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new Injector($this->arrayService);

        $this->factoryService = $this->prophesize(FactoryTestService::class);

        $this->controllerManager = $this->prophesize(ControllerManager::class);


        $this->service = new ApiControllerTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->codeTest->reveal(),
            $this->factoryService->reveal(),
            $this->controllerManager->reveal(),
            $this->injector
        );

        $this->template = Module::LOCATION.'/../test/template/module/mvc/rest-test';

        $this->root = vfsStream::setUp('module');
        $this->test = vfsStream::newDirectory('test')->at($this->root);
        $this->unit = vfsStream::newDirectory('unit')->at($this->test);
        $this->location = vfsStream::newDirectory('ControllerTest')->at($this->unit);
    }

    /**
     * @group rest
     * @group rest3
     */
    public function testCreateModule()
    {
        $fileName = $this->template.'/module/module.phtml';

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()
            ->willReturn(vfsStream::url('module/test/unit/ControllerTest'))
            ->shouldBeCalled();

        $file = $this->service->module();

        $this->assertEquals(
            file_get_contents($fileName),
            file_get_contents($file)
        );
    }

    /**
     * @group rest
     * @group rest4
     */
    public function testCreateModuleFactory()
    {
        $fileName = $this->template.'/module/module-factory.phtml';

        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()
            ->willReturn(vfsStream::url('module/test/unit/ControllerTest'))
            ->shouldBeCalled();
        $file = $this->service->moduleFactory();

        $this->assertEquals(
            file_get_contents($fileName),
            file_get_contents($file)
        );
    }


    public function controller()
    {
        return $this->getControllerScope('Rest');
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

        $this->codeTest = new \Gear\Code\CodeTest(
            $this->module->reveal(),
            $this->string,
            new \Gear\Util\Dir\DirService(),
            new \Gear\Util\Vector\ArrayService()
        );
        //$this->codeTest->setArrayService($this->array);


        //$this->service->setControllerManager($this->serviceManager);

        $this->service->setCodeTest($this->codeTest);

        $file = $this->service->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->service->buildAction($controller);
        }

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
