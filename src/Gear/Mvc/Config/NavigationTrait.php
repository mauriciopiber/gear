<?php
namespace Gear\Mvc\Config;

trait NavigationTrait {

    protected $navigation;

    public function getNavigation()
    {
        if (!isset($this->navigation)) {
            $this->navigation = $this->getServiceLocator()->get('Gear\Mvc\Config\Navigation');
        }
        return $this->navigation;
    }

    public function setNavigation($navigation)
    {
        $this->navigation = $navigation;
        return $this;
    }
}
