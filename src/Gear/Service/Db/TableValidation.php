<?php
namespace Gear\Service\Db;

use Zend\Db\Metadata\Object\TableObject;
class TableValidation
{

    protected $name;

    protected $created = 'fix';

    protected $updated = 'fix';

    protected $createdBy = 'fix';

    protected $updatedBy = 'fix';

    public function checkCreateBy($column)
    {
        if ($column->getName() == 'created_by'
            && $column->getDataType() == 'int'
            && $column->isNullable() == false
            && $this->getName() != 'user'
        ) {
            return true;
        } elseif($column->getName() == 'created_by'
            && $column->getDataType() == 'int'
            && $column->isNullable() == true
            && $this->getName() == 'user'
        ) {
            return true;
        } elseif($this->getName() == 'user_role_linker') {
            return true;
        } else {
            return false;
        }
    }



    public function __construct(TableObject $table)
    {
        $this->setName($table->getName());

        foreach ($table->getColumns() as $column) {

            if ($column->getName() == 'created'
                && $column->getDataType() == 'datetime'
                && $column->isNullable() == false
            ) {
                $this->setCreated('ok');
            } elseif ($table->getName() == 'user_role_linker') {
                 $this->setCreated('ok');
            }

            if ($column->getName() == 'updated'
                && $column->getDataType() == 'datetime'
                && $column->isNullable() == true
            ) {

                $this->setUpdated('ok');
            } elseif ($table->getName() == 'user_role_linker') {
                $this->setUpdated('ok');
            }

            if ($this->checkCreateBy($column)) {
                $this->setCreatedBy('ok');
            }

            if ( ($column->getName() == 'updated_by'
                && $column->getDataType() == 'int'
                && $column->isNullable() == true) || $table->getName() == 'user_role_linker'
            ) {
                $this->setUpdatedBy('ok');
            } elseif ( $table->getName() == 'user_role_linker') {
                $this->setUpdatedBy('ok');
            }
        }

    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}