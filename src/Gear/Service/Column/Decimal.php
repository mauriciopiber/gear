<?php
namespace Gear\Service\Column;

class Decimal extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'decimal') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%d.%d\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $iterator
        ).PHP_EOL;
    }
}
