<?php
namespace Gear\Metadata;

trait TableServiceTrait {

    protected $tableService;

    public function getTableService()
    {
        if (!isset($this->tableService)) {
            $this->tableService = $this->getServiceLocator()->get('Gear\Metadata\Table');
        }
        return $this->tableService;
    }

    public function setTableService($tableService)
    {
        $this->tableService = $tableService;
        return $this;
    }
}
