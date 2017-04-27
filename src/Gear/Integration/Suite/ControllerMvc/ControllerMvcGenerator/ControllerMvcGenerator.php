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


    public function generateControllerMvc(ControllerMvcMinorSuite $controllerMvcMinor)
    {
        $tables = $this->prepareTables($controllerMvcMinor);

        $this->createControllerMvcGearfile($controllerMvcMinor, $tables);

        $this->createControllerMvcTestFile($controllerMvcMinor);
    }

    private function prepareTables(ControllerMvcMinorSuite $controllerMvcMinor)
    {

        $preparedTable = [***REMOVED***;

        $controllerMvcMajor = $controllerMvcMinor->getMajorSuite();

        foreach ($controllerMvcMajor->getColumns() as $column) {
            foreach ($controllerMvcMajor->getUserTypes() as $usertype) {
                foreach ($controllerMvcMajor->getConstraints() as $constraint) {
                    foreach ($controllerMvcMajor->getTableAssocs() as $tables) {

                        $majorTitle = 'controller-mvc';
                        $controllerMvcMinor = new ControllerMvcMinorSuite(
                            $controllerMvcMinor->getMajorSuite(),
                            $majorTitle,
                            $column,
                            $usertype,
                            $constraint,
                            $tables
                        );

                        //$columnsSuffix = $this->resolveNames->createTableUrl($controllerMvcMinor);

                        $controllerMvcMinor->setTableName($this->resolveNames->createTableName('ControllerMvc', $controllerMvcMinor));
                        //$controllerMvcMinor->setLocationKey($this->resolveNames->createLocationKey($majorTitle, $controllerMvcMinor));
                        //$controllerMvcMinor->setForeignKeys($this->columns->getForeignKeys($controllerMvcMinor->getColumnType()));
                        //$controllerMvcMinor->setColumns($this->columns->getColumns($controllerMvcMinor->getColumnType(), $columnsSuffix));

                        $preparedTable[***REMOVED*** = $controllerMvcMinor;

                    }
                }
            }
        }

        return $preparedTable;
    }

    private function createControllerMvcGearFile(ControllerMvcMinorSuite $controllerMvcMinor, $tables)
    {
        echo 'create controller mvc gearfile'."\n";
    }

    private function createControllerMvcMigrationFile(ControllerMvcMinorSuite $controllerMvcMinor, $tables)
    {
        echo 'create controller mvc migration'."\n";
    }

    private function createControllerMvcTestFile(ControllerMvcMinorSuite $controllerMvcMinor)
    {
        echo 'create controller mvc test'."\n";
    }
}
