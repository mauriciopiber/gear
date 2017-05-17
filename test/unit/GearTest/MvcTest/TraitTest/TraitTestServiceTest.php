<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group mvc-trait
 */
class TraitTestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->templates = $this->baseDir.'/../../test/template/module/mvc/trait';

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $codeTest = new \Gear\Creator\CodeTest();
        $codeTest->setModule($module->reveal());

        $this->traitTest = new \Gear\Mvc\TraitTestService(
            $module->reveal(),
            $fileCreator,
            $stringService,
            $codeTest
        );
    }

    /**
     * @covers Gear\Mvc\TraitTestService::createTraitTest
     */
    public function testCreateTraitTest()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyService',
            'type' => 'Service'
        ***REMOVED***);

        $link = $this->traitTest->createTraitTest($src, vfsStream::url('module'));

        $this->assertEquals('vfs://module/MyServiceTraitTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/name-type.phtml'), file_get_contents($link));
    }

    public function testDependency()
    {
        $this->assertInstanceOf('Gear\Module\BasicModuleStructure', $this->traitTest->getModule());
        $this->assertInstanceOf('Gear\Creator\File', $this->traitTest->getFileCreator());
        $this->assertInstanceOf('Gear\Creator\CodeTest', $this->traitTest->getCodeTest());
    }

}
