<?php
namespace Gear\Integration\Suite\Src;

use Gear\Integration\Suite\AbstractMajorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/Src
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMajorSuite extends AbstractMajorSuite
{
    const SUITE = 'src';

    protected $srcMinorSuite;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\Src\SrcMajorSuite
     */
    public function __construct()
    {
        $this->srcMinorSuite = [***REMOVED***;
        return $this;
    }

    public function addMinorSuite(SrcMinorSuite $srcMinorSuite)
    {
        $this->srcMinorSuite[***REMOVED*** = $srcMinorSuite;
    }

    public function getMinorSuite()
    {
        return $this->srcMinorSuite;
    }
}
