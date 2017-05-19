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
    public function __construct(
        $majorSuite,
        $columnType = null,
        $userType = null,
        $constraints = null,
        $tableAssoc = null,
        $longName = false
    ) {
        parent::__construct($majorSuite, $columnType, $userType, $constraints, $tableAssoc);
        $this->longName = $longName;
        return $this;
    }


    public function getLocationKey()
    {
        if (!isset($this->locationKey) || empty($this->locationKey)) {
            $this->locationKey = $this->getMajorSuite()->getSuite().'/'.sprintf(self::SUITE);
        }
        return $this->locationKey;
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
