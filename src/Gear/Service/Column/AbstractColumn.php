<?php
namespace Gear\Service\Column;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Object\ColumnObject;

abstract class AbstractColumn extends AbstractJsonService
{

    protected $column;

    protected $serviceLocator;

    public function __construct(ColumnObject $column)
    {
        $this->setColumn($column);
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function setColumn(ColumnObject $column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Função usada em \Gear\Service\Mvc\Fixture::getEntityFixture
     * Função default que será chamada caso não esteja declarada nenhuma função de fixture nas classes filhas.
     */
    public function getFixtureData($iterator)
    {
        return sprintf(
            '                \'%s\' => \'%d%s\',',
            $this->str('var', $this->column->getName()),
            $iterator,
            $this->str('label', $this->column->getName())
        ).PHP_EOL;
    }
}
