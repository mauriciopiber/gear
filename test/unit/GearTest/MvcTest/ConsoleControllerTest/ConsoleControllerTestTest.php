<?php
namespace GearTest\MvcTest\ConsoleController;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\ControllerScopeTrait;

/**
 * @group Fix4
 */
class ConsoleControllerTestTest extends AbstractTestCase
{
    use ControllerScopeTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('test')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit/MyModuleTest')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('test/unit/MyModuleTest/ControllerTest')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/test/unit/MyModuleTest/ControllerTest');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/index-cli';

        $this->controller = new \Gear\Mvc\ConsoleController\ConsoleControllerTest();
        $this->controller->setFileCreator($this->fileCreator);
        $this->controller->setStringService($this->string);
        $this->controller->setModule($this->module->reveal());
    }

    public function testCreateModuleController()
    {
        $this->module->getTestControllerFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest/ControllerTest'))->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->controller->module();

        $expected = $this->template.'/IndexControllerTest.phtml';

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

        $expected = $this->template.'/IndexControllerFactoryTest.phtml';

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
        $this->assertTrue(true);
    }
}
