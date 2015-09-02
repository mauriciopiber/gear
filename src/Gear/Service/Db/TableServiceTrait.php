<?php
namespace Gear\Service\Db;

trait TableServiceTrait {

    protected $tableService;

    public function setTableService($tableService)
    {
        $this->tableService = $tableService;
    }

    public function getTableService()
    {
        if (!isset($this->tableService)) {
            $this->tableService = $this->getServiceLocator()->get('Gear\Service\Db\Table');
        }
        return $this->tableService;
    }
}
