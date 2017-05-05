<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcGenerator;

use Gear\Integration\Component\GearFile\GearFileTrait;
use Gear\Integration\Component\TestFile\TestFileTrait;
use Gear\Integration\Component\MigrationFile\MigrationFileTrait;
use Gear\Integration\Util\ResolveNames\ResolveNamesTrait;
use Gear\Integration\Util\Columns\ColumnsTrait;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Integration\Component\TestFile\TestFile;
use Gear\Integration\Component\MigrationFile\MigrationFile;
use Gear\Integration\Util\ResolveNames\ResolveNames;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;

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

    public function MvcDependency()
    {
        return [
            'Entity' => null,
            'Fixture' => ['Entity'***REMOVED***,
            'Repository' => ['Entity'***REMOVED***,
            'Service' => ['Entity', 'Repository'***REMOVED***,
            'Filter' => ['Entity'***REMOVED***,
            'Form' => ['Filter', 'Entity'***REMOVED***,
            'SearchForm' => ['Entity'***REMOVED***,
            'Controller' => ['Entity', 'Fixture', 'Repository', 'Service', 'Filter', 'Form', 'SearchForm'***REMOVED***
        ***REMOVED***;
    }

    public function generateSrcMvc(SrcMvcMinorSuite $srcMvcMinor)
    {E
        $tables = $this->prepareTables($srcMvcMinor);

        $srcMvcMinor->setTableName(sprintf('src-mvc-%s', $srcMvcMinor->getType()));
        $srcMvcMinor->setLocationKey(sprintf('src-mvc-%s', $srcMvcMinor->getType()));

        $gearfile = $this->gearFile->createSrcMvcGearfile($srcMvcMinor, $tables);
        $srcMvcMinor->setGearfile($gearfile);

        if ($srcMvcMinor->getType() == 'entity') {
            $migration = $this->migrationFile->createSrcMvcMigrationFile($srcMvcMinor, $tables);
            $srcMvcMinor->setMigrationFile($migration);
        }

        $this->testFile->updateTestFile($srcMvcMinor);

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
             $tables
         );

         $srcMvcMinor->setType($middleMinor->getType());

         $columnsSuffix = $this->resolveNames->createTableUrl($srcMvcMinor);

         $srcMvcMinor->setTableName($this->resolveNames->createTableName('SrcMvc', $srcMvcMinor));
         $srcMvcMinor->setLocationKey($this->resolveNames->createLocationKey($majorTitle, $srcMvcMinor));
         $srcMvcMinor->setForeignKeys($this->columns->getForeignKeys($srcMvcMinor->getColumnType()));
         $srcMvcMinor->setColumns($this->columns->getColumns($srcMvcMinor->getColumnType(), $columnsSuffix));

         return $srcMvcMinor;
    }

    private function prepareTables(SrcMvcMinorSuite $srcMvcMinor)
    {

        $preparedTable = [***REMOVED***;

        $srcMvcMajor = $srcMvcMinor->getMajorSuite();

        foreach ($srcMvcMajor->getColumns() as $column) {
            foreach ($srcMvcMajor->getUserTypes() as $usertype) {
                foreach ($srcMvcMajor->getConstraints() as $constraint) {
                    foreach ($srcMvcMajor->getTableAssocs() as $tables) {
                        $preparedTable[***REMOVED*** = $this->prepareTable($srcMvcMinor, $column, $usertype, $constraint, $tables);
                    }
                }
            }
        }

        return $preparedTable;
    }
}
