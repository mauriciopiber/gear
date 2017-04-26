<?php
namespace Gear\Integration\Suite\Mvc;

use Gear\Integration\Suite\AbstractMajorSuite;

/**
 * PHP Version 5
 *
 * @category ValueObject
 * @package Gear/Integration/Suite/Mvc
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcMajorSuite extends AbstractMajorSuite
{
    const SUITE = 'mvc';

    public $columns;

    public $userType;

    public $constraints;

    public $tableAssoc;

    public $minorSuites;

    public $superType;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\Mvc\MvcMajorSuite
     */
    public function __construct($superType, $columns = null, $userType = null, $constraints = null, $tableAssoc = null)
    {
        $this->superType = $superType;
        $this->columns = $columns;
        $this->userTypes = $userType;
        $this->constraints = $constraints;
        $this->tableAssocs = $tableAssoc;
        $this->minorSuites = [***REMOVED***;
        return $this;
    }
    /*
    public function __construct($columns, $userType, $constraints, $tableAssoc)
    {
        $this->columns = $columns;
        $this->userTypes = $userType;
        $this->constraints = $constraints;
        $this->tableAssocs = $tableAssoc;
        $this->minorSuites = [***REMOVED***;
        return $this;
    }
    */

    public function getSuperType()
    {
        return $this->superType;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getUserTypes()
    {
        return $this->userTypes;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function getTableAssocs()
    {
        return $this->tableAssocs;
    }
}
