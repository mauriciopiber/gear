<?php
namespace GearTest\ColumnTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Column\ColumnService;
use GearBase\Util\String\StringService;
use Zend\ServiceManager\ServiceManager;

/**
 * @group Service
 * @group module
 * @group module-column
 * @group module-column-service
 */
class ColumnServiceTest extends TestCase
{
    public function setUp()
    {

        $this->serviceLocator = new ServiceManager();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        $this->metadata = $this->prophesize('Zend\Db\Metadata\Metadata');
        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->string = new StringService();

        $this->column = new ColumnService(
            $this->module->reveal(),
            $this->tableService->reveal(),
            $this->string
        );

    }

    public function testFactoryColumnsException()
    {
        $this->setExpectedException('Exception');
        $this->column->getColumns();
    }

    public function mapDataTypeProvider()
    {
        return [
            ['varchar', 'Varchar'***REMOVED***,
            ['integer', 'Integer'***REMOVED***,
            ['int', 'Integer'***REMOVED***,
            ['float', 'Float'***REMOVED***
        ***REMOVED***;
    }

    /**
     * @dataProvider mapDataTypeProvider
     */
    public function testMapDataType($match, $expected)
    {
        $this->assertEquals($expected, $this->column->mapDataType($match));
    }

    public function testFactoryColumns()
    {
        $this->tableName = 'my_table';

        $db = $this->prophesize('GearJson\Db\Db');
        $db->getTable()->willReturn($this->tableName)->shouldBeCalled();
        $db->getColumns()->willReturn(['id_my_table' => null***REMOVED***)->shouldBeCalled();


        $pkey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        //$pkey->getName('_zf_table_PRIMARY')->willReturn()->shouldBeCalled();
        //$pkey->getTableName($this->tableName)->willReturn()->shouldBeCalled();
        $pkey->getType()->willReturn('PRIMARY KEY')->shouldBeCalled();
        $pkey->getColumns()->willReturn(['id_my_table'***REMOVED***)->shouldBeCalled();

        $columns = [***REMOVED***;

        $column01 = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column01->getName()->willReturn('id_my_table')->shouldBeCalled();
        $column01->getDataType()->willReturn('int')->shouldBeCalled();

        $columns[***REMOVED*** = $column01->reveal();

        $this->tableService->getColumns($this->tableName)->willReturn($columns)->shouldBeCalled();

        $this->tableService->getPrimaryKey($this->tableName)->willReturn($pkey->reveal())->shouldBeCalled();

        //$this->tableService->getConstraintForeignKeyFromColumn($this->tableName, $column01)
        //  ->willReturn(null)
        //  ->shouldBeCalled();

        $this->tableService->getUniqueConstraintFromColumn($this->tableName, $column01)
          ->willReturn(null)
          ->shouldBeCalled();

        $columns = $this->column->getColumns($db->reveal(), false);
        $this->assertCount(1, $columns);

    }
}
