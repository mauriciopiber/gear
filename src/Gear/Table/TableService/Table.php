<?php
namespace Gear\Table\TableService;

use Zend\Db\Metadata\Object\TableObject;

/**
 * @deprecated
 * @author piber
 */
class Table
{
    public $table;

    public function __construct(TableObject $table)
    {
        $this->table = $table;
    }


    public function getColumnSpeciality($column)
    {
        if (empty($this->getColumns())) {
            return null;
        }
        if (!array_key_exists($column, $this->getColumns())) {
            return null;
        }

        return $this->getColumns()[$column***REMOVED***;
    }

    public function isForeignKey($columnToCheck)
    {
        $table = $this->table;

        $contraints = $table->getConstraints();

        foreach ($contraints as $contraint) {
            if ($contraint->getType() == 'FOREIGN KEY') {
                $columns = $contraint->getColumns();
                $column = array_pop($columns);
                if ($columnToCheck->getName() == $column) {
                    return true;
                }
            }
        }

        return false;
    }


    public function getForeignKeyConstraint($columnToCheck)
    {
        $table = $this->table;

        $contraints = $table->getConstraints();

        foreach ($contraints as $contraint) {
            if ($contraint->getType() == 'FOREIGN KEY') {
                if (in_array($columnToCheck->getName(), $contraint->getColumns())) {
                    return $contraint;
                }
            }
        }

        return null;
    }

    /*
    public function getForeignKeyReferencedTable($columnToCheck)
    {
        $table = $this->table;

        $contraints = $table->getConstraints();

        foreach ($contraints as $contraint) {
            if ($contraint->getType() == 'FOREIGN KEY') {
                $columns = $contraint->getColumns();
                $column = array_pop($columns);
                if ($columnToCheck->getName() == $column) {
                    return $contraint->getReferencedTableName();
                }
            }
        }

        return null;
    }
    */

    public function isPrimaryKey($column)
    {

        $primaryKey = $this->getPrimaryKeyColumnName();


        if ($column->getName() == $primaryKey) {
            return true;
        } else {
            return false;
        }
    }

    public function getPrimaryKeyColumnNameFromTable($table)
    {
        $metadata = $this->getMetadata();

        $tableObject = $metadata->getTable($table);
        $contraints = $tableObject->getConstraints();

        foreach ($contraints as $contraint) {
            if ($contraint->getType() == 'PRIMARY KEY') {
                $columns = $contraint->getColumns();

                $column = array_pop($columns);

                return $column;
            } else {
                continue;
            }
        }

        throw new \Exception('Need to set primary key for '. $table);
    }

    /**
     * @deprecated será utilizado no namespace Table apenas.
     *
     * @throws \Exception
     * @return string
     */
    public function getPrimaryKeyColumnName()
    {
        $table = $this->table;

        if ($table) {
            $contraints = $table->getConstraints();

            foreach ($contraints as $contraint) {
                if ($contraint->getType() == 'PRIMARY KEY') {
                    $columns = $contraint->getColumns();

                    //var_dump($columns);

                    $column = implode(',', $columns);

                    return $column;
                } else {
                    continue;
                }
            }
        }



        throw new \Exception(sprintf('Tabela %s não possui Primary Key', $this->table));
    }


    public static function excludeList()
    {
        return array(
            'created',
            'updated',
            'created_by',
            'updated_by',
            'id_lixeira'
        );
    }


    public function confirm($column)
    {
        if (in_array($column, self::excludeList())) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @TODO Deprecated, verificar e confirmar
     *
     *
     * @return unknown[***REMOVED***
     */
    public function getTableColumnsMapping()
    {
        $columns = $this->table->getColumns();

        $head = [***REMOVED***;

        foreach ($columns as $column) {
            if (!in_array($column->getName(), self::excludeMapping())) {
                $head[***REMOVED*** = $column;
            }
        }
        return $head;
    }


    /*
    public function getTableColumns()
    {
        $columns = $this->table->getColumns();

        $head = [***REMOVED***;

        foreach ($columns as $column) {
            if ($this->confirm($column->getName())) {
                $head[***REMOVED*** = $column;
            }
        }

        return $head;
    }
    */

    public function isPrimaryKeyFromTable($column)
    {

        $primaryKey = $this->getPrimaryKeyColumnNameFromTable($column->getTableName());

        if ($column->getName() == $primaryKey) {
            return true;
        } else {
            return false;
        }
    }


    public function getTableUnderscore()
    {

        $filterChain = new \Zend\Filter\FilterChain();

        $filterChain->attach(new \Zend\Filter\Word\CamelCaseToUnderscore())
        ->attach(new \Zend\Filter\StringToLower());


        return $filterChain->filter($this->getTable());
    }


    public static function excludeMapping()
    {
        return array(
            'created',
            'updated',
            'updated_by',
            'id_lixeira'
        );
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

    public function getPrimaryKey()
    {
        $contraints = $this->table->getConstraints();

        if (!empty($contraints)) {
            foreach ($contraints as $contraint) {
                if ($contraint->getType() == 'PRIMARY KEY') {
                    return $contraint;
                } else {
                    continue;
                }
            }
        }
    }
}
