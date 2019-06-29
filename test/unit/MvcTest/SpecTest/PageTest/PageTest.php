<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;

/**
 * @group Spec
 */
class PageTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec/e2e')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec/e2e/index')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/public/js/spec/e2e/index');

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getPublicJsSpecEndFolder()
          ->willReturn(vfsStream::url('module/public/js/spec/e2e'))
          ->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \Gear\Util\String\StringService();

        $this->template = (new \Gear\Module())->getLocation().'/../test/template/module/mvc/spec';
    }

    public function testCreateIndexFeature()
    {
        $feature = new \Gear\Mvc\Spec\Page\Page(
            $this->module->reveal(),
            $this->createFileCreator(),
            $this->string,
            $this->createCode(),
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->createTableService(),
            $this->createArrayService(),
            $this->createInjector()
        );



        $file = $feature->createIndexPage();

        $expected = $this->template.'/module.page.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
