<?php
namespace Gear\Project\Config;

use Zend\Stdlib\Hydrator\ClassMethods;
use GearJson\AbstractHydrator;

/**
 *
 * @author piber
 */
class Globally extends AbstractHydrator
{

    protected $dbms;

    protected $dbname;

    protected $dbhost;

    public function getInputFilter()
    {
        $inputFilter = new \Gear\Project\Config\GloballyFilter();
        return $inputFilter;
    }

    public function getDbms()
    {
        return $this->dbms;
    }

    public function setDbms($dbms)
    {
        $this->dbms = $dbms;
        return $this;
    }

    public function getDbname()
    {
        return $this->dbname;
    }

    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
        return $this;
    }

    public function getDbhost()
    {
        return $this->dbhost;
    }

    public function setDbhost($dbhost)
    {
        $this->dbhost = $dbhost;
        return $this;
    }
}
