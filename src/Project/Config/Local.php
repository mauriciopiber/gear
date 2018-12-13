<?php
namespace Gear\Project\Config;

use Exception;

/**
 * @deprecated
 */
class Local
{
    const MISSING_PARAMS = 'There are missing params.';

    protected $username;

    protected $password;

    protected $host;

    protected $environment;

    protected $hasDoctrine = true;

    protected $hasDb = true;

    public function __construct(array $data)
    {
        $inputFilter = (new \Gear\Project\Config\LocalFilter())->getInputFilter();
        $inputFilter->setData($data);
        if ($inputFilter->isValid() === false) {
            throw new Exception(self::MISSING_PARAMS.var_export($data, true));
        }

        $this->username = $data['username'***REMOVED***;
        $this->password = $data['password'***REMOVED***;
        $this->host = (isset($data['host'***REMOVED***)) ? $data['host'***REMOVED*** : null;
        $this->environment = isset($data['environment'***REMOVED***) ? $data['environment'***REMOVED*** : null;
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
