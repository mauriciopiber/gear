<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\RouterManager;

trait RouterManagerTrait
{
    protected $router;

    public function getRouterManager()
    {
        return $this->router;
    }

    public function setRouterManager($router)
    {
        $this->router = $router;
        return $this;
    }
}
