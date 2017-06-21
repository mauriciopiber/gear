<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\RouterManager;

trait RouterManagerTrait
{
    protected $router;

    public function getRouterManager()
    {
        if (!isset($this->router)) {
            $this->router = $this->getServiceLocator()->get(RouterManager::class);
        }
        return $this->router;
    }

    public function setRouterManager($router)
    {
        $this->router = $router;
        return $this;
    }
}
