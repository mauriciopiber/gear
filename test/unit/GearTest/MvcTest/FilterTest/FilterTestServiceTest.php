<?php
namespace GearTest\MvcTest\FilterTest;

use GearBaseTest\AbstractTestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group RefactoringUnitTest
 * @group src-filter
 * @group Filter1
 * @group Filter
 */
class FilterTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

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

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/filter-test';

    }


    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', true, false, 'table'***REMOVED***,
            [$this->getAllPossibleColumnsNotNull(), 'all-columns-db-not-null', false, false, 'table_not_null'***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), 'all-columns-db-unique', false, true, 'table_unique'***REMOVED***,
            [$this->getAllPossibleColumnsUniqueNotNull(), 'all-columns-db-unique-not-null', false, true, 'table_unique_not_null'***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     */
    public function testCreateDb($columns, $expect, $nullable, $unique, $tableName)
    {
        $table = $this->string->str('class', $tableName);

        $db = new \GearJson\Db\Db(['table' => sprintf('%sTable', $table)***REMOVED***);

        $this->module->getTestFilterFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \GearJson\Src\Src(['name' => sprintf('%sFilter', $table), 'type' => 'Filter'***REMOVED***);


        $this->filter = new \Gear\Mvc\Filter\FilterTestService();
        $this->filter->setStringService($this->string);
        $this->filter->setFileCreator($this->fileCreator);
        $this->filter->setModule($this->module->reveal());

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schema->getSrcByDb($db, 'Filter')->willReturn($src);

        $this->filter->setSchemaService($this->schema->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($columns);

        $this->filter->setColumnService($this->column->reveal());


        $file = $this->filter->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$expect.'.phtml'), file_get_contents($file));

    }

}
