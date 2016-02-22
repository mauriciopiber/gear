<?php
namespace Gear\Column;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use GearJson\Db\Db;
use Gear\Metadata\MetadataTrait;
use Gear\Metadata\TableServiceTrait;
use Gear\Column\UniqueInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareTrait;

class ColumnService implements ServiceLocatorAwareInterface
{
    use ModuleAwareTrait;
    use StringServiceTrait;
    use MetadataTrait;
    use TableServiceTrait;
    use ServiceLocatorAwareTrait;

    protected $columns;

    public function getColumns(Db $db)
    {
        if (isset($this->columns)) {
            return $this->columns;
        }

        $metadata = $this->getMetadata();

        $this->tableName    = $this->str('class', $db->getTable());
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $this->tablePrimaryKey = $this->getTableService()->getPrimaryKey();

        if (!$this->tablePrimaryKey) {
            throw new \Gear\Exception\PrimaryKeyNotFoundException();
        }

        $defaultNamespace = 'Gear\\Column';

        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), Db::excludeList())) {
                continue;
            }

            $dataType = $this->str('class', $column->getDataType());
            $specialityName = $db->getColumnSpeciality($column->getName());
            $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn($column);

            //primary key
            if (in_array($column->getName(), $this->tablePrimaryKey->getColumns())) {
                $class = $defaultNamespace.'\\'.$dataType.'\\PrimaryKey';
                $instance = new $class($column, $this->tablePrimaryKey);
                //foreign key
            } elseif ($columnConstraint != null) {
                $class = $defaultNamespace.'\\'.$dataType.'\\ForeignKey';
                $instance = new $class($column, $columnConstraint);
                $instance->setModuleName($this->getModule()->getModuleName());

                //standard
            } elseif ($specialityName == null) {
                $class = $defaultNamespace.'\\'.$dataType;
                $instance = new $class($column);
                //speciality
            } else {
                $className = $this->str('class', str_replace('-', '_', $specialityName));
                $class = $defaultNamespace.'\\'.$dataType.'\\'.$className;
                $instance = new $class($column);
            }

            $instance->setServiceLocator($this->getServiceLocator());
            $instance->setModule($this->getModule());


            if ($instance instanceof UniqueInterface) {
                $uniqueConstraint = $this->getTableService()->getUniqueConstraintFromColumn($column);
                $instance->setUniqueConstraint($uniqueConstraint);
            }

            $this->columns[***REMOVED***  = $instance;
        }

        return $this->columns;
    }
}
