<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite;

use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/ControllerMvc/ControllerMvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMvcSuite
{
    use ControllerMvcGeneratorTrait;
    use SuperTestFileTrait;

    /**
     * Constructor
     *
     * @param ControllerMvcGenerator $controllerMvc Controller Mvc Generator
     * @param SuperTestFile          $superTestFile Super Test File
     *
     * @return \Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite
     */
    public function __construct(
        ControllerMvcGenerator $controllerMvc,
        SuperTestFile $superTestFile
    ) {
        $this->controllerMvcGenerator = $controllerMvc;
        $this->superTestFile = $superTestFile;

        return $this;
    }

    public function runControllerMvcSuite($suiteName, $suiteColumns, $suiteUserTypes, $suiteConstraints, $suiteTables)
    {
        $expectedColumns = [
            $suiteName => $suiteColumns,
        ***REMOVED***;

        $configColumns = [
            'usertype' => $suiteUserTypes,
            'constraints' => $suiteConstraints,
            'tables' => $suiteTables
        ***REMOVED***;

        $migrations = [***REMOVED***;

        foreach ($expectedColumns as $superType => $types) {
            foreach ($types as $type) {
                foreach ($configColumns['usertype'***REMOVED*** as $usertype) {
                    foreach ($configColumns['constraints'***REMOVED*** as $constraint) {
                        foreach ($configColumns['tables'***REMOVED*** as $tables) {

                            //create ControllerMvcSuiteObject
                            //run generateControllerMvc();
                            var_dump($superType, $type, $usertype, $constraint, $tables);
                        }
                    }
                }
            }
        }
    }
}
