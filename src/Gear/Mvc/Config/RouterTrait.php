<?php
namespace Gear\Mvc\Config;

trait RouterTrait {

    protected $router;

    public function getRouter()
    {
        if (!isset($this->router)) {
            $this->router = $this->getServiceLocator()->get('Gear\Mvc\Config\Router');
        }
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
        return $this;
    }
}
