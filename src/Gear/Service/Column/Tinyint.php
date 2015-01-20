<?php
namespace Gear\Service\Column;

class TinyInt extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'tinyint') {
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
            '                \'%s\' => \'%d\',',
            $this->str('var', $this->column->getName()),
            $iterator
        ).PHP_EOL;
    }
}
