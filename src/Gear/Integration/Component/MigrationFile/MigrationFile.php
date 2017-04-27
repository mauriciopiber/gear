<?php
namespace Gear\Integration\Component\MigrationFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Gear\Util\Vector\ArrayService;

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

    public function getMigrationName($name)
    {
        $name = $this->stringService->str('uline', $name);
        return sprintf(
            '%s.php',
            $name
        );
    }


    public function createMigration($mvcMinorSuite, $migrationConfig)
    {
        $migrationName = $this->getMigrationName($mvcMinorSuite->getTableName());

        $template = file_get_contents(__DIR__.'/migration-template.php');

        $tables = '    const TABLES = '.$this->arrayService->varExport54($migrationConfig, '    ').';';
        $migrate = preg_replace('#    const TABLES = \[\***REMOVED***;#', $tables, $template);
        $migrate = preg_replace('#MigrationName#', $mvcMinorSuite->getTableName(), $migrate);

        $this->persist->save($mvcMinorSuite, $migrationName, $migrate);

        return $migrationName;
    }
}
