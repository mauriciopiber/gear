<?php
namespace Gear\Common;

use Gear\Service\Mvc\TableService;

trait TableServiceTrait {

    protected $tableService;

    public function getTableService()
    {
        if (!isset($this->tableService)) {
            $this->tableService = $this->getServiceLocator()->get('Gear\Service\Db\Table');
        }
        return $this->tableService;
    }

    public function setTableService(TableService $tableService)
    {
        $this->tableService = $tableService;
        return $this;
    }
}
