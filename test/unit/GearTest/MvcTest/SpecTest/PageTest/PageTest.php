<?php
namespace GearTest\MvcTest\SpecTest\PageTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group Spec
 */
class PageTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');
        vfsStream::newDirectory('public')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec/e2e')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('public/js/spec/e2e/index')->at(vfsStreamWrapper::getRoot());

        $this->assertFileExists('vfs://module/public/js/spec/e2e/index');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getPublicJsSpecEndFolder()
          ->willReturn(vfsStream::url('module/public/js/spec/e2e'))
          ->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/spec';
    }

    public function testCreateIndexFeature()
    {
        $feature = new \Gear\Mvc\Spec\Page\Page();
        $feature->setModule($this->module->reveal());
        $feature->setStringService($this->string);
        $feature->setFileCreator($this->fileCreator);


        $file = $feature->createIndexPage();

        $expected = $this->template.'/module.page.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
