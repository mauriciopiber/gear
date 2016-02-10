<?php
namespace Gear\Constructor\Builder\ControllerAction;

use Zend\ServiceManager\ServiceManager;
use GearJson\Action\Action;
use Gear\Constructor\Helper;


class ControllerActionView {

    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();


        $this->file = $this->serviceManager->get('fileCreator');
        $this->file->setTemplate($this->template);

        $this->str = $this->serviceManager->get('stringService');

        $this->console = $this->serviceManager->get('console');
    }

}