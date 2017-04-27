<?php
namespace Gear\Integration\Suite\Controller\ControllerSuite;

use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGeneratorTrait;
use Gear\Integration\Component\SuperTestFile\SuperTestFileTrait;
use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator;
use Gear\Integration\Component\SuperTestFile\SuperTestFile;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Integration\Suite\Controller\ControllerMajorSuite;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Integration/Suite/Controller/ControllerSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerSuite
{
    use ControllerGeneratorTrait;
    use SuperTestFileTrait;

    /**
     * Constructor
     *
     * @param ControllerGenerator $controllerGenerator Controller Generator
     * @param SuperTestFile       $superTestFile       Super Test File
     *
     * @return \Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite
     */
    public function __construct(
        ControllerGenerator $controllerGenerator,
        SuperTestFile $superTestFile
    ) {
        $this->controllerGenerator = $controllerGenerator;
        $this->superTestFile = $superTestFile;

        return $this;
    }

    public function runControllerSuite($type, $repeat)
    {
        $controllerMajor = new ControllerMajorSuite();
        $controllerMinor = new ControllerMinorSuite($controllerMajor, $type, $repeat);

        $this->controllerGenerator->generateMinorSuite($controllerMinor);
    }
}
