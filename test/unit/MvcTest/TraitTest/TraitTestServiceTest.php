<?php
namespace GearTest\ServiceTest\MvcTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Schema\Src\Src;
use Gear\Mvc\TraitTestService;
use Gear\Module;
use Gear\Module\Structure\ModuleStructure;
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

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->module->getModuleName()->willReturn('GearIt');

        $this->baseDir = (new Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../view');

        $this->templates = $this->baseDir.'/../test/template/module/mvc/trait';

        $stringService  = new StringService();
        $fileCreator    = $this->createFileCreator();


        $this->traitTest = new TraitTestService(
            $this->module->reveal(),
            $fileCreator,
            $stringService,
            $this->createCodeTest(),
            $this->createTableService(),
            $this->createInjector()
        );
    }

    /**
     * @covers Gear\Mvc\TraitTestService::createTraitTest
     */
    public function testCreateTraitTest()
    {
        $this->module->getNamespace()->willReturn('GearIt')->shouldBeCalled();
        $this->module->map('ServiceTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $src = new Src([
            'name' => 'MyService',
            'type' => 'Service'
        ***REMOVED***);

        $link = $this->traitTest->createTraitTest($src);

        $this->assertEquals('vfs://module/MyServiceTraitTest.php', $link);

        $this->assertEquals(file_get_contents($this->templates.'/name-type.phtml'), file_get_contents($link));
    }

    public function testDependency()
    {
        $this->assertInstanceOf(ModuleStructure::class, $this->traitTest->getModule());
        $this->assertInstanceOf('Gear\Creator\FileCreator\FileCreator', $this->traitTest->getFileCreator());
        $this->assertInstanceOf('Gear\Code\CodeTest', $this->traitTest->getCodeTest());
    }

}
