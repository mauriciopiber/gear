<?php
namespace Gear\Mvc\Service\ColumnInterface;

/**
 * Interface para colunas que geram código para o topo do método Module\Fixture\Table::getFixture
 */
interface ServiceCreateAfterInterface
{
    public function getServiceCreateAfter();
}
