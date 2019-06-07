<?php
namespace Gear\Table\TableService;

use Gear\Table\TableService\TableService;

trait TableServiceTrait
{
    protected $tableService;

    public function getTableService()
    {
        return $this->tableService;
    }

    public function setTableService(
        TableService $tableService
    ) {
        $this->tableService = $tableService;
        return $this;
    }
}
