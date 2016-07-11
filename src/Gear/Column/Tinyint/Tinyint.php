<?php
namespace Gear\Column\Tinyint;

use Gear\Column\Int\AbstractInt;

class Tinyint extends AbstractInt
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'tinyint') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    public function getValue($iterator)
    {
        $iterator = ($iterator>1) ? 1 : 0;
        //unset($iterator);
        return $iterator;
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
        if ($number > 1) {
            return 1;
        }
        return $number;
    }
}
