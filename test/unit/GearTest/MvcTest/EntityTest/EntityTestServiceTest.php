<?php
namespace GearTest\MvcTest\EntityTest;

use GearBaseTest\AbstractTestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;
use GearBase\Util\String\StringService;
use Gear\Creator\Template\TemplateService    ;
use Gear\Module;
use GearBase\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Column\Tinyint\Checkbox;
use GearJson\Db\Db;
use GearJson\Src\Src;
use Gear\Mvc\Entity\EntityTestService;
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Datetime\DatetimePtBr;

/**
 * @group src-entity
 * @group Entity
 */
class EntityTestServiceTest extends AbstractTestCase
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

        $this->string = new StringService();

        $template       = new TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new Module)->getLocation().'/../../view'));
        $fileService    = new FileService();
        $this->fileCreator    = new File($fileService, $template);

        $this->template = (new Module())->getLocation().'/../../test/template/module/mvc/entity-test';

    }

    public function tables()
    {
        return [
            [$this->getAllPossibleColumns(), 'all-columns-db', 'table'***REMOVED***
        ***REMOVED***;
    }

    public function createColumn($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);
        return $column->reveal();
    }

    public function createForeign($tableName, $columnName, $type, $columnReference, $tableReference)
    {
        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $foreignKey->getType()->willReturn($type)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();
        $foreignKey->getReferencedTableName()->willReturn($tableReference);
        $foreignKey->getReferencedColumns()->willReturn([$columnReference***REMOVED***);

        return $foreignKey->reveal();
    }

    /**
     * @dataProvider tables
     * @group n99
     */
    public function testCreateDb($tableColumns, $expected, $tableName)
    {
        $tableColumns[14***REMOVED*** = new Checkbox(
            $this->prophesizeColumn('table', 'tinyint_checkbox_column', 'tinyint')
        );

        $table = $this->string->str('class', $tableName);

        $db = new Db(['table' => $table***REMOVED***);

        $this->module->getTestEntityFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new Src(['name' => $table, 'type' => 'Entity'***REMOVED***);

        $this->entity = new EntityTestService();
        $this->entity->setStringService($this->string);
        $this->entity->setFileCreator($this->fileCreator);
        $this->entity->setModule($this->module->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);
        $this->entity->setTableService($this->table->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');

        $tableColumns[***REMOVED*** = new ForeignKey(
            $this->createColumn('table', 'created_by', 'int'),
            $this->createForeign('table', 'created_by', 'FOREIGN KEY', 'id_user', 'user')
        );

        $tableColumns[***REMOVED*** = new DatetimePtBr(
            $this->createColumn('table', 'created', 'datetime')
        );

        $tableColumns[***REMOVED*** = new ForeignKey(
            $this->createColumn('table', 'updated_by', 'int'),
            $this->createForeign('table', 'updated_by', 'FOREIGN KEY', 'id_user', 'user')
        );

        $tableColumns[***REMOVED*** = new DatetimePtBr(
            $this->createColumn('table', 'updated', 'datetime')
        );

        foreach ([9, 22, 24***REMOVED*** as $key) {
            $this->table->getConstraintForeignKeyFromColumn(
                $tableName,
                $tableColumns[$key***REMOVED***->getColumn()
            )->willReturn($tableColumns[$key***REMOVED***->getConstraint());
        }


        $this->column->getColumns($db, true)->willReturn($tableColumns);

        $this->entity->setColumnService($this->column->reveal());


        $file = $this->entity->introspectFromTable($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$expected.'.phtml'), file_get_contents($file));

    }
}
