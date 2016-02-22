<?php
namespace Gear\Column;

use Gear\Column\ColumnServiceFactory;

trait ColumnServiceTrait
{
    protected $columnService;

    public function getColumnService()
    {
        if (!isset($this->columnService)) {
            $name = 'Gear\Column\ColumnService';
            $this->columnService = $this->getServiceLocator()->get($name);
        }
        return $this->columnService;
    }

    public function setColumnService(
        ColumnService $columnService
    ) {
        $this->columnService = $columnService;
        return $this;
    }
}
