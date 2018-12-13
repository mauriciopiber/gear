<?php
namespace Gear\Table\TableService;

use Gear\Table\TableService\TableService;

trait TableServiceTrait
{
    protected $tableService;

    public function getTableService()
    {
        if (!isset($this->tableService)) {
            $name = 'Gear\Table\TableService';
            $this->tableService = $this->getServiceLocator()->get($name);
        }
        return $this->tableService;
    }

    public function setTableService(
        TableService $tableService
    ) {
        $this->tableService = $tableService;
        return $this;
    }
}
