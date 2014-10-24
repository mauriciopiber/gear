<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Page
{
    protected $controller;

    protected $action;

    protected $route;

    protected $role;

    public function __construct($page)
    {
        if ($page instanceof \stdClass) {

            $this->setAction($page->action);
            if (isset($page->route)) {
                $this->setRoute($page->route);
            }
            $this->setRole($page->role);
            $this->setController(null);
        } elseif (is_array($page)) {
            $this->hydrate($page);
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

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
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
