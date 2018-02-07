<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcGenerator;

use Gear\Integration\Component\GearFile\GearFileTrait;
use Gear\Integration\Component\TestFile\TestFileTrait;
use Gear\Integration\Component\MigrationFile\MigrationFileTrait;
use Gear\Integration\Util\ResolveNames\ResolveNamesTrait;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\ColumnsTrait;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\MigrationFile\MigrationFile;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use GearJson\Src\SrcTypesInterface;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/SrcMvc/SrcMvcGenerator
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMvcGenerator
{
    use GearFileTrait;

    use TestFileTrait;

    use MigrationFileTrait;

    use ResolveNamesTrait;

    use ColumnsTrait;

    /**
     * Constructor
     *
     * @param GearFile      $gearFile      Gear File
     * @param TestFile      $testFile      Test File
     * @param MigrationFile $migrationFile Migration File
     * @param ResolveNames  $resolveNames  Resolve Names
     * @param Columns       $columns       Columns
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator
     */
    public function __construct(
        GearFile $gearFile,
        TestFile $testFile,
        MigrationFile $migrationFile,
        ResolveNames $resolveNames,
        Columns $columns
    ) {
        $this->gearFile = $gearFile;
        $this->testFile = $testFile;
        $this->migrationFile = $migrationFile;
        $this->resolveNames = $resolveNames;
        $this->columns = $columns;

        return $this;
    }

    public function getMvcDependency()
    {
        return [
            SrcTypesInterface::ENTITY => null,
            SrcTypesInterface::FIXTURE => [SrcTypesInterface::ENTITY***REMOVED***,
            SrcTypesInterface::REPOSITORY => [SrcTypesInterface::ENTITY***REMOVED***,
            SrcTypesInterface::SERVICE => [SrcTypesInterface::ENTITY, SrcTypesInterface::REPOSITORY***REMOVED***,
            SrcTypesInterface::FILTER => [SrcTypesInterface::ENTITY***REMOVED***,
            SrcTypesInterface::FORM => [SrcTypesInterface::ENTITY, SrcTypesInterface::FILTER***REMOVED***,
            SrcTypesInterface::SEARCH_FORM => [SrcTypesInterface::ENTITY***REMOVED***,
        ***REMOVED***;
    }

    public function generateSrcMvc(SrcMvcMinorSuite $srcMvcMinor)
    {
        $tables = $this->prepareTables($srcMvcMinor);

        $srcMvcMinor->setTableName(sprintf('src-mvc-%s', $srcMvcMinor->getType()));

        //gearfile
        $gearfile = $this->gearFile->createSrcMvcGearfile($srcMvcMinor, $tables);
        $srcMvcMinor->setGearfile($gearfile);

        //migration
        if ($srcMvcMinor->getType() == SrcTypesInterface::ENTITY) {
            $migration = $this->migrationFile->createSrcMvcMigrationFile($srcMvcMinor, $tables);
            $srcMvcMinor->setMigrationFile($migration);
        }

        //test file
        $this->testFile->updateTestFile($srcMvcMinor, $this->getMvcDependency()[$srcMvcMinor->getType()***REMOVED***);

        echo sprintf('        - minor: %s', $srcMvcMinor->getType())."\n";

        return $srcMvcMinor;
    }

    private function prepareTable($middleMinor, $column, $usertype, $constraint, $tables)
    {
         $majorTitle = 'src-mvc';
         $srcMvcMinor = new SrcMvcMinorSuite(
             $middleMinor->getMajorSuite(),
             $majorTitle,
             $column,
             $usertype,
             $constraint,
             $tables,
             $middleMinor->isUsingLongName()
         );

         $srcMvcMinor->setType($middleMinor->getType());

         $columnsSuffix = $this->resolveNames->format($srcMvcMinor, 'url');

         $srcMvcMinor->setForeignKeys($this->columns->getForeignKeys($srcMvcMinor->getColumnType()));
         $srcMvcMinor->setColumns($this->columns->getColumns($srcMvcMinor, $columnsSuffix));

         return $srcMvcMinor;
    }

    private function prepareTables(SrcMvcMinorSuite $srcMvcMinor)
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
