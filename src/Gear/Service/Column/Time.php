<?php
namespace Gear\Service\Column;

class Time extends AbstractColumn
{
    public function __construct($column)
    {
        if ($column->getDataType() !== 'time') {
            throw new \Gear\Exception\InvalidDataTypeColumnException();
        }
        parent::__construct($column);
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     */
    public function getFixtureData($iterator)
    {
        if ($iterator > 23) {
            $hora = 30 - $iterator;
        } else {
            $hora = $iterator;
        }

        $minuto = 0;
        $segundo = 2;

        $time = sprintf('%02d:%02d:%02d', $hora, $minuto, $segundo);

        return sprintf(
            '                \'%s\' => \DateTime::createFromFormat(\'H:i:s\', \'%s\'),',
            $this->str('var', $this->column->getName()),
            $time
        ).PHP_EOL;
    }
}
