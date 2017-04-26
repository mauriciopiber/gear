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
    public $type;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct($type)
    {
        //parent::__construct($majorType, $columnType, $userType, $constraints, $tableAssoc);
        $this->type = $type;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
}
