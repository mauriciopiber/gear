<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\ViewHelperManager;

trait ViewHelperManagerTrait
{
    protected $viewHelper;

    public function getViewHelperManager()
    {
        return $this->viewHelper;
    }

    public function setViewHelperManager($viewHelper)
    {
        $this->viewHelper = $viewHelper;
        return $this;
    }
}
