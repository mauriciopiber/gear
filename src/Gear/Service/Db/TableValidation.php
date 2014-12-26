<?php
namespace Gear\Service\Db;

use Zend\Db\Metadata\Object\TableObject;
class TableValidation
{

    protected $name;

    protected $created = false;

    protected $updated = false;

    protected $createdBy = false;

    protected $updatedBy = false;

    public function __construct(TableObject $table)
    {
        $this->setName($table->getName());

        foreach ($table->getColumns() as $column) {

            if ($column->getName() == 'created'
                && $column->getDataType() == 'datetime'
                && $column->isNullable() == false
            ) {

                $this->setCreated(true);
            }

            if ($column->getName() == 'updated'
                && $column->getDataType() == 'datetime'
                && $column->isNullable() == true
            ) {

                $this->setUpdated(true);


            }

            if ($column->getName() == 'createdBy'
                && $column->getDataType() == 'int'
                && $column->isNullable() == false
            ) {

                $this->setCreatedBy(true);

            }

            if ($column->getName() == 'updatedBy'
                && $column->getDataType() == 'int'
                && $column->isNullable() == false
            ) {

                $this->setUpdatedBy(true);


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
        $this->created = (bool) $created;
        return $this;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = (bool) $updated;
        return $this;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = (bool) $createdBy;
        return $this;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = (bool) $updatedBy;
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