<?php
namespace GearTest\ServiceTest\MvcTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\UtilTestTrait;

/**
 * @group mvc-trait
 */
class TraitTestServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->templates = $this->baseDir.'/../test/template/module/mvc/trait';

        $stringService  = new \Gear\Util\String\StringService();
        $fileCreator    = $this->createFileCreator();

        $codeTest = new \Gear\Creator\CodeTest();
        $codeTest->setModule($this->module->reveal());
        $codeTest->setStringService($stringService);

        $this->traitTest = new \Gear\Mvc\TraitTestService(
            $this->module->reveal(),
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
        $this->module->map('ServiceTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $src = new \Gear\Schema\Src\Src([
            'name' => 'MyService',
            'type' => 'Service'
        ***REMOVED***);

        $link = $this->traitTest->createTraitTest($src);

        $this->assertEquals('vfs://module/MyServiceTraitTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/name-type.phtml'), file_get_contents($link));
    }

    public function testDependency()
    {
        $this->assertInstanceOf('Gear\Module\Structure\ModuleStructure', $this->traitTest->getModule());
        $this->assertInstanceOf('Gear\Creator\FileCreator\FileCreator', $this->traitTest->getFileCreator());
        $this->assertInstanceOf('Gear\Creator\CodeTest', $this->traitTest->getCodeTest());
    }

}
