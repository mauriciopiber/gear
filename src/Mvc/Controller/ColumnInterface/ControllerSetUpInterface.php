<?php
namespace Gear\Mvc\Controller\ColumnInterface;

/**
 * Interface para colunas que geram código para o topo do método Module\Fixture\Table::getFixture
 */
interface ControllerSetUpInterface
{
    public function getControllerSetUp();
}
