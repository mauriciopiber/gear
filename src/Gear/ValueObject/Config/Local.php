<?php
namespace Gear\ValueObject\Config;

use Zend\Stdlib\Hydrator\ClassMethods;
/**
 *
 * @author piber
 *
 */
class Local
{
    protected $username;

    protected $password;

    protected $hasDoctrine = true;

    protected $hasDb = true;

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
}
