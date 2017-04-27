<?php
namespace Gear\Integration\Suite\Mvc\MvcSuite;

use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Mvc\MvcMajorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Mvc/MvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcSuite
{
    use MvcGeneratorTrait;
    use SuperTestFileTrait;

    /**
     * Constructor
     *
     * @param MvcGenerator  $mvcGenerator  Mvc Generator
     * @param SuperTestFile $superTestFile Super Test File
     *
     * @return \Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite
     */
    public function __construct(
        MvcGenerator $mvcGenerator,
        SuperTestFile $superTestFile
    ) {
        $this->mvcGenerator = $mvcGenerator;
        $this->superTestFile = $superTestFile;

        return $this;
    }

    public function runMvcSuite($suiteName, $suiteColumns, $suiteUserTypes, $suiteConstraints, $suiteTables)
    {
        $expectedColumns = [
            $suiteName => $suiteColumns,
        ***REMOVED***;

        $configColumns = [
            'usertype' => $suiteUserTypes,
            'constraints' => $suiteConstraints,
            'tables' => $suiteTables
        ***REMOVED***;

        $minorSuites = [***REMOVED***;

        $mvcMajor = new MvcMajorSuite($suiteName);

        foreach ($expectedColumns as $superType => $columnType) {
            foreach ($columnType as $column) {
                foreach ($configColumns['usertype'***REMOVED*** as $userType) {
                    foreach ($configColumns['constraints'***REMOVED*** as $constraint) {
                        foreach ($configColumns['tables'***REMOVED*** as $tables) {

                            $mvcSuite = new MvcMinorSuite(
                                $mvcMajor,
                                $column,
                                $userType,
                                $constraint,
                                $tables
                            );
                            $minorSuites[$column***REMOVED*** = $this->mvcGenerator->generateMvc($mvcSuite);
                        }
                    }
                }

            }

            $this->superTestFile->updateSuperTestFile($mvcMajor, $minorSuites);
        }
    }
}
