<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator;

use Gear\Integration\Component\GearFile\GearFileTrait;
use Gear\Integration\Component\TestFile\TestFileTrait;
use Gear\Integration\Util\ResolveNames\ResolveNamesTrait;
use Gear\Integration\Util\Columns\ColumnsTrait;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/ControllerMvc/ControllerMvcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMvcGenerator
{
    use GearFileTrait;

    use TestFileTrait;

    use ResolveNamesTrait;
    use ColumnsTrait;

    /**
     * Constructor
     *
     * @param GearFile     $gearFile     Gear File
     * @param TestFile     $testFile     Test File
     * @param ResolveNames $resolveNames Resolve Names
     * @param Columns      $columns      Columns
     *
     * @return \Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator
     */
    public function __construct(
        GearFile $gearFile,
        TestFile $testFile,
        ResolveNames $resolveNames,
        Columns $columns
    ) {
        $this->gearFile = $gearFile;
        $this->testFile = $testFile;
        $this->resolveNames = $resolveNames;
        $this->columns = $columns;

        return $this;
    }


    public function getMvcDependency()
    {
        return [
            'controller' => ['Entity', 'Fixture', 'Repository', 'Service', 'Filter', 'Form', 'SearchForm'***REMOVED***
        ***REMOVED***;
    }

    public function generateControllerMvc(ControllerMvcMinorSuite $controllerMvcMinor)
    {
        $tables = $this->prepareTables($controllerMvcMinor);

        $gearfile = $this->gearFile->createControllerMvcGearfile($controllerMvcMinor, $tables);
        $controllerMvcMinor->setGearfile($gearfile);

        $this->testFile->updateTestFile($controllerMvcMinor, $this->getMvcDependency()['controller'***REMOVED***);
    }


    private function prepareTable($middleMinor, $column, $usertype, $constraint, $tables)
    {
         $srcMvcMinor = new ControllerMvcMinorSuite(
             $middleMinor->getMajorSuite(),
             $column,
             $usertype,
             $constraint,
             $tables,
             $middleMinor->isUsingLongName()
         );

         $columnsSuffix = $this->resolveNames->format($srcMvcMinor, 'url');

         $srcMvcMinor->setTableName($this->resolveNames->createTableName($srcMvcMinor));
         $srcMvcMinor->setTableAlias($this->resolveNames->createTableAlias('SrcMvc', $srcMvcMinor));

         $srcMvcMinor->setForeignKeys($this->columns->getForeignKeys($srcMvcMinor->getColumnType()));
         $srcMvcMinor->setColumns($this->columns->getColumns($srcMvcMinor, $columnsSuffix));
         return $srcMvcMinor;
    }

    private function prepareTables(ControllerMvcMinorSuite $srcMvcMinor)
    {

        $preparedTable = [***REMOVED***;

        $srcMvcMajor = $srcMvcMinor->getMajorSuite();

        $tables = $srcMvcMajor->getTables();

        foreach ($tables as $tableInfo) {
            list($column, $userType, $constraint, $tableAssoc) = $tableInfo;
            $preparedTable[***REMOVED*** = $this->prepareTable($srcMvcMinor, $column, $userType, $constraint, $tableAssoc);
        }

        return $preparedTable;
    }
}
