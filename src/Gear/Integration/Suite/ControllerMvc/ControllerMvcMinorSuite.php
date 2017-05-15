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

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct($majorSuite, $columnType = null, $userType = null, $constraints = null, $tableAssoc = null)
    {
        parent::__construct($majorSuite, $columnType, $userType, $constraints, $tableAssoc);
        return $this;
    }

    public function getSuiteName($type = null)
    {
        return self::SUITE;
    }

    public function getType()
    {
        return self::SUITE;
    }
}
