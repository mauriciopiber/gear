<?php
namespace Gear\Integration\Suite\Mvc;

use Gear\Integration\Suite\AbstractMinorSuite;
use GearBase\Util\String\StringService;
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
    const SUITE = '%s/%s';

    const TYPE = 'mvc';

    /**
     * @var MvcMajorSuite
     */
    public $majorType;

    /**
     * @var string User Type of Minor Mvc
     */
    public $userType;

    /**
     * @var string Constraints of Minor Mvc
     */
    public $constraints;

    /**
     * @var string Table Assoc of Minor Mvc
     */
    public $tableAssoc;

    /**
     * @var string Column Type of Minor Mvc
     */
    public $columnType;

    /**
     * @var string Table Name
     */
    public $tableName;

    /**
     * @var string Table Alias
     */
    public $tableAlias;

    /**
     * @var string Location Key of Minor Suite
     */
    public $locationKey;

    /**
     * @var array
     */
    public $columns;

    /**
     * @var string
     */
    public $foreignKeys;

    /**
     * @var string
     */
    public $gearFile;

    /**
     * @var string
     */
    public $migrationFile;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct(MvcMajorSuite $majorType, $columnType, $userType, $constraints, $tableAssoc)
    {
        parent::__construct($majorType);
        $this->setColumnType($columnType);
        $this->userType = $userType;
        $this->constraints = $constraints;
        $this->tableAssoc = $tableAssoc;
        $this->stringService = new StringService();
        return $this;
    }

    public function getType()
    {
        return self::TYPE;
    }

    public function getSuiteName($type = 'url')
    {
        return $this->stringService->str($type, $this->getTableName());
    }

    public function setTableAlias($tableAlias)
    {
        $this->tableAlias = $tableAlias;
        return $this;
    }

    public function getTableAlias()
    {
        return $this->tableAlias;
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

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getColumnType()
    {
        return $this->columnType;
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
