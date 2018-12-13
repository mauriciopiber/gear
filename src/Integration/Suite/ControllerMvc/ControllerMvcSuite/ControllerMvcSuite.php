<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite;

use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;

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

    public function runControllerMvcSuite($suiteColumns, $suiteUserTypes, $suiteConstraints, $suiteTables, $longname)
    {
        echo '    - Create Controller Mvc Suite'."\n";

        $controllerMvcMajor = new ControllerMvcMajorSuite(
            $suiteColumns,
            $suiteUserTypes,
            $suiteConstraints,
            $suiteTables
        );

        $controllerMvcMinor = new ControllerMvcMinorSuite($controllerMvcMajor, null, null, null, null, $longname);
        $this->controllerMvcGenerator->generateControllerMvc($controllerMvcMinor);

        echo '    - Finish.'."\n\n";
    }
}
