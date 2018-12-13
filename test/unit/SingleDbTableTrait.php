<?php
namespace GearTest;

trait SingleDbTableTrait
{
    public function prophesizeSingleColumn($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function getSingleColumns($tableName = 'single_db_table')
    {
        $this->string = new \Gear\Util\String\StringService();

        $varcharColumn = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('single_db_column');
        $varcharColumn->getTableName()->willReturn($tableName);
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(60);

        $column = new \Gear\Column\Varchar\Varchar($varcharColumn->reveal());
        $columns[***REMOVED*** = $column;

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}