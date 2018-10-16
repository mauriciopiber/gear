<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\Structure\ModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\FileCreator\FileCreator;
use GearTest\UtilTestTrait;
use Gear\Module;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ApiControllerScopeTrait;
use Gear\Mvc\Factory\FactoryService;

/**
 * @group Service
 */
class ApiControllerServiceTest extends TestCase
{
    use ApiControllerScopeTrait;

    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('src')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('src/MyModule/Controller')->at(vfsStreamWrapper::getRoot());

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->string = new StringService();
        $this->code = $this->prophesize(Code::class);
        $this->fileCreator = $this->createFileCreator();
        $this->factoryService = $this->prophesize(FactoryService::class);

        $this->service = new ApiControllerService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code->reveal(),
            $this->factoryService->reveal()
        );

        $this->template = Module::LOCATION.'/../test/template/module/mvc/rest';

        $this->root = vfsStream::setUp('module');
        $this->src = vfsStream::newDirectory('src')->at($this->root);
        $this->location = vfsStream::newDirectory('Controller')->at($this->src);
    }

    /**
     * @group rest1
     * @group rest
     */
    public function testCreateModule()
    {
        $fileName = $this->template.'/module/module.phtml';

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/Controller'))->shouldBeCalled();
        $file = $this->service->module();

        $this->assertEquals(
            file_get_contents($fileName),
            file_get_contents($file)
        );
    }

    /**
     * @group rest
     * @group rest2
     */
    public function testCreateModuleFactory()
    {
        $fileName = $this->template.'/module/module-factory.phtml';

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module/src/Controller'))->shouldBeCalled();
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
     * @group src-mvc-console
     * @dataProvider controller
     */
    public function testConstructApiController($controller, $expected)
    {
        $this->module->getControllerFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->map('Controller')->willReturn(vfsStream::url('module'));
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module'));


        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());
        //$this->code->setArrayService($this->array);
        $this->service->setCode($this->code);
        //$this->code->getLocation()->willReturn(vfsStream::url('modul'));

        $file = $this->service->buildController($controller);

        if (!empty($controller->getActions())) {
            $this->service->buildAction($controller);
        }

        $expected = $this->template.'/src/'.$expected.'.phtml';

        $this->assertEquals(file_get_contents($expected), file_get_contents($file));
    }
}
