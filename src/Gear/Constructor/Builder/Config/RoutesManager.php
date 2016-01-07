<?php
namespace Gear\Constructor\Builder\Config;

use Zend\ServiceManager\ServiceManager;
use Gear\ValueObject\Action;
use Gear\Creator\File;

class RoutesManager
{
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        
        $this->module = $this->serviceManager->get('moduleStructure');
        $this->module->prepare();
        
        
        $this->str = $this->serviceManager->get('stringService');
        
    }
    
    public function insertRoutes(Action $action)
    {
        $this->action = $action;
        
        
        $this->fileName = $this->module->getConfigExtFolder().'/route.config.php';
        
        $this->router = require $this->fileName;
        
        if (!is_file($this->fileName)) {
            throw new \Exception(sprintf('Não pode continuar pois não encontrou o arquivo %s', $this->fileName));
        }
        
        $this->moduleUrl = $this->str->str('url', $this->module->getModuleName());
      
        
        if (!isset($this->router['routes'***REMOVED***[$this->moduleUrl***REMOVED***)) {
            throw new \Exception(sprintf('Não há registro de que o módulo tenha sido criado corretamente, verifique o arquivo %s', $this->fileName));
        }
        
        
        $routeName = $this->str->str('url', $this->action->getController()->getNameOff());
        
        
        if (!isset($this->router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
            $this->router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED*** = [***REMOVED***;
        }
        
        //supõe que o controller não tenha sido criado ainda no routes. logo deve criar o controller e a primeira ação.
        
        if (!array_key_exists($routeName, $this->router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
        
            $controllerRoute = $this->getControllerRoute();
            $this->router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$routeName***REMOVED*** = $controllerRoute;
            
            File::arrayToFile($this->fileName, $this->router);
        }
        
    }
    
   
    public function getControllerRoute()
    {
        $controllerName = $this->action->getController()->getNameOff();
        $controllerRoute = $this->str->str('url', $this->action->getController()->getNameOff());
        
     
        
        $module = $this->module->getModuleName();
        
        $route = sprintf('/%s', $controllerRoute);
        $controller = sprintf('%s\Controller\%s', $module, $controllerName);
        
        $actionName = $this->str->str('url', $this->action->getName());
        $urlName = $this->action->getRoute();
        
        
        //cria o controller router
        
        $router = [
            'type' => 'segment',
            'options' => array(
                'route' => $route,
                'defaults' => array(
                    'controller' => $controller,
                    'action' => $actionName
                )
            ),
            'may_terminate' => true,
            'child_routes' => [***REMOVED***
        ***REMOVED***;
        
        
        //criar a primeira ação da controller router.
        $router['child_routes'***REMOVED***[$urlName***REMOVED*** = [
            'type' => 'segment',
            'options' => array(
                'route' => '/'.$urlName,
                'defaults' => array(
                    'controller' => $controller,
                    'action' => $actionName
                )
            ),
        ***REMOVED***;
        
        return $router;
        
    }
    
    public function mergeRouterConfig()
    {
        $routeConfig = require $this->getModule()->getConfigExtFolder().'/route.config.php';
    
        
    
    
        if (isset($routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***)) {
    
            /**
             * @TODO
             */
    
            if ($this->controller !== null) {
    
                $routeName = $this->str('url', $this->controller->getNameOff());
    
                if (!array_key_exists($routeName, $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
    
                    $controllerRoute = $this->getControllerRoute();
                    $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***[$routeName***REMOVED*** = $controllerRoute;
                    $this->arrayToFile($this->getModule()->getConfigExtFolder().'/route.config.php', $routeConfig);
    
                }
    
            } else {
    
                $module = $this->getModule()->getModuleName();
                $table = $this->db->getTable();
    
                $routeName = $this->str('url', $table);
    
                if (!isset($routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
                    $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED*** = [***REMOVED***;
                }
    
    
                if (!array_key_exists($routeName, $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
    
                    $controllerRoute = $this->getDbRoute();
                    $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***[$routeName***REMOVED*** = $controllerRoute;
                    $this->arrayToFile($this->getModule()->getConfigExtFolder().'/route.config.php', $routeConfig);
                } else {
    
                     
                    $controllerRoute = $this->getDbRoute();
                    $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***[$routeName***REMOVED*** = $controllerRoute;
                    $this->arrayToFile($this->getModule()->getConfigExtFolder().'/route.config.php', $routeConfig);
    
                }
    
            }
             
        }
    
        $this->getLanguageService()->mergeLanguageUp();
    
        return;
    }
}