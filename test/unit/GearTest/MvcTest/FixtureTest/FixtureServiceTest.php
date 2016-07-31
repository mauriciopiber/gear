<?php
namespace GearTest\MvcTest\FixtureTest;

use GearBaseTest\AbstractTestCase;
use GearTest\SingleDbTableTrait;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-controller
 */
class FixtureServiceTest extends AbstractTestCase
{
    use SingleDbTableTrait;


    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->string = new \GearBase\Util\String\StringService();
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);
    }


    public function tables()
    {
        return [[$this->getSingleColumns(), 'single-db'***REMOVED******REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringSrc
     */
    public function testCreateCreateControllerDb($columns, $template)
    {
        $this->templates = (new \Gear\Module)->getLocation().'/../../test/template/module/mvc/fixture/db';

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getFixtureFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => 'SingleDbTable'***REMOVED***);

        $this->fixture = new \Gear\Mvc\Fixture\FixtureService();
        $this->fixture->setFileCreator($this->fileCreator);
        $this->fixture->setStringService($this->string);
        $this->fixture->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        $this->fixture->setColumnService($this->column->reveal());
        /**


        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(false);
        $this->column->renderColumnPart('staticTest')->willReturn('');
        $this->column->renderColumnPart('insertArray')->willReturn('');
        //$this->column->renderColumnPart('insertArray', false, true)->willReturn('');
        $this->column->renderColumnPart('insertAssert')->willReturn('');
        $this->column->renderColumnPart('insertAssert', false, true)->willReturn('');
        $this->column->renderColumnPart('insertSelect')->willReturn('');
        $this->column->renderColumnPart('updateArray')->willReturn('');
        $this->column->renderColumnPart('updateAssert', false, true)->willReturn('');

        */


        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getPrimaryKeyColumns('SingleDbTable')->willReturn(['id_single_db_table'***REMOVED***);
        $this->table->getForeignKeys($this->db)->willReturn([***REMOVED***);

        //$this->table->getReferencedTableValidColumnName($this->db->getTable())->willReturn('idTable');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);
        //$this->table->isNullable($this->db->getTable())->willReturn($nullable);
        $this->fixture->setTableService($this->table->reveal());

        $service = new \GearJson\Src\Src(['name' => 'TableFixture', 'type' => 'Fixture'***REMOVED***);


        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Fixture')->willReturn($service);
        $this->fixture->setSchemaService($schemaService->reveal());

        $srcDependency = new \Gear\Creator\SrcDependency;
        $this->fixture->setSrcDependency($srcDependency);

        $this->code = new \Gear\Creator\Code();
        $this->code->setSrcDependency($srcDependency);
        $this->fixture->setCode($this->code);



        //$this->service->setTraitTestService($this->traitTestService->reveal());


        //$this->service->setFactoryService

        $file = $this->fixture->introspectFromTable($this->db);

        $expected = $this->templates.'/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
