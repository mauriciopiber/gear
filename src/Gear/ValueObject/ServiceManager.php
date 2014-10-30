<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractHydrator;


class ServiceManager extends AbstractHydrator
{
    protected $service = 'invokables';

    protected $object;

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
