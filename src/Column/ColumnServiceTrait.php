<?php
namespace Gear\Column;

use Gear\Column\ColumnService;

trait ColumnServiceTrait
{
    protected $columnService;

    /**
     * Retorna o ColumnService do ServiceManager.
     *
     * @return \Gear\Column\ColumnService
     */
    public function getColumnService()
    {
        if (!isset($this->columnService)) {
            $name = 'Gear\Column\ColumnService';
            $this->columnService = $this->getServiceLocator()->get($name);
        }
        return $this->columnService;
    }

    /**
     * Adiciona um ColumnService à classe.
     *
     * @param ColumnService $columnService ColumnService
     *
     * @return \Gear\Column\ColumnServiceTrait
     */
    public function setColumnService(
        ColumnService $columnService
    ) {
        $this->columnService = $columnService;
        return $this;
    }
}
