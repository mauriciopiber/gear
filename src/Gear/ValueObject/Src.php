<?php
namespace Gear\ValueObject;

class Src
{
    protected $type;

    protected $name;

    protected $extends;

    protected $dependency = array();

    public function getType()
    {
        return $this->type;
    }

    public function getDependency()
    {
        return $this->dependency;
    }



    public function setDependencyOpt($dependency)
    {
        $this->dependency = explode(',', $dependency);
        return $this;
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
