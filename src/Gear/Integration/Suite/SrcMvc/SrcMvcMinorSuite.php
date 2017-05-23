<?php
namespace Gear\Integration\Suite\SrcMvc;

use Gear\Integration\Suite\Mvc\MvcMinorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/SrcMvc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMvcMinorSuite extends MvcMinorSuite
{
    const SUITE = 'src-mvc-%s';

    public $type;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct(
        $majorSuite,
        $type,
        $columnType = null,
        $userType = null,
        $constraints = null,
        $tableAssoc = null,
        $useLongName = false
    ) {
        parent::__construct($majorSuite, $columnType, $userType, $constraints, $tableAssoc);
        $this->type = $type;
        $this->longName = $useLongName;

        return $this;
    }

    public function getLocationKey()
    {
        if (!isset($this->locationKey) || empty($this->locationKey)) {
            $this->locationKey = sprintf(
                '%s/%s',
                $this->getMajorSuite()->getSuite(),
                sprintf(self::SUITE, strtolower($this->getType()))
            );
        }
        return $this->locationKey;
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
