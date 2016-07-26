<?php
namespace Gear\Mvc\Filter\ColumnInterface;

/**
 * Interface para colunas que geram código para o topo do método Module\Fixture\Table::getFixture
 */
interface FilterFunctionInterface
{
    public function getFilterFunction();
}