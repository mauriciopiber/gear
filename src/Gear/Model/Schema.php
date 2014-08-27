<?php

namespace Gear\Model;
use Zend\Db\Metadata\Metadata;
use Zend\Db\Metadata\MetadataInterface;
use Zend\Db\Adapter\Adapter;

class Schema extends Metadata
{
    public function __construct($dbAdapterConfig = null)
    {
        $dbAdapter = new Adapter($dbAdapterConfig);
    	parent::__construct($dbAdapter);
    }

    public function getColumnNameFromConstraint($constraint)
    {
        $column = $constraint->getColumns();
        if(isset($column[0***REMOVED***)) {
            return $column[0***REMOVED***;
        } else {
            return false;
        }
    }

    /**
     * @param string $tableName
     * @param string $columnName
     * @return Zend\Db\Metadata\Object\ConstraintObject $unique
     */
    public function getUnique($tableName,$columnName)
    {
        $unique = false;
        $constraints = $this->getConstraints($tableName);
        //var_dump($constraints);die();
        foreach($constraints as $i => $v) {
            if($v->getType()=='UNIQUE') {

                $column = $v->getColumns();

                if($column[0***REMOVED***==$columnName->getName()) {
                    $unique = $v;

                }
            }
        }
        return $unique;

    }

    public function getForeignKey($tableName,$columnName)
    {

    }

    public function getAllTableIndex($tableName)
    {

    }

    public function getAllTableForeignKey($tableName)
    {

    }

    public function getTablePrimaryKey($table) {

    }

    public function getTableForeignKeys($tableName)
    {
        $constraints = $this->getConstraints($tableName);
        $out = [***REMOVED***;
        foreach($constraints as $i => $v) {
            if($v->getType()=='FOREIGN KEY') {
                $out[***REMOVED*** = $v;
            }
        }

        return $out;
    }

    public function getPrimaryKey($name)
    {
        $constraints = $this->getConstraints($name);
        $key = null;
        if(count($constraints)>0)
        {
            $primary_key = $this->hasConstraint(null, $constraints,'PRIMARY KEY');
            $column = $primary_key->getColumns();
            $key = array_pop($column);
        }

        return $key;
    }

    public function hasConstraint($collumn_name, $constraint_collection, $type = 'FOREIGN KEY')
    {
        if (count($constraint_collection) > 0) {
            foreach ( $constraint_collection as $i => $v ) {
                if ($v->getType() == $type && count($v->getColumns()) > 0) {
                    if ($type == 'FOREIGN KEY') {
                        foreach ( $v->getColumns() as $a => $b ) {
                            if ($collumn_name == $b) {
                                return $v;
                            }
                        }
                    } elseif ($type == 'PRIMARY KEY') {
                        return $v;
                    }
                }
            }
            return false;
        } else {
            return false;
        }
    }
}