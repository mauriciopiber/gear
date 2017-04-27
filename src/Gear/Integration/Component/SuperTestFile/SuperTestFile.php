<?php
namespace Gear\Integration\Component\SuperTestFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Component/SuperTestFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SuperTestFile
{
    use PersistTrait;

    use StringServiceTrait;

    const TEMPLATE_CONSTRUCTOR = 'construct+=("%s/%s:%s/%s")';

    const REPLACE_CONSTRUCTOR = 'construct+=("")';

    const REPLACE_MODULE = '#(module=")(")#';

    const MODULE_NAME = '$1Pbr%s$2';

    const FILENAME = 'test.sh';

    /**
     * Constructor
     *
     * @param Persist       $persist       Persist
     * @param StringService $stringService String Service
     *
     * @return \Gear\Integration\Component\SuperTestFile\SuperTestFile
     */
    public function __construct(
        Persist $persist,
        StringService $stringService
    ) {
        $this->persist = $persist;
        $this->stringService = $stringService;

        return $this;
    }

    function updateSuperTestFile($superType, $migrations)
    {
        $testFile = file_get_contents(__DIR__.'/test-super-template.sh');

        $constructTemplate = self::TEMPLATE_CONSTRUCTOR.PHP_EOL;

        $construct = '';

        foreach ($migrations as $suite) {
            $locationKey = $suite->getLocationKey();

            $folder = array_values(array_slice(explode('/', $locationKey), -1))[0***REMOVED***;

            $gearfile = $suite->getGearFile();
            $migration = $suite->getMigrationFile();

            $construct .= sprintf($constructTemplate, $folder, $gearfile, $folder, $migration);

        }

        $newFile = str_replace(self::REPLACE_CONSTRUCTOR, $construct, $testFile);

        $moduleName = sprintf(self::MODULE_NAME, $this->stringService->str('class', $superType->getSuperType()));
        $newFile = preg_replace(self::REPLACE_MODULE, $moduleName, $newFile);


        $this->persist->save($superType, self::FILENAME, $newFile);
    }
}
