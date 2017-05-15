<?php
namespace Gear\Integration\Suite\SrcMvc;

use Gear\Integration\Suite\Mvc\MvcMajorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/SrcMvc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMvcMajorSuite extends MvcMajorSuite
{
    const SUITE = 'src-mvc';

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

    public function addMinorSuite($srcMvcMinorSuite)
    {
        $this->minorSuites[***REMOVED*** = $srcMvcMinorSuite;
    }

    public function getSuite()
    {
        return self::SUITE;
    }

    public function getSuperType()
    {
        return self::SUITE;
    }


    /*
    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    */
}
