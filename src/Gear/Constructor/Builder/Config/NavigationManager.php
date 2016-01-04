<?php
namespace Gear\Constructor\Builder\Config;

use Zend\ServiceManager\ServiceManager;
use Gear\ValueObject\Action;
use Gear\Creator\File;

class NavigationManager
{
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
        $this->str = $this->serviceManager->get('stringService');
    }
    
    public function insertNavigation(Action $action)
    {
        $this->action = $action;
        
        $this->fileName = $this->module->getConfigExtFolder().'/navigation.config.php';
        
        if (!is_file($this->fileName)) {
            throw new \Exception(sprintf('Não pode continuar pois não encontrou o arquivo %s', $this->fileName));
        }
        
        $this->navigation = require $this->fileName;
        
        if(!isset($this->navigation['default'***REMOVED***)) {
            throw new \Exception(sprintf('Navigation não foi criado corretamente no arquivo %s, verificar manualmente.', $this->fileName));
        }
        
        
        $this->navModule = $this->str->str('url', $this->module->getModuleName());
        
        $this->navController = sprintf(
            '%s-%s',
            $this->str->str('url', $this->module->getModuleName()),
            $this->str->str('url', $this->action->getController()->getNameOff())
        );
        
        $this->hasModule = false;
        $this->hasController = false;
        
        //route level 1
        //verifica se existe a route criada no nível module.
        foreach ($this->navigation['default'***REMOVED*** as $i => $controller) {
           
            
            if ($controller['route'***REMOVED*** == $this->navModule) {
                $this->hasModule = $i;
                break;
            }
        }
        
       
        if ($this->hasModule === false) {
            $this->createModuleNavigation();
            return;
        }
        
        //caso tenha o controller criado ao nível de módulo, procura pelo nível de controller

            
        foreach ($this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED*** as $i => $controller) {
            if ($controller['route'***REMOVED*** == $this->navController) {
                $this->hasController = $i;
                break;
            }
        }
        
        
        if ($this->hasController === false) {
            $this->addControllerToNavigation();
            return;
        }
    }
    

    public function createModuleNavigation()
    {
        die('back bad');
        
    }
    

    public function addControllerToNavigation()
    {
        $moduleUrl = $this->str->str('url', $this->module->getModuleName());
        $moduleLabel = $this->str->str('label', $this->module->getModuleName());
        $controllerLabel = $this->str->str('label', $this->action->getController()->getNameOff());
        $controllerUrl   = $this->str->str('url', $this->action->getController()->getNameOff());
    
    
        $page = [
            'label' => $this->str->str('label', $this->action->getRoute()),
            'route' => sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $this->str->str('url', $this->action->getRoute()))
        ***REMOVED***;
    
    
        $new = [
            'label' => $controllerLabel,
            'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl),
            'pages' => [$page***REMOVED***
        ***REMOVED***;
    
        $this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED***[***REMOVED*** = $new;
    

    
        File::arrayToFile($this->module->getConfigExtFolder().'/navigation.config.php',  $this->navigation);
    
    
    }
    
}