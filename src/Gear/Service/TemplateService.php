<?php
namespace Gear\Service;

use Zend\View\Model\ViewModel;
use Gear\Service\AbstractService;

class TemplateService extends AbstractService
{
    protected $renderer;

    public function getRenderer()
    {
        if (!isset($this->renderer)) {
            $this->renderer = $this->getServiceLocator()->get('viewmanager')->getRenderer();
        }
        return $this->renderer;
    }

    public function setRenderer($renderer)
    {

        //echo 'setando a porra!';
        $this->renderer = $renderer;

        //echo 'setado';

        //var_dump($this->renderer);
        //die();
    }

    public function render($templateName, $config)
    {
        $view = new ViewModel($config);
        $view->setTemplate($templateName);

        $phpRenderer = $this->getRenderer();



        return $phpRenderer->render($view);
    }
}
