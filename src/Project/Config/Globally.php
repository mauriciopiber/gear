<?php
namespace Gear\Project\Config;

use Exception;

/**
 *
 * @author piber
 */
class Globally
{

    protected $dbms;

    protected $dbname;

    protected $dbhost;

    public function __construct(array $data)
    {
        $inputFilter = new \Gear\Project\Config\GloballyFilter();
        $inputFilter->setData($data);

        if ($inputFilter->isValid() === false) {
            throw new Exception(self::MISSING_PARAMS, $data);
        }

        $this->dbms = $data['dbms'***REMOVED***;
        $this->dbname = $data['dbname'***REMOVED***;
        $this->dbhost = $data['dbhost'***REMOVED***;
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
