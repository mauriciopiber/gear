<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class Src extends AbstractHydrator
{
    protected $type;

    protected $name;

    protected $service;

    protected $extends;

    protected $db;

    protected $dependency = array();

    public function getInputFilter()
    {
        $type = new Input('type');
        $type->getValidatorChain()->addValidator(new \Zend\Validator\NotEmpty());

        $name = new Input('name');
        $name->getValidatorChain()->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);
        $inputFilter->add($type);

        return $inputFilter;
    }

    public function export()
    {
        return array(
            'name' => $this->getName(),
            'type' => $this->getType(),
            'dependency' => $this->getDependency(),
            'db' => ($this->getDb() instanceof \Gear\ValueObject\Db) ? $this->getDb()->getTable() : null
        );
    }

    public function getType()
    {
        return $this->type;
    }

    public function setDependency($dependency = null)
    {
        if (is_array($dependency)) {
            $this->dependency = $dependency;
        } elseif (strlen($dependency) > 1) {
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
        return (count($this->dependency) > 0) ? true : false;
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

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }
}
