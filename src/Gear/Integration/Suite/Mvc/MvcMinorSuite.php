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

    //public $columns;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct($tableName, $userType, $constraints, $tables)
    {
        $this->tableName = $tableName;
        $this->userType = $userType;
        $this->constraints = $constraints;
        $this->tableAssoc = $tables;
        return $this;
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
