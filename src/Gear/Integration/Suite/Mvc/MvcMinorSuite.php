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

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct($majorType, $columnType, $userType, $constraints, $tableAssoc)
    {
        $this->majorType = $majorType;
        $this->columnType = $columnType;
        $this->userType = $userType;
        $this->constraints = $constraints;
        $this->tableAssoc = $tableAssoc;
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
