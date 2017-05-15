<?php
namespace Gear\Integration\Suite\ControllerMvc;

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
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite
     */
    public function __construct($columns = null, $userType = null, $constraints = null, $tableAssoc = null)
    {
        $this->columns = $columns;
        $this->userTypes = $userType;
        $this->constraints = $constraints;
        $this->tableAssocs = $tableAssoc;
        $this->minorSuites = [***REMOVED***;
        return $this;
    }

    public function addMinorSuite($minorSuite)
    {
        $this->minorSuites[***REMOVED*** = $minorSuite;
    }

    public function getSuite()
    {
        return self::SUITE;
    }

    public function getSuperType()
    {
        return self::SUITE;
    }
}
