<?php
namespace Column\Repository;

use Column\Repository\ColumnsRepository;

trait ColumnsRepositoryTrait
{
    protected $columnsRepository;

    public function getColumnsRepository()
    {
        if (!isset($this->columnsRepository)) {
            $serviceName = 'Column\Repository\ColumnsRepository';
            $this->columnsRepository = $this->getServiceLocator()->get($serviceName);
        }
        return $this->columnsRepository;
    }

    public function setColumnsRepository(ColumnsRepository $columnsRepository)
    {
        $this->columnsRepository = $columnsRepository;
        return $this;
    }
}
