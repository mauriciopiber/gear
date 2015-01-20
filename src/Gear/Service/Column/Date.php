<?php
namespace Gear\Service\Column;

class Date extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'date') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        $dia = $iterator;
        $mes = 12;
        $ano = 2020;

        $time = sprintf('%04d-%02d-%02d', $ano, $mes, $dia );


        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'Y-m-d\', \'%s\'),',
            $this->str('var', $this->column->getName()),
            $time
        ).PHP_EOL;
    }
}
