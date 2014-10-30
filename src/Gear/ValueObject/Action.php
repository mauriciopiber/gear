<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Action
{
    protected $controller;

    protected $name;

    protected $route;

    protected $role;

    public function __construct($action)
    {
        if (is_array($action)) {
            $this->hydrate($action);
        }
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
            'route' => $route,
            'controller' => $this->getController()
        );
    }
}

