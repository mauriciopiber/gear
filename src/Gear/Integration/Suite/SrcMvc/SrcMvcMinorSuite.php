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
    public $tableName;

    public $userType;

    public $constraints;

    public $assoc_table;

    public $type;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite
     */
    public function __construct($tableName, $userType, $constraints, $tables, $type)
    {
        parent::__construct($tableName, $userType, $constraints, $tables);
        $this->type = $type;

        return $this;
    }
}
