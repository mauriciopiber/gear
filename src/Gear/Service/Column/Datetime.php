<?php
namespace Gear\Service\Column;

class Datetime extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'datetime') {
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

        if ($iterator > 23) {
            $hora = 30 - $iterator;
        } else {
            $hora = $iterator;
        }

        $minuto = 0;
        $segundo = 2;

        $time = sprintf('%04d-%02d-%02d %02d:%02d:%02d', $ano, $mes, $dia , $hora, $minuto, $segundo);

        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'Y-m-d H:i:s\', \'%s\'),',
            $this->str('var', $this->column->getName()),
            $time
        ).PHP_EOL;
    }
}
