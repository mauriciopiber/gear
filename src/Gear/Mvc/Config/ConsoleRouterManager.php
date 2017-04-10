<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\AbstractMvc;
use GearJson\Action\Action;

class ConsoleRouterManager extends AbstractMvc implements ModuleManagerInterface, ActionManagerInterface
{
    public function module(array $controllers)
    {
        $this->getFileCreator()->createFile(
            'template/module/config/console.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
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
        if ($action->getController()->getDb() === null) {
            $controller = $action->getController()->getName();
        } else {
            $controller = $action->getController()->getNameOff();
        }

        $this->action = $action;
        $this->moduleUrl = $this->str('url', $this->module->getModuleName());
        $this->controllerUrl = $this->str('url', $controller);
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

        $object = '%s\%s\%s';

        $namespace = ($action->getController()->getNamespace() !== null)
            ? $action->getController()->getNamespace()
            : 'Controller';

        $invokeName = sprintf(
            $object,
            $this->module->getModuleName(),
            $namespace,
            $action->getController()->getNameOff()
        );

        $actionRoute = [
            'options' => [
                'route' => "{$this->moduleUrl} {$this->controllerUrl} {$this->actionUrl}",
                'defaults' => [
                    'controller' => $invokeName,
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
