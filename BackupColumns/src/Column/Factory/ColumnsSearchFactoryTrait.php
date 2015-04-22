<?php
namespace Column\Factory;

use Column\Factory\ColumnsSearchFactory;

trait ColumnsSearchFactoryTrait
{
    protected $columnsSearchFactory;

    public function getColumnsSearchFactory()
    {
        if (!isset($this->columnsSearchFactory)) {
            $serviceName = 'Column\Form\Search\ColumnsSearchForm';
            $this->columnsSearchFactory = $this->getServiceLocator()->get($serviceName);
        }
        return $this->columnsSearchFactory;
    }

    public function setColumnsSearchFactory(ColumnsSearchFactory $columnsSearchFactory)
    {
        $this->columnsSearchFactory = $columnsSearchFactory;
        return $this;
    }
}
