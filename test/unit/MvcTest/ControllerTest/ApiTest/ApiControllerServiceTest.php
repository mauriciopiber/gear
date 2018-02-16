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

/**
 * @group Service
 */
class ApiControllerServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->string = new StringService();
        $this->code = $this->prophesize(Code::class);
        $this->fileCreator = $this->createFileCreator();

        $this->service = new ApiControllerService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->code->reveal()
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
}
