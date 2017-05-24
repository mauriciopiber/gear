<?php
namespace Gear\Integration\Component\MigrationFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Gear\Util\Vector\ArrayService;
use Gear\Integration\Suite\AbstractMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Component/MigrationFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MigrationFile
{
    use PersistTrait;

    use StringServiceTrait;

    use ArrayServiceTrait;

    /**
     * Constructor
     *
     * @param Persist       $persist       Persist
     * @param StringService $stringService String Service
     * @param ArrayService  $arrayService  Array Service
     *
     * @return \Gear\Integration\Component\MigrationFile\MigrationFile
     */
    public function __construct(
        Persist $persist,
        StringService $stringService,
        ArrayService $arrayService
    ) {
        $this->persist = $persist;
        $this->stringService = $stringService;
        $this->arrayService = $arrayService;

        return $this;
    }

    public function createForeignKeyMigration($tableId)
    {
        $nameWithoutId = str_replace('id_', '', $tableId);

        $table = $this->stringService->str('uline', $nameWithoutId);

        return [
            $table => [
                'nullable' => true,
                'unique' => false,
                'columns' => [
                    sprintf('%s_name', $this->stringService->str('uline', $table)) => ['type' => 'string'***REMOVED***
                ***REMOVED***,
                'table' => [***REMOVED***
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * Migration
     */
    public function factoryMigrationColumns($columns)
    {
        $gearfileColumns = [***REMOVED***;
        foreach ($columns as $columnName => $columnOptions) {
            if (isset($columnOptions['speciality'***REMOVED***)) {
                unset($columnOptions['speciality'***REMOVED***);
            }
            $gearfileColumns[$columnName***REMOVED*** = $columnOptions;
        }
        return $gearfileColumns;
    }


    public function createMigrationTable(AbstractMinorSuite $mvcMinorSuite)
    {
        $unique = false;
        $nullable = false;

        if (is_array($mvcMinorSuite->getConstraints())) {
            foreach ($mvcMinorSuite->getConstraints() as $const) {
                if ($const == 'nullable') {
                    $nullable = true;
                }

                if ($const == 'unique') {
                    $unique = true;
                }
            }
        }

        $tables = (!empty($mvcMinorSuite->getTableAssoc()) ? [$mvcMinorSuite->getTableAssoc()***REMOVED*** : [***REMOVED***);
        $columns = $this->factoryMigrationColumns($mvcMinorSuite->getColumns());


        return [
            $this->stringService->str('uline', $mvcMinorSuite->getTableAlias()) => [
                'nullable' => $nullable,
                'unique' => $unique,
                'referenced_assoc' => $tables,
                'columns' => $columns
            ***REMOVED***
        ***REMOVED***;
    }

    public function createSrcMvcMigrationFile(SrcMvcMinorSuite $srcMvcMinorSuite, $tables)
    {
        $migrationConfig = [***REMOVED***;

        foreach ($tables as $minorSuite) {
            $migrationConfig = array_merge($migrationConfig, $this->createMigrationTable($minorSuite));

            if (!empty($minorSuite->getForeignKeys())) {
                foreach ($minorSuite->getForeignKeys() as $foreignKey) {
                    $migrationConfig = array_merge($migrationConfig, $this->createForeignKeyMigration($foreignKey));
                }
            }
        }

        return $this->createMigrationComponent($srcMvcMinorSuite, $migrationConfig);
    }

    public function createMvcMigration(MvcMinorSuite $mvcMinorSuite)
    {
        $migrationConfig = [***REMOVED***;
        $migrationConfig = array_merge($migrationConfig, $this->createMigrationTable($mvcMinorSuite));

        if (!empty($mvcMinorSuite->getForeignKeys())) {
            foreach ($mvcMinorSuite->getForeignKeys() as $foreignKey) {
                $migrationConfig = array_merge($migrationConfig, $this->createForeignKeyMigration($foreignKey));
            }
        }

        return $this->createMigrationComponent($mvcMinorSuite, $migrationConfig);
    }


    public function getMigrationName($name)
    {
        $name = $this->stringService->str('uline', $name);
        return sprintf(
            '%s.php',
            $name
        );
    }


    public function createMigrationComponent($mvcMinorSuite, $migrationConfig)
    {
        $migrationName = $this->getMigrationName($mvcMinorSuite->getTableName());

        $template = file_get_contents(__DIR__.'/migration-template.php');

        $tables = '    const TABLES = '.$this->arrayService->varExport54($migrationConfig, '    ').';';

        $migrate = preg_replace('#    const TABLES = \[\***REMOVED***;#', $tables, $template);

        $migrate = preg_replace(
            '#MigrationName#',
            $this->stringService->str('class', $mvcMinorSuite->getTableName()),
            $migrate
        );

        $this->persist->save($mvcMinorSuite, $migrationName, $migrate);

        return $migrationName;
    }
}
