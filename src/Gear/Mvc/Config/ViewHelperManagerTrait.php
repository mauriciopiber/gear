<?php
namespace Gear\Mvc\Config;

trait ViewHelperManagerTrait
{
    protected $viewHelper;

    public function getViewHelperManager()
    {
        if (!isset($this->viewHelper)) {
            $this->viewHelper = $this->getServiceLocator()->get('Gear\Mvc\Config\ViewHelperManager');
        }
        return $this->viewHelper;
    }

    public function setViewHelperManager($viewHelper)
    {
        $this->viewHelper = $viewHelper;
        return $this;
    }
}
