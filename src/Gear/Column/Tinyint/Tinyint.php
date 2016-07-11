<?php
namespace Gear\Column\Tinyint;

use Gear\Column\Int\AbstractCheckbox;

class Tinyint extends AbstractCheckbox
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
        return ($iterator%2==0) ? 'Não' : 'Sim';
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

    public function getFixtureDefault($number)
    {
        if ($number > 1) {
            return 1;
        }
        return $number;
    }
}
