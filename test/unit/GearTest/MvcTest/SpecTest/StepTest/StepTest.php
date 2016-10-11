<?php
namespace GearTest\MvcTest\SpecTest\StepTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearJson\Db\Db;
use GearTest\AllColumnsDbTableTrait;

/**
 * @group Spec
 * @group Service
 */
class StepTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;

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



        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));

        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/step';
    }

    /**
     * @group n1s
     */
    public function testCreateIndexFeature()
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $feature = new \Gear\Mvc\Spec\Step\Step();
        $feature->setModule($this->module->reveal());
        $feature->setStringService($this->string);
        $feature->setFileCreator($this->fileCreator);

        $file = $feature->createIndexStep();

        $expected = $this->template.'/module.step.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function testCreateTableFeature()
    {
        $db = new Db(['table' => 'MyController'***REMOVED***);

        $this->feature = new \Gear\Mvc\Spec\Step\Step();
        $this->feature->setModule($this->module->reveal());
        $this->feature->setStringService($this->string);
        $this->feature->setFileCreator($this->fileCreator);


        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($this->getAllPossibleColumns())->shouldBeCalled();

        $this->feature->setDirService(new \GearBase\Util\Dir\DirService());
        $this->feature->setColumnService($this->column->reveal());

        $file = $this->feature->createTableStep($db);

        $expected = $this->template.'/table.stepDefinitions.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
