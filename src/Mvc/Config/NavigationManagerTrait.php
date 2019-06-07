<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\Navigation;

trait NavigationManagerTrait
{
    protected $navigation;

    public function getNavigationManager()
    {
        return $this->navigation;
    }

    public function setNavigationManager($navigation)
    {
        $this->navigation = $navigation;
        return $this;
    }
}
