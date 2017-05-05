<?php
namespace Gear\Integration\Component\TestFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Gear\Integration\Suite\AbstractMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;

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

    const CONSTRUCT_TEMPLATE = 'construct+=("%s;%s")';

    const CONSTRUCT_REPLACE = '#construct\+\=\(""\)#';

    const REPLACE_MODULE = '#(module=")(")#';

    const DIR_REPLACE = '#DIR#';

    const TYPE_REPLACE = '#TYPE#';

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

    public function createDefaultMigration($type)
    {
        if ($type !== 'Entity') {
            return '';
        }

        $text = '../src-mvc-%s.php';

        return $this->createDefaultMinorPath($type).'/'sprintf($text, $this->str('url', $type));
    }

    public function createDefaultGearfile()
    {
        return '';
    }

    public function createDefaultMinorPath($type)
    {
        $text = '../src-mvc-%s';
        return sprintf($text, $this->str('url', $type));

    }

    public function createConstruct($mvcMinorSuite, $dependency)
    {
        $construct = sprintf(self::CONSTRUCT_TEMPLATE, $mvcMinorSuite->getGearFile(), $mvcMinorSuite->getMigrationFile());

        if ($dependency === null) {
            return $construct;
        }

        $constructDep = [***REMOVED***;

        foreach ($dependency as $dep) {

            $constructDep[***REMOVED*** = sprintf(
                self::CONSTRUCT_TEMPLATE,
                $this->createDefaultGearfile($dep),
                $this->createDefaultMigration($dep)
            );
        }

        $implode = implode(PHP_EOL, $constructDep);

        $construct = $implode.PHP_EOL.$construct;

        return $construct;
    }


    public function updateTestFile(AbstractMinorSuite $mvcMinorSuite, array $dependency = null)
    {
        $utilPath = (get_class($mvcMinorSuite) == MvcMinorSuite::class)
            ? './../../../../../../../bin'
            : './../../../../../../bin';
        //if (get_class($mvcMinorSuite) == '' instanceof )
        $testFile = file_get_contents(__DIR__.'/test-template.sh');

        $construct = $this->createConstruct($mvcMinorSuite, $dependency);

        $newFile = preg_replace(self::CONSTRUCT_REPLACE, $construct, $testFile);

        $newFile = preg_replace(self::DIR_REPLACE, $utilPath, $newFile);

        $newFile = preg_replace(self::TYPE_REPLACE, 'web', $newFile);

        $moduleName = sprintf(self::MODULE_NAME, $this->stringService->str('class', $mvcMinorSuite->getTableName()));

        $newFile = preg_replace(self::REPLACE_MODULE, $moduleName, $newFile);




        $this->persist->save($mvcMinorSuite, self::FILENAME, $newFile);
    }
}
