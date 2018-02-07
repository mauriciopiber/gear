<?php
namespace Gear\Creator\Template;

use Zend\View\Model\ViewModel;

class TemplateService
{
    protected $renderer;

    public function __construct($renderer = null)
    {
        $this->renderer = $renderer;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($templateName, $config)
    {
        $view = new ViewModel($config);
        $view->setTemplate($templateName);

        $phpRenderer = $this->getRenderer();

        return $phpRenderer->render($view);
    }
}
