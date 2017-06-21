<?php
namespace Gear\Constructor;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use Gear\Column\ColumnServiceTrait;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use Gear\Module\BasicModuleStructure;

abstract class AbstractConstructor implements ModuleAwareInterface
{
    use TableServiceTrait;

    use ColumnServiceTrait;

    use ModuleAwareTrait;

    use StringServiceTrait;

    public function __construct(
        BasicModuleStructure $module = null,
        StringService $stringService = null,
        TableService $tableService = null,
        ColumnService $columnService = null
    ) {
        $this->stringService = $stringService;
        $this->module = $module;
        $this->tableService = $tableService;
        $this->columnService = $columnService;
    }

    public function setDbOptions(&$component)
    {
        $tableObject = $this->getTableService()->getTableObject($component->getDb()->getTable());
        $component->getDb()->setTableObject($tableObject);

        $columnManager = $this->getColumnService()->getColumnManager($component->getDb());
        $component->getDb()->setColumnManager($columnManager);
    }
}
