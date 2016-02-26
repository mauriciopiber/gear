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
use Gear\Column\Exception\UndevelopedColumn;

class ColumnService implements ServiceLocatorAwareInterface
{
    use ModuleAwareTrait;
    use StringServiceTrait;
    use MetadataTrait;
    use TableServiceTrait;
    use ServiceLocatorAwareTrait;

    protected $columns;

    /**
     * Extrai todos Gear\Column de um GearJson\Db\Db.
     *
     * @param Db $db
     * @throws \Gear\Exception\PrimaryKeyNotFoundException
     */
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

        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), Db::excludeList())) {
                continue;
            }

            $instance = $this->factory($column, $db);

            $this->columns[***REMOVED***  = $instance;
        }

        return $this->columns;
    }

    /**
     * Transforma uma metadata de coluna simples em Gear\Column.
     *
     *
     * @param Zend\Db\Metadata\Object\ColumnObject $column Coluna que será transformada em Gear\Column
     * @param GearJson\Db\Db $db
     * @return \Gear\Column\UniqueInterface|unknown
     */
    public function factory($column, $db)
    {
        $defaultNamespace = 'Gear\\Column';

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

            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }

            $instance = new $class($column);

            //speciality
        } else {
            $className = $this->str('class', $specialityName);
            $class = $defaultNamespace.'\\'.$dataType.'\\'.$className;
            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }
            $instance = new $class($column);
        }

        $instance->setServiceLocator($this->getServiceLocator());
        $instance->setModule($this->getModule());


        if ($instance instanceof UniqueInterface) {
            $uniqueConstraint = $this->getTableService()->getUniqueConstraintFromColumn($column);
            $instance->setUniqueConstraint($uniqueConstraint);
        }

        return $instance;
    }

}
