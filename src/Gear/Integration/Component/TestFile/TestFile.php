<?php
namespace Gear\Integration\Component\TestFile;

use Gear\Integration\Util\Persist\PersistTrait;
use GearBase\Util\String\StringServiceTrait;
use Gear\Integration\Util\Persist\Persist;
use GearBase\Util\String\StringService;
use Gear\Integration\Suite\AbstractMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Suite\Src\SrcMinorSuite;

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

    public function createDefaultMigration($minorSuite, $type)
    {
        if ($type !== 'Entity') {
            return '';
        }

        $text = 'src_mvc_%s.php';

        return $this->createDefaultMinorPath($minorSuite, $type).'/'.sprintf($text, $this->str('uline', $type));
    }

    public function createDefaultGearfile($minorSuite, $type)
    {
        $text = 'src-mvc-%s.yml';

        return $this->createDefaultMinorPath($minorSuite, $type).'/'.sprintf($text, $this->str('url', $type));
    }

    public function createDefaultMinorPath($minorSuite, $type)
    {
        if ($minorSuite instanceof ControllerMvcMinorSuite) {
            $text = '../../src-mvc-%s';
            return sprintf($text, $this->str('url', $type));
        }

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
                $this->createDefaultGearfile($mvcMinorSuite, $dep),
                $this->createDefaultMigration($mvcMinorSuite, $dep)
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

        $newFile = preg_replace(self::TYPE_REPLACE, $this->getModuleType($mvcMinorSuite), $newFile);

        $moduleName = $this->getModuleName($mvcMinorSuite);

        $newFile = preg_replace(self::REPLACE_MODULE, $moduleName, $newFile);

        $this->persist->save($mvcMinorSuite, self::FILENAME, $newFile);
    }

    public function getModuleType(AbstractMinorSuite $mvcMinorSuite)
    {
        if ($mvcMinorSuite instanceof MvcMinorSuite) {
            return 'web';
        }


        if ($mvcMinorSuite instanceof SrcMinorSuite && $mvcMinorSuite->getType() == 'view-helper') {
            return 'web';
        }

        if ($mvcMinorSuite instanceof SrcMinorSuite) {
            return 'cli';
        }

        if ($mvcMinorSuite instanceof ControllerMinorSuite && $mvcMinorSuite->getType() == 'console') {
            return 'cli';
        }

        return 'web';
    }

    public function getModuleName(AbstractMinorSuite $mvcMinorSuite)
    {
        if ($mvcMinorSuite instanceof MvcMinorSuite) {

            if ($mvcMinorSuite->getTableName() == null) {
                return sprintf(self::MODULE_NAME, '');
            }

            return sprintf(self::MODULE_NAME, $this->stringService->str('class', $mvcMinorSuite->getTableName()));
        }

        $moduleName = $this->stringService->str('class', sprintf($mvcMinorSuite::SUITE, $mvcMinorSuite->getType()));

        return sprintf(self::MODULE_NAME, $moduleName);

    }
}
