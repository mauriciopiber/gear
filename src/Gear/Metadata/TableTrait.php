<?php
namespace Gear\Metadata;

trait TableTrait
{
    protected $table;

    public function getTable()
    {
        if (!isset($this->table)) {
            $this->table = $this->getServiceLocator()->get('Gear\Metadata\Table');
        }
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}
