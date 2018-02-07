<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Action\Action;
use Gear\Creator\FileCreator\FileCreator;
use GearJson\Db\Db;

class NavigationManager extends AbstractConfigManager implements ModuleManagerInterface
{
    use SchemaServiceTrait;

    public function module(array $controllers)
    {
        return $this->getFileCreator()->createFile(
            'template/module/config/navigation.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'controllers' => $controllers
            ),
            'navigation.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getNavigation()
    {
        //arquivo onde será adicionado
        $this->fileName = $this->module->getConfigExtFolder().'/navigation.config.php';

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
        $this->navigation = $this->getNavigation();

        $this->navModule = $this->str('url', $this->module->getModuleName());

        $controllerName = $this->str('url', $this->action->getController()->getNameOff());

        $this->navController = sprintf(
            '%s/%s',
            $this->str('url', $this->module->getModuleName()),
            $controllerName
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
        }


        $this->addActionToNavigation();

        $file = $this->module->getConfigExtFolder().'/navigation.config.php';

        $this->getArrayService()->arrayToFile(
            $file,
            $this->navigation
        );

        return $file;
    }

    public function createDb(array $actions)
    {
        $location = null;
        foreach ($actions as $action) {
            $location = $this->create($action);
        }

        return $location;
    }



    public function addActionToNavigation()
    {
        $moduleUrl = $this->str('url', $this->module->getModuleName());

        $controllerUrl  = $this->str('url', $this->action->getController()->getNameOff());

        $page = [
            'label' => $this->str('label', $this->action->getRoute()),
        ***REMOVED***;

        if ($this->action->getController()->getDb() !== null
          && $this->action->getController()->getDb() instanceof Db
            && in_array($this->action->getName(), ['Edit', 'Delete', 'View', 'UploadImage'***REMOVED***)
        ) {
            $page['show_in_menu'***REMOVED*** = false;
        }

        $page['route'***REMOVED*** = sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $this->str('url', $this->action->getRoute()));

        //verify if route already exists
        foreach ($this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED*** as $i => $navigation) {
            if ($navigation['route'***REMOVED*** == sprintf('%s/%s', $moduleUrl, $controllerUrl)) {
                $pageAlreadyExist = $this->verifyPage($navigation, $page['route'***REMOVED***);

                if ($pageAlreadyExist === true) {
                    continue;
                }
                $this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED***[$i***REMOVED***['pages'***REMOVED***[***REMOVED*** = $page;
            }
        }
    }

    public function verifyPage(array $navigation, $route)
    {
        if (isset($navigation['pages'***REMOVED***)) {
            foreach ($navigation['pages'***REMOVED*** as $pag) {
                if ($pag['route'***REMOVED*** === $route) {
                    return true;
                }
            }
        }

        return false;
    }

    public function addControllerToNavigation()
    {

        $moduleUrl = $this->str('url', $this->module->getModuleName());


        $controller = $this->action->getController()->getNameOff();
        $controllerUrl  = $this->str('url', $controller);
        $controllerLabel = $this->str('label', $controller);


        $new = [
            'label' => $controllerLabel,
            'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl)
        ***REMOVED***;

        $this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED***[***REMOVED*** = $new;
    }

    public function delete(Action $controller)
    {
        throw new \Exception('Implementar');
    }

    public function get(Action $controller)
    {
        throw new \Exception('Implementar');
    }
}
