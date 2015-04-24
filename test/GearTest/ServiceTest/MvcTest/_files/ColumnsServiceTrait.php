<?php
namespace \Service;

use \Service\ColumnsService;

trait ColumnsServiceTrait
{
    protected $columnsService;

    public function getColumnsService()
    {
        if (!isset($this->columnsService)) {
            $serviceName = '\Service\ColumnsService';
            $this->columnsService = $this->getServiceLocator()->get($serviceName);
        }
        return $this->columnsService;
    }

    public function setColumnsService(ColumnsService $columnsService)
    {
        $this->columnsService = $columnsService;
        return $this;
    }
}
