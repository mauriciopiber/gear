<?php
namespace Gear\Mvc\Config;

trait NavigationManagerTrait
{
    protected $navigation;

    public function getNavigationManager()
    {
        if (!isset($this->navigation)) {
            $this->navigation = $this->getServiceLocator()->get('Gear\Mvc\Config\Navigation');
        }
        return $this->navigation;
    }

    public function setNavigationManager($navigation)
    {
        $this->navigation = $navigation;
        return $this;
    }
}
