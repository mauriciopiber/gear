<?php
namespace Gear\Column\Int;

class Int extends AbstractInt
{
    public function __construct($column)
    {

        if ($column->getDataType() !== 'int') {
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

    public function getFixtureDefault($number)
    {
        return $number;
    }
}
