<?php
namespace Gear\ValueObject\Config;

use Zend\Stdlib\Hydrator\ClassMethods;
use Gear\ValueObject\AbstractHydrator;

/**
 *
 * @author piber
 *
 */
class Local extends AbstractHydrator
{

    protected $username;

    protected $password;

    protected $host;

    protected $environment;

    protected $hasDoctrine = true;

    protected $hasDb = true;

    public function getInputFilter()
    {
        $inputFilter = new \Gear\Filter\LocalFilter();
        return $inputFilter;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getHasDoctrine()
    {
        return $this->hasDoctrine;
    }

    public function setHasDoctrine($hasDoctrine)
    {
        $this->hasDoctrine = (bool) $hasDoctrine;
        return $this;
    }

    public function getHasDb()
    {
        return $this->hasDb;
    }

    public function setHasDb($hasDb)
    {
        $this->hasDb = (bool) $hasDb;
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

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }
}
