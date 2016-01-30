<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class Db extends AbstractHydrator
{
    protected $columns = array();

    protected $table;

    protected $tableObject;

    protected $user = 'all';

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
    public function getFirstValidPropertyFromForeignKey($columnToCheck)
    {

        $tableReferenced = $this->getForeignKeyReferencedTable($columnToCheck);

        $metadata = $this->getMetadata();

        $columns = $metadata->getColumns($tableReferenced);

        foreach ($columns as $columnItem) {


            if ($this->isPrimaryKeyFromTable($columnItem)) {
                $primary = $columnItem->getName();
            }

            if ($columnItem->getDataType() == 'varchar') {
                $property = $columnItem->getName();
            }
        }


        if (!isset($property)) {
            return $primary;
        }
        return $property;

    }

    public function isForeignKey($columnToCheck)
    {
        $table = $this->getTableObject();

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
        $table = $this->getTableObject();

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

    public function getForeignKeyReferencedTable($columnToCheck)
    {
        $table = $this->getTableObject();

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

    public function isPrimaryKey($column)
    {

        $primaryKey = $this->getPrimaryKeyColumnName();


        if ($column->getName() == $primaryKey) {
            return true;
        } else {
            return false;
        }

    }

    public function isPrimaryKeyFromTable($column)
    {

        $primaryKey = $this->getPrimaryKeyColumnNameFromTable($column->getTableName());

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

    public function getPrimaryKeyColumnName()
    {
        $table = $this->getTableObject();

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

    public static function excludeMapping()
    {
        return array(
            'created',
            'updated',
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

    public function getTableColumnsMapping()
    {
        $columns = $this->getTableObject()->getColumns();

        $head = [***REMOVED***;

        foreach ($columns as $column) {
            if (!in_array($column->getName(), self::excludeMapping())) {
                $head[***REMOVED*** = $column;
            }
        }
        return $head;
    }


    public function getTableColumns()
    {
        $columns = $this->getTableObject()->getColumns();

        $head = [***REMOVED***;

        foreach ($columns as $column) {
            if ($this->confirm($column->getName())) {
                $head[***REMOVED*** = $column;
            }
        }

        return $head;

    }

    public function getInputFilter()
    {
        $name = new Input('table');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);


        return $inputFilter;
    }

    public function getTableUnderscore()
    {

        $filterChain = new \Zend\Filter\FilterChain();

        $filterChain->attach(new \Zend\Filter\Word\CamelCaseToUnderscore())
        ->attach(new \Zend\Filter\StringToLower());


        return $filterChain->filter($this->getTable());

    }

    public function export()
    {
        return array('table' => $this->getTable(), 'columns' => $this->getColumns(), 'user' => $this->getUser());
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function getTableObject()
    {
        return $this->tableObject;
    }

    public function setTableObject(\Zend\Db\Metadata\Object\TableObject $tableObject)
    {
        $this->tableObject = $tableObject;
        return $this;
    }

    public function getColumns()
    {
        if ($this->columns == null) {
            $this->columns = array();
        }
        return $this->columns;
    }

    public function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function addColumns(\Gear\ValueObject\Column $column)
    {
        $this->columns[***REMOVED*** = $column;
        return $this;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getServiceLocator()
    {
        if (!isset($this->serviceLocator)) {
            throw new \Exception('Need to set servicelocator before call it');
        }
        return $this->serviceLocator;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getUserClass()
    {
        if ($this->user == 'low-strict') {
            return 'LowStrict';
        }
        return $this->user;
    }

    public function getDefaultUserType()
    {
        return $this->getAvailableUserType()[0***REMOVED***;
    }

    public function getAvailableUserType()
    {
        return array(
            'all',
            'low-strict',
            'strict'
        );
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }



}
