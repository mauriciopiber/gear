<?php
namespace GearTest;

use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Util\String\StringService;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Integer\PrimaryKey;
use Zend\Db\Metadata\Object\ConstraintObject;
trait LongNameTableTrait
{
    public function prophesizeColumnLongName($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function prophesizeForeignKeyLongName($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize(ConstraintObject::class);
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function getLongNameTableColumns()
    {
        $this->string = new StringService();

        $columns = [***REMOVED***;

        $columns[***REMOVED*** = new PrimaryKey(
            $this->prophesizeColumnLongName('my_very_long_table_name_example', 'id_my_very_long_table_name_example', 'int'),
            $this->prophesizeForeignKeyLongName('my_very_long_table_name_example', 'id_my_very_long_table_name_example', 'PRIMARY KEY')
        );


        $varcharColumn = $this->prophesize(ColumnObject::class);
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('my_very_long_column');
        $varcharColumn->getTableName()->willReturn('my_very_long_table_name_example');
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new Varchar($varcharColumn->reveal());
        //$column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column'));


        $columns[***REMOVED*** = $column;


        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}
