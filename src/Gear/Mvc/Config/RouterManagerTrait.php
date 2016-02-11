<?php
namespace Gear\Mvc\Config;

trait RouterManagerTrait {

    protected $router;

    public function getRouterManager()
    {
        if (!isset($this->router)) {
            $this->router = $this->getServiceLocator()->get('Gear\Mvc\Config\Router');
        }
        return $this->router;
    }

    public function setRouterManager($router)
    {
        $this->router = $router;
        return $this;
    }
}
