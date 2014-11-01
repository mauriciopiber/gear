<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Gear\ValueObject\AbstractHydrator;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class Action extends AbstractHydrator
{
    protected $controller;

    protected $name;

    protected $route;

    protected $role;

    protected $db;

    protected $dependency = array();

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
        return (count($this->dependency) > 0) ? true : false;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb(\Gear\ValueObject\Db $db)
    {
        $this->db = $db;
        return $this;
    }

    public function __construct($data)
    {
        parent::__construct($data);

        $filter = new \Zend\Filter\Word\CamelCaseToDash();


        $filterChainActionName = new \Zend\Filter\FilterChain();
        $filterChainActionName->attach(new \Zend\Filter\Word\DashToCamelCase());


        $role = ($this->getRole() !== null) ? $this->getRole() : 'guest';
        $route = ($this->getRoute() !== null) ? $this->getRoute() :  $filter->filter($this->getName());


        $this->setName($filterChainActionName->filter($this->getName()));
        $this->setRole($role);
        $this->setRoute($route);

    }

    public function getInputFilter()
    {
        $name = new Input('name');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);


        return $inputFilter;
    }


    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
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

    public function getRoute()
    {
        return $this->route;
    }

    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function export()
    {

        $filter = new \Zend\Filter\Word\CamelCaseToDash();
        $role = ($this->getRole() !== null) ? $this->getRole() : 'guest';
        $route = ($this->getRoute() !== null) ? $this->getRoute() :  $filter->filter($this->getName());

        return array(
        	'name' => $this->getName(),
            'role' => $role,
            'route' => $route
        );
    }
}

