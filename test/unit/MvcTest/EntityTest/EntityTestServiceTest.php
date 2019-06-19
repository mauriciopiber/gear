<?php
namespace GearTest\MvcTest\EntityTest;

use PHPUnit\Framework\TestCase;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use org\bovigo\vfs\vfsStream;
use Gear\Util\String\StringService;
use Gear\Creator\Template\TemplateService;
use Gear\Module;
use Gear\Util\File\FileService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Column\Tinyint\Checkbox;
use Gear\Schema\Db\Db;
use Gear\Schema\Src\Src;
use Gear\Mvc\Entity\EntityTestService;
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Datetime\DatetimePtBr;
use Gear\Column\ColumnManager;
use GearTest\UtilTestTrait;

/**
 * @group src-entity
 * @group Entity
 */
class EntityTestServiceTest extends TestCase
{
    use UtilTestTrait;
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;

    public function setUp() : void
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');

        $this->string = new StringService();

        $this->fileCreator    = $this->createFileCreator();

        $this->template = (new Module())->getLocation().'/../test/template/module/mvc/entity-test';

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

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');

        $this->entity = new EntityTestService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->string,
            $this->createCodeTest(),
            $this->table->reveal(),
            $this->createInjector()
        );


        $this->table->getPrimaryKeyColumns($tableName)->willReturn(['idMyController'***REMOVED***);

        $this->column = $this->prophesize('Gear\Column\ColumnService');

        $tableColumns[***REMOVED*** = new ForeignKey(
            $this->createColumn('table', 'created_by', 'int'),
            $this->createForeign('table', 'created_by', 'FOREIGN KEY', 'id_user', 'user'),
            'email'
        );

        $tableColumns[***REMOVED*** = new DatetimePtBr(
            $this->createColumn('table', 'created', 'datetime')
        );

        $tableColumns[***REMOVED*** = new ForeignKey(
            $this->createColumn('table', 'updated_by', 'int'),
            $this->createForeign('table', 'updated_by', 'FOREIGN KEY', 'id_user', 'user'),
            'email'
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

        foreach ($tableColumns as $table) {
            $table->setStringService($this->string);
            $table->setModule($this->module->reveal());
        }

        $columnManager = new ColumnManager($tableColumns);
        $db->setColumnManager($columnManager);
        //$this->column->getColumns($db, true)->willReturn($tableColumns);


        $this->schema = $this->prophesize('Gear\Schema\Schema\SchemaService');

        $this->schema->getSrcByDb($db, 'Entity')->willReturn($src)->shouldBeCalled();

        $this->entity->setSchemaService($this->schema->reveal());

        $file = $this->entity->createEntityTest($db);

        $this->assertEquals(file_get_contents($this->template.'/'.$expected.'.phtml'), file_get_contents($file));

    }
}
