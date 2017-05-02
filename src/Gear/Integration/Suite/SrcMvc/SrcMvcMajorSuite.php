<?php
namespace Gear\Integration\Suite\SrcMvc;

use Gear\Integration\Suite\Mvc\MvcMajorSuite;

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

    protected $type;

    public function addMinorSuite($srcMvcMinorSuite)
    {
        $this->minorSuites[***REMOVED*** = $srcMvcMinorSuite;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
