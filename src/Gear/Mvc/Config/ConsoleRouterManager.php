<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Action\Action;
use Gear\Creator\File;

class ConsoleRouterManager extends AbstractJsonService implements ModuleManagerInterface, ActionManagerInterface
{
    public function module(array $controllers)
    {
        $this->createFileFromTemplate(
            'template/module/mvc/config/console.phtml',
            array(
                'controllers' => $controllers
            ),
            'console.route.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getConsoleRouter()
    {
        //arquivo onde será adicionado
        $this->fileName = $this->module->getConfigExtFolder().'/console.route.config.php';

        if (!is_file($this->fileName)) {
            throw new \Exception(sprintf('Não pode continuar pois não encontrou o arquivo %s', $this->fileName));
        }
        //carrega arquivo
        $router = require $this->fileName;

        return $router;
    }

    public function create(Action $action)
    {
        $this->action = $action;
        $this->moduleUrl = $this->str('url', $this->module->getModuleName());
        $this->controllerUrl = $this->str('url', $this->action->getController()->getNameOff());
        $this->actionUrl = $this->str('url', $this->action->getRoute());

        $router = $this->getConsoleRouter();

        $routerKey = "{$this->moduleUrl}-{$this->controllerUrl}-{$this->actionUrl}";

        if (!array_key_exists($routerKey, $router['router'***REMOVED***['routes'***REMOVED***)) {
            $controllerRoute = $this->getConsoleRoute($action);
            $router['router'***REMOVED***['routes'***REMOVED***[$routerKey***REMOVED*** = $controllerRoute;
        }

        $this->getArrayService()->arrayToFile($this->fileName, $router);
    }

    public function getConsoleRoute(Action $action)
    {
        $module = $this->getModule()->getModuleName();
        $controller = $action->getController()->getNameOff();

        $actionRoute = [
            'options' => [
                'route' => "{$this->moduleUrl} {$this->controllerUrl} {$this->actionUrl}",
                'defaults' => [
                    'controller' => "{$module}\Controller\\{$controller}",
                    'action' => $this->actionUrl
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        return $actionRoute;

    }


    public function delete(Action $action)
    {
        throw new \Exception('Implementar');
    }

    public function get(Action $action)
    {
        throw new \Exception('Implementar');
    }
}
