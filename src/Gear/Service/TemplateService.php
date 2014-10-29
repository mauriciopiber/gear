<?php
namespace Gear\Service;

use Zend\View\Model\ViewModel;

class TemplateService extends \Gear\Service\AbstractService
{
    public function render($templateName, $config)
    {
        $phpRenderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();
        $view = new ViewModel($config);
        $view->setTemplate($templateName);
        return $phpRenderer->render($view);
    }
}
