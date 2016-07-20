<?php
namespace GearTest\MvcTest\FilterTest;

use GearBaseTest\AbstractTestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;

/**
 * @group src-filter
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

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/filter';

    }

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'filter-test-table'***REMOVED***
        ***REMOVED***;
    }




    /**
     * @dataProvider tables
     */
    public function testCreateDb($tableColumns, $expected)
    {
        $db = new \GearJson\Db\Db(['table' => 'MyTable'***REMOVED***);

        $this->module->getTestFilterFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \GearJson\Src\Src(['name' => 'MyTableFilter', 'type' => 'Filter'***REMOVED***);

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->schema->getSrcByDb($db, 'Filter')->willReturn($src);

        $this->filter = new \Gear\Mvc\Filter\FilterTestService();
        $this->filter->setStringService($this->string);
        $this->filter->setFileCreator($this->fileCreator);
        $this->filter->setModule($this->module->reveal());
        $this->filter->setSchemaService($this->schema->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($db)->willReturn($tableColumns);

        $this->filter->setColumnService($this->column->reveal());


        $file = $this->filter->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$expected.'.phtml'), file_get_contents($file));

    }

}
