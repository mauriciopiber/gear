<?php
namespace Gear\Integration\Suite\ControllerMvc;

use Gear\Integration\Suite\Mvc\MvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/ControllerSrc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMvcMinorSuite extends MvcMinorSuite
{
    const SUITE = 'controller-mvc';

    public function getSuiteName($type = null)
    {
        return self::SUITE;
    }
}
