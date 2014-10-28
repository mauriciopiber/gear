<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Action
{
    protected $controller;

    protected $action;

    protected $route;

    protected $role;

    public function __construct($action)
    {
        if ($action instanceof \stdClass) {

            $this->setAction($action->action);
            if (isset($action->route)) {
                $this->setRoute($action->route);
            }
            $this->setRole($action->role);
            $this->setController(null);
        } elseif (is_array($action)) {
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
        return $this->action;
    }

    public function setName($action)
    {
        $this->action = $action;
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
}
