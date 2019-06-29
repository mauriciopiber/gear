<?php
namespace GearTest;

use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Util\String\StringService;
use Gear\Column\Varchar\Varchar;
trait SingleDbTableTrait
{
    public function prophesizeSingleColumn($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function getSingleColumns($tableName = 'single_db_table')
    {
        $this->string = new StringService();

        $varcharColumn = $this->prophesize(ColumnObject::class);
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('single_db_column');
        $varcharColumn->getTableName()->willReturn($tableName);
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(60);

        $column = new Varchar($varcharColumn->reveal());
        $columns[***REMOVED*** = $column;

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}