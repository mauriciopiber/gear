<?php
namespace Gear\ValueObject\Config;

use Zend\Stdlib\Hydrator\ClassMethods;
/**
 *
 * @author piber
 *
 */
class Globaly
{

    protected $dbms;

    protected $environment;

    protected $dbname;

    protected $host;

    public function __construct($data)
    {
        if (is_array($data)) {
            $this->hydrate($data);
        }
    }


    public function extract()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    public function hydrate($data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
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

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function setEnvironment($environment)
    {
        $this->environment = $environment;
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

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }
}
