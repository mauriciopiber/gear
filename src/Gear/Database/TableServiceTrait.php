<?php
namespace Gear\Database;

trait TableServiceTrait {

    protected $tableServiceDb;

    public function setTableService($tableService)
    {
        $this->tableServiceDb = $tableService;
    }

    public function getTableService()
    {
        if (!isset($this->tableServiceDb)) {
            $this->tableServiceDb = $this->getServiceLocator()->get('Gear\Database\Table');
        }
        return $this->tableServiceDb;
    }
}
