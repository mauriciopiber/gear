<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\Navigation;

trait NavigationManagerTrait
{
    protected $navigation;

    public function getNavigationManager()
    {
        if (!isset($this->navigation)) {
            $this->navigation = $this->getServiceLocator()->get(NavigationManager::class);
        }
        return $this->navigation;
    }

    public function setNavigationManager($navigation)
    {
        $this->navigation = $navigation;
        return $this;
    }
}
