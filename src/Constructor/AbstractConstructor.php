<?php
namespace Gear\Constructor;

use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringService;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use Gear\Column\ColumnServiceTrait;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructure;

abstract class AbstractConstructor implements ModuleStructureInterface
{
    use TableServiceTrait;

    use ColumnServiceTrait;

    use ModuleStructureTrait;

    use StringServiceTrait;

    public function __construct(
        ModuleStructure $module = null,
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
