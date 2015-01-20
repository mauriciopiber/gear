<?php
namespace Gear\Service\Column\Int;

use Gear\Service\Column\Int;

class Checkbox extends Int
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
        if ($iterator%2==0) {
            $int = 0;
        } else {
            $int = 1;
        }


        return sprintf(
            '                \'%s\' => \'%d\',',
            $this->str('var', $this->column->getName()),
            $int
        ).PHP_EOL;
    }
}
