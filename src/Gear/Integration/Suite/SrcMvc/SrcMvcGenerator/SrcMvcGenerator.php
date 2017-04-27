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
}
