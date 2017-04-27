<?php
namespace Gear\Integration\Component\TestFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Component/TestFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class TestFile
{
    use PersistTrait;

    use StringServiceTrait;

    const CONSTRUCT_TEMPLATE = 'construct[1***REMOVED***="%s;%s"';

    const CONSTRUCT_REPLACE = '#construct\[1\***REMOVED***=""#';

    const REPLACE_MODULE = '#(module=")(")#';

    const MODULE_NAME = '$1Pbr%s$2';

    const FILENAME = 'test.sh';

    /**
     * Constructor
     *
     * @param Persist       $persist       Persist
     * @param StringService $stringService String Service
     *
     * @return \Gear\Integration\Component\TestFile\TestFile
     */
    public function __construct(
        Persist $persist,
        StringService $stringService
    ) {
        $this->persist = $persist;
        $this->stringService = $stringService;

        return $this;
    }

    function updateTestFile(\Gear\Integration\Suite\Mvc\MvcMinorSuite $mvcMinorSuite)
    {
        $testFile = file_get_contents(__DIR__.'/test-template.sh');

        $text = sprintf(self::CONSTRUCT_TEMPLATE, $mvcMinorSuite->getGearFile(), $mvcMinorSuite->getMigrationFile());

        $newFile = preg_replace(self::CONSTRUCT_REPLACE, $text, $testFile);

        $moduleName = sprintf(self::MODULE_NAME, $this->stringService->str('class', $mvcMinorSuite->getTableName()));

        $newFile = preg_replace(self::REPLACE_MODULE, $moduleName, $newFile);

        $this->persist->save($mvcMinorSuite, self::FILENAME, $newFile);
    }
}
