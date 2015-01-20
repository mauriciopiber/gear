<?php
namespace Gear\Service\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Service\Column\Int;

class PrimaryKey extends Int
{
    public function __construct(ColumnObject $column, ConstraintObject $constraint)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }

        if (
            $constraint->getType() !== 'PRIMARY KEY'
            || !in_array($column->getName(), $constraint->getColumns())
        ) {
            throw new \Gear\Exception\InvalidForeignKeyException();
        }


        parent::__construct($column);
    }
}
