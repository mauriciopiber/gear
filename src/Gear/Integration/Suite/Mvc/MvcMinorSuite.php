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

    public $gearFile;

    public $migrationFile;

    const SUITE = '%s/%s';

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

    public function getSuiteName($type = 'url')
    {
        return $this->stringService->str($type, $this->getTableName());
    }

    public function getSuitePath()
    {
        return sprintf(
            self::SUITE,
            strtolower($this->getMajorSuite()->getSuperType()),
            $this->stringService->str('url', $this->getTableName())
        );

        //return sprintf('%s/%s', )
    }

    public function getMigrationFile()
    {
        return $this->migrationFile;
    }

    public function setMigrationFile($migrationFile)
    {
        $this->migrationFile = $migrationFile;
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
