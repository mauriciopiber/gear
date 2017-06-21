<?php
namespace GearTest\MvcTest\SpecTest\StepTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearJson\Db\Db;
use GearTest\AllColumnsDbTableTrait;
use GearTest\UtilTestTrait;
use Gear\Module;
use Gear\Module\BasicModuleStructure;
use Gear\Mvc\Spec\Step\Step;
use GearBase\Util\String\StringService;
use GearBase\Util\Dir\DirService;
use Gear\Column\ColumnService;
use Gear\Column\ColumnManager;

/**
 * @group Spec
 * @group Service
 */
class StepTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;

    use UtilTestTrait;

    public function setUp()
    {
        parent::setUp();
        $this->createVirtualDir('module/public/js/spec/e2e/index');
        $this->assertFileExists('vfs://module/public/js/spec/e2e/index');

        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->module->getPublicJsSpecEndFolder()
          ->willReturn(vfsStream::url('module/public/js/spec/e2e'))
          ->shouldBeCalled();

        $this->string = new StringService();
        $this->fileCreator = $this->createFileCreator();

        $this->template = (new Module())->getLocation().'/../../test/template/module/mvc/step';

        $this->step = new Step();
        $this->step->setModule($this->module->reveal());
        $this->step->setStringService($this->string);
        $this->step->setFileCreator($this->fileCreator);

    }

    /**
     * @group n1s
     */
    public function testCreateIndexFeature()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $file = $this->step->createIndexStep();

        $expected = $this->template.'/module.step.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateTableFeature()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $db->setColumnManager(new ColumnManager($this->getAllPossibleColumns()));
        //$this->column = $this->prophesize(ColumnService::class);
        //$this->column->getColumns($db)->willReturn()->shouldBeCalled();

        $this->step->setDirService(new DirService());
        //$this->step->setColumnService($this->column->reveal());

        $file = $this->step->createTableStep($db);

        $expected = $this->template.'/table.stepDefinitions.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
