<?php
namespace Gear\Mvc\Fixture\ColumnInterface;

/**
 * Interface para colunas que geram código para o topo do método Module\Fixture\Table::getFixture
 */
interface GetFixtureTopInterface
{
    public function getFixtureTop();
}