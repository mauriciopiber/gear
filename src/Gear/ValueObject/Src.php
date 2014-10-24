<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Src
{
    protected $type;

    protected $name;

    protected $extends;

    protected $dependency = array();

    public function __construct($data = array())
    {
        $this->hydrate($data);
    }

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

    public function getType()
    {
        return $this->type;
    }


    public function setDependency($dependency)
    {
        if (strlen($dependency) > 1) {
            $this->dependency = explode(',', $dependency);
        } else {
            $this->dependency = [***REMOVED***;
        }
        return $this;
    }

    public function getDependency()
    {
        return $this->dependency;
    }

    public function hasDependency()
    {
        return (count($this->dependency)>0) ? true : false;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getExtends()
    {
        return $this->extends;
    }

    public function setExtends($extends)
    {
        $this->extends = $extends;

        return $this;
    }

}
