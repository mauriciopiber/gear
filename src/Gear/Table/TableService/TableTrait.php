<?php
namespace Gear\Table\TableService;

trait TableTrait
{
    protected $table;

    public function getTable()
    {
        if (!isset($this->table)) {
            $this->table = $this->getServiceLocator()->get('Gear\Table\Table');
        }
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}
