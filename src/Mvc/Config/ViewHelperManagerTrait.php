<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ViewHelperManager;

trait ViewHelperManagerTrait
{
    protected $viewHelper;

    public function getViewHelperManager()
    {
        if (!isset($this->viewHelper)) {
            $this->viewHelper = $this->getServiceLocator()->get(ViewHelperManager::class);
        }
        return $this->viewHelper;
    }

    public function setViewHelperManager($viewHelper)
    {
        $this->viewHelper = $viewHelper;
        return $this;
    }
}
