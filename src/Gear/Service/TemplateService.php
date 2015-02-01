<?php
namespace Gear\Service;

use Zend\View\Model\ViewModel;

class TemplateService extends \Gear\Service\AbstractService
{
    protected $renderer;

    public function getRenderer()
    {
        if (!isset($this->renderer)) {
            $this->renderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();
        }
        return $this->renderer;
    }

    public function setRenderer($render)
    {
        $this->renderer = $render;
        return $this;
    }

    public function render($templateName, $config)
    {
        $view = new ViewModel($config);
        $view->setTemplate($templateName);

        $phpRenderer = $this->getRenderer();



        return $phpRenderer->render($view);
    }
}
