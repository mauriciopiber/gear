<?php
namespace Gear\Metadata;

use Zend\Db\Metadata\Object\TableObject;
class Table {

    protected $table;

    public function __construct(TableObject $table)
    {
        $this->table = $table;
    }

    public function getPrimaryKeyConstraint()
    {

    }

    public function getReverseForeignKey($tableName)
    {
        $contraints = $this->table->getConstraints();
        foreach ($contraints as $constraint) {
            if ($constraint->getType() == 'FOREIGN KEY') {
                if ($constraint->getReferencedTableName() == $tableName) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getPrimaryKeyColumns()
    {
        $contraints = $this->table->getConstraints();

        foreach ($contraints as $contraint) {

            if ($contraint->getType() == 'PRIMARY KEY') {

                $columns = $contraint->getColumns();
                return $columns;

            } else {
                continue;
            }
        }
    }

    public function getForeignKeyFromColumnObject($columnToCheck)
    {
        $contraints = $this->table->getConstraints();
        foreach ($contraints as $contraint) {

            if ($contraint->getType() == 'FOREIGN KEY') {
                $columns = $contraint->getColumns();
                if (in_array($columnToCheck->getName(), $columns)) {
                    return $contraint;
                }
            }
        }

        return false;
    }

    /**
     * Verificar se tá tudo certo.
     * @param unknown $columnToCheck
     * @return unknown|boolean
     */
    public function getForeignKeyFromColumn($columnToCheck)
    {
        $contraints = $this->table->getConstraints();

        foreach ($contraints as $contraint) {

            if ($contraint->getType() == 'FOREIGN KEY') {
                $columns = $contraint->getColumns();


                if (in_array($columnToCheck->getName(), $columns)) {
                    return $columnToCheck;
                }
            }
        }

        return false;
    }


    public function getConstraintForeignKeyFromColumn($columnCheck)
    {
        $contraints = $this->table->getConstraints();

        foreach ($contraints as $contraint) {

            if ($contraint->getType() == 'FOREIGN KEY') {
                $columns = $contraint->getColumns();

                if (in_array($columnCheck->getName(), $columns)) {
                    return $contraint;
                }
            }
        }

        return false;
    }



}

