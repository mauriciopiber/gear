<?php
namespace Gear\Constructor\Builder\Config;

use Zend\ServiceManager\ServiceManager;
use Gear\Creator\File;

class ConsoleRoutesManager
{
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
    }
    
    public function insertConsoleRoutes(Action $action)
    {
        $this->action = $action;
        
        $this->fileName = $this->module->getConfigExtFolder().'/console.route.config.php';
        
        if (!is_file($this->fileName)) {
            throw new \Exception(sprintf('Não pode continuar pois não encontrou o arquivo %s', $this->fileName));
        }
        
        die('navigation');
    }
    
}