<?php
namespace Column\Factory;

use Column\Factory\ColumnsFactory;

trait ColumnsFactoryTrait
{
    protected $columnsFactory;

    public function getColumnsFactory()
    {
        if (!isset($this->columnsFactory)) {
            $serviceName = 'Column\Factory\ColumnsFactory';
            $this->columnsFactory = $this->getServiceLocator()->get($serviceName);
        }
        return $this->columnsFactory;
    }

    public function setColumnsFactory(ColumnsFactory $columnsFactory)
    {
        $this->columnsFactory = $columnsFactory;
        return $this;
    }
}
