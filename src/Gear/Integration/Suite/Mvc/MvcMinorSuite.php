<?php
namespace Gear\Integration\Suite\Mvc;

use Gear\Integration\Suite\AbstractMinorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/Mvc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcMinorSuite extends AbstractMinorSuite
{
    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\Mvc\MvcMinorSuite
     */
    public $tableName;

    public $userType;

    public $constraints;

    public $tableAssoc;

    public $columnType;

    public $majorType;

    public $locationKey;

    //the real one
    public $columns;

    public $foreignKeys;


    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct($majorType, $columnType, $userType, $constraints, $tableAssoc)
    {
        $this->majorType = $majorType;
        $this->setColumnType($columnType);
        $this->userType = $userType;
        $this->constraints = $constraints;
        $this->tableAssoc = $tableAssoc;
        return $this;
    }

    public function setForeignKeys($foreignKeys)
    {
        $this->foreignKeys = $foreignKeys;
        return $this;
    }

    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function setColumnType($columnType)
    {
        $this->columnType = ucfirst(str_replace('mvc-', '', $columnType));
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getLocationKey()
    {
        return $this->locationKey;
    }

    public function setLocationKey($locationKey)
    {
        $this->locationKey = $locationKey;
        return $this;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getColumnType()
    {
        return $this->columnType;
    }

    public function getMajorType()
    {
        return $this->majorType;
    }

    /**
     * @return string TableName
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function getTableAssoc()
    {
        return $this->tableAssoc;
    }

}
