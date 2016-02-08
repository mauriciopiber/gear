<?php
namespace Gear\Database;

trait TableServiceTrait {

    protected $tableService;

    public function setTableService($tableService)
    {
        $this->tableService = $tableService;
    }

    public function getTableService()
    {
        if (!isset($this->tableService)) {
            $this->tableService = $this->getServiceLocator()->get('Gear\Database\Table');
        }
        return $this->tableService;
    }
}
