<?php
namespace GearTest\ServiceTest\MvcTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Mvc
 * @group Trait
 */
class TraitTestServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $phpRenderer = $this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view');

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $stringService = $this->prophesize('GearBase\Util\String\StringService');

        $this->traitTest = new \Gear\Mvc\TraitTestService(
            $module->reveal(),
            $fileCreator,
            $stringService->reveal()
        );
    }

    /**
     * @covers Gear\Mvc\TraitTestService::createTraitTest
     */
    public function testCreateTraitTest()
    {
        $src = new \GearJson\Src\Src([
            'name' => 'MyTraitClass',
            'type' => 'Service'
        ***REMOVED***);

        $link = $this->traitTest->createTraitTest($src, vfsStream::url('module'));

        var_dump($link);
        die();
    }

    public function testDependency()
    {
        $this->assertInstanceOf('Gear\Module\BasicModuleStructure', $this->traitTest->getModule());
        $this->assertInstanceOf('Gear\Creator\File', $this->traitTest->getFileCreator());
    }

}
