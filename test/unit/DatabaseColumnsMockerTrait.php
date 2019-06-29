<?php
namespace GearTest;

use Gear\Util\String\StringService;
use Zend\Db\Metadata\Object\ColumnObject;
use Gear\Module\Structure\ModuleStructure;

trait DatabaseColumnsMockerTrait
{
    public function getColumns($module, $tableName, $columns)
    {
        $this->string = new StringService();

        $this->localModule = $this->prophesize(ModuleStructure::class);
        $this->localModule->getModuleName()->willReturn($module);

        $return = [***REMOVED***;

        foreach ($columns as $data) {

            $column = $this->createMetadataColumn($tableName, $data);
            $gearColumnClass = sprintf('\Gear\Column\%s', $data['class'***REMOVED***);
            $mockColumn = new $gearColumnClass($column->reveal());
            $mockColumn->setStringService($this->string);
            $mockColumn->setModule($this->localModule->reveal());
            $return[***REMOVED*** = $mockColumn;
        }

        return $return;
    }

    public function createMetadataColumn($tableName, array $data)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($data['type'***REMOVED***)->shouldBeCalled();
        $column->getName()->willReturn($data['name'***REMOVED***);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn($data['nullable'***REMOVED***);

        return $column;
    }
}
