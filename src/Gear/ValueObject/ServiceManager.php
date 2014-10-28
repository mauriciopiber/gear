<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class ServiceManager
{
    protected $service = 'invokable';

    protected $object;

    public function extract()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    public function hydrate(array $data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }
}
