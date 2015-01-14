<?php
namespace Gear\Service\Db;

use Zend\Db\Metadata\Object\TableObject;
class TableValidation
{

    protected $name;

    protected $table;

    protected $created = 'not found';

    protected $updated = 'not found';

    protected $createdBy = 'not found';

    protected $updatedBy = 'not found';

    /**
     * @param Zend\Db\Metadata\Object\ColumnObject $column
     * @return boolean
     */
    public function checkCreatedBy($column)
    {
        if($this->getName() == 'user_role_linker') {
            $this->setCreatedBy('ok');
            return true;
        }

        if ($column->getName() == 'created_by') {

            $updated = '';

            $constraints = $this->table->getConstraints();

            if (count($constraints) > 0) {
                foreach ($constraints as $constraint) {
                    if ($constraint->getType() == 'FOREIGN KEY' && in_array('created_by', $constraint->getColumns())) {
                        $foreignKey = $constraint;
                        break;
                    }
                }
            }
            if (!isset($foreignKey)) {
                $updated .= 'missing foreign key;';
            } else {

                if ($foreignKey->getReferencedTableName() != 'user') {
                    $updated .= 'wrong referenced table;';
                }

                if ($foreignKey->getReferencedColumns() != array('id_user')) {
                    $updated .= 'wrong referenced column;';
                }

                if ($foreignKey->getUpdateRule() != 'CASCADE') {
                    $updated .= 'wrong update rule;';
                }

                if ($foreignKey->getDeleteRule() != 'CASCADE') {
                    $updated .= 'wrong delete rule;';
                }
            }


            if ($column->getDataType() != 'int') {
                $updated .= 'fix dataType to int;';
            }

            if (!($column->isNullable() == false && $this->getName() != 'user')) {
                $updated .= 'set nullable false;';
            }

            /* if (!($column->isNullable() == true && $this->getName() == 'user')) {
                $updated .= 'set nullable true for table user;';
            } */

            if (strlen($updated) == 0) {
                $this->setCreatedBy('ok');
            } else {
                $this->setCreatedBy($updated);
            }
        }

        return true;
    }

    /**
     *
     * @param Zend\Db\Metadata\Object\ColumnObject $column
     * @return boolean
     */
    public function checkUpdatedBy($column)
    {
        if ( $this->table->getName() == 'user_role_linker') {
            $this->setUpdatedBy('ok');
            return true;
        }

        $updated = '';

        if ( $column->getName() == 'updated_by' ) {

            $constraints = $this->table->getConstraints();

            if (count($constraints) > 0) {
                foreach ($constraints as $constraint) {
                    if ($constraint->getType() == 'FOREIGN KEY' && in_array('updated_by', $constraint->getColumns())) {
                        $foreignKey = $constraint;
                        break;
                    }
                }
            }
            if (!isset($foreignKey)) {
                $updated .= 'missing foreign key;';
            } else {

                if ($foreignKey->getReferencedTableName() != 'user') {
                    $updated .= 'wrong referenced table;';
                }

                if ($foreignKey->getReferencedColumns() != array('id_user')) {
                    $updated .= 'wrong referenced column;';
                }

                if ($foreignKey->getUpdateRule() != 'CASCADE') {
                    $updated .= 'wrong update rule;';
                }

                if ($foreignKey->getDeleteRule() != 'CASCADE') {
                    $updated .= 'wrong delete rule;';
                }
            }



            if ($column->getDataType() != 'int') {
                $updated .= 'fix dataType to int;';
            }

            if ($column->isNullable() != true) {
                $updated .= 'fix nullable to null;';
            }

            if (strlen($updated) == 0) {
                $this->setUpdatedBy('ok');
            } else {
                $this->setUpdatedBy($updated);
            }
        }


        return true;
    }



    public function __construct(TableObject $table)
    {

        $this->table = $table;
        $this->setName($table->getName());


        $tableSchema = new \Gear\Metadata\Table($table);

        $columns = $table->getColumns();

        if (count($columns) > 0) {

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

                if ($column->getName() == 'created_by') {
                    $this->checkCreatedBy($column);
                }


                if ( $column->getName() == 'updated_by') {
                    $this->checkUpdatedBy($column);
                }

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