<?php
namespace Gear\Constructor\Builder\ControllerAction;

use Zend\ServiceManager\ServiceManager;
use Gear\ValueObject\Action;
use Gear\Constructor\Helper;


class ControllerActionView {
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        

        $this->template = 'template/constructor/controller-action/controller-action-view.phtml';
        
        $this->file = $this->serviceManager->get('fileCreator');
        $this->file->setTemplate($this->template);
        
        $this->str = $this->serviceManager->get('stringService');
        
        $this->console = $this->serviceManager->get('console');
    }
    
    public function build(Action $action) 
    {
        //acha a localização do arquivo final.
        $fileName     = sprintf('%s.phtml', $this->str->str('url', $action->getName()));
        $this->file->setFileName($fileName);
        
        $fileLocationDir = sprintf(
            '%s/module/%s/view/%s/%s',
            \GearBase\Module::getProjectFolder(),
            $this->module->getModuleName(),
            $this->str->str('url', $this->module->getModuleName()),
            $this->str->str('url', $action->getController()->getNameOff()),
            $this->str->str('url', $action->getName())
        );
        
        Helper\Dir::createDir($fileLocationDir);
        $this->file->setLocation($fileLocationDir);
    
        
        $this->file->setOptions(array(
            'module' => $this->str->str('class', $this->module->getModuleName()),
            'controller' => $this->str->str('class', $action->getController()->getNameOff()),
            'action' => $this->str->str('class', $action->getName())
        ));
        
       
        return $this->file->render();
   
    }
}