<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Controller\Api\ApiControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Creator\CodeTest;
use Gear\Creator\FileCreator\FileCreator;
use GearTest\UtilTestTrait;
use Gear\Module;
use org\bovigo\vfs\vfsStream;

/**
 * @group Service
 */
class ApiControllerTestServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->string = new StringService();
        $this->codeTest = $this->prophesize(CodeTest::class);
        $this->fileCreator = $this->createFileCreator();

        $this->service = new ApiControllerTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->codeTest->reveal()
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

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
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

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestControllerFolder()
            ->willReturn(vfsStream::url('module/test/unit/ControllerTest'))
            ->shouldBeCalled();
        $file = $this->service->moduleFactory();

        $this->assertEquals(
            file_get_contents($fileName),
            file_get_contents($file)
        );
    }
}
