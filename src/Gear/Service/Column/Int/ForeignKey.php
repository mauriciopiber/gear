<?php
namespace Gear\Service\Column\Int;

use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Service\Column\Int;

class ForeignKey extends Int
{
    protected $constraint;

    public function __construct(ColumnObject $column, ConstraintObject $constraint)
    {
        if ($column->getDataType() !== 'int') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }

        if (
            $constraint->getType() !== 'FOREIGN KEY'
            || !in_array($column->getName(), $constraint->getColumns())
        ) {
            throw new \Gear\Exception\InvalidForeignKeyException();
        }


        parent::__construct($column);

        $this->constraint = $constraint;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => $this->getReference(\'%s-%d\'),',
            $this->str('var', $this->column->getName()),
            $this->str('url', $this->constraint->getReferencedTableName()),
            $iterator
        ).PHP_EOL;
    }
}
