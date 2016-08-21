<?php
namespace GearTest\MvcTest\EntityTest;

use GearBaseTest\AbstractTestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;

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


        $this->string = new \GearBase\Util\String\StringService();

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->template = (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/entity-test';

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


        $table = $this->string->str('class', $tableName);

        $db = new \GearJson\Db\Db(['table' => $table***REMOVED***);

        $this->module->getTestEntityFolder()->willReturn(vfsStream::url('module'));
        $this->module->getModuleName()->willReturn('MyModule');

        $src = new \GearJson\Src\Src(['name' => $table, 'type' => 'Entity'***REMOVED***);

        $this->entity = new \Gear\Mvc\Entity\EntityTestService();
        $this->entity->setStringService($this->string);
        $this->entity->setFileCreator($this->fileCreator);
        $this->entity->setModule($this->module->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);
        $this->entity->setTableService($this->table->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');

        $tableColumns[***REMOVED*** = new \Gear\Column\Int\ForeignKey(
            $this->createColumn('table', 'created_by', 'int'),
            $this->createForeign('table', 'created_by', 'FOREIGN KEY', 'id_user', 'user')
        );

        $tableColumns[***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->createColumn('table', 'created', 'datetime')
        );

        $tableColumns[***REMOVED*** = new \Gear\Column\Int\ForeignKey(
            $this->createColumn('table', 'updated_by', 'int'),
            $this->createForeign('table', 'updated_by', 'FOREIGN KEY', 'id_user', 'user')
        );

        $tableColumns[***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
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
