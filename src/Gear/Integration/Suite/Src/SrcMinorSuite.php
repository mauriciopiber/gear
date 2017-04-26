<?php
namespace Gear\Integration\Suite\Src;

use Gear\Integration\Suite\AbstractMinorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/Src
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class SrcMinorSuite extends AbstractMinorSuite
{
    const SUITE = 'src-%s';

    protected $type;

    protected $repeat;

    protected $majorSuite;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\Src\SrcMinorSuite
     */
    public function __construct(SrcMajorSuite $majorSuite, $type, $repeat)
    {
        parent::__construct($majorSuite);
        $this->type = $type;
        $this->repeat = $repeat;
        return $this;
    }

    public function getSuiteName()
    {
        return sprintf(self::SUITE, strtolower($this->getType()));
    }

    public function getMajorSuite()
    {
        return $this->majorSuite;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getRepeat()
    {
        return $this->repeat;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setRepeat($repeat)
    {
        $this->repeat = $repeat;
        return $this;
    }
}
