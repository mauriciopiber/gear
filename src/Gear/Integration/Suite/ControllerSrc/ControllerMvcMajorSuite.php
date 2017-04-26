<?php
namespace Gear\Integration\Suite\ControllerSrc;

use Gear\Integration\Suite\Mvc\MvcMajorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/ControllerSrc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ControllerMvcMajorSuite extends MvcMajorSuite
{
    const SUITE = 'controller-mvc';

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\ControllerSrc\ControllerMvcMajorSuite
     */
    public function __construct()
    {
        return $this;
    }
}
