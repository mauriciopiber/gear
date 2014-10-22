<?php
namespace Gear\ValueObject;

class RequestPage
{
    protected $controller;

    protected $action;

    protected $route;

    protected $role;

    public function __construct($page)
    {
        //$this->setController($page->controller);
        $this->setAction($page->action);

        if (isset($page->route)) {
            $this->setRoute($page->route);
        }
        $this->setRole($page->role);

        $this->setController(null);
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
