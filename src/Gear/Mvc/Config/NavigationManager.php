<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Action\Action;
use Gear\Creator\File;

class NavigationManager extends AbstractJsonService implements ModuleManagerInterface, ActionManagerInterface
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


        if ($action->getDb() === null) {
            $controllerName = $this->str('url', $this->action->getController()->getName());
        } else {
            $controllerName = $this->str('url', $this->action->getController()->getNameOff());
        }

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


        if ($this->action->getDb() === null) {
            $controllerUrl  = $this->str('url', $this->action->getController()->getName());
        } else {
            $controllerUrl  = $this->str('url', $this->action->getController()->getNameOff());
        }

        $page = [
            'label' => $this->str('label', $this->action->getRoute()),
        ***REMOVED***;

        if ($this->action->getDb() !== null
          && $this->action->getDb() instanceof \GearJson\Db\Db
            && in_array($this->action->getName(), ['Edit', 'Delete', 'View'***REMOVED***)
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


        if ($this->action->getDb() === null) {
            $controller = $this->action->getController()->getName();
        } else {
            $controller = $this->action->getController()->getNameOff();
        }

        $controllerUrl  = $this->str('url', $controller);
        $controllerLabel = $this->str('label', $controller);


        $new = [
            'label' => $controllerLabel,
            'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl)
        ***REMOVED***;

        $this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED***[***REMOVED*** = $new;
    }


    /**
     * @deprecated Não está sendo utilizado
     * @return string
     */
    public function render()
    {


        $navigation = <<<EOS
<?php
return array(
    'default' => array(
        array(
            'label' => '{$this->moduleLabel}',
            'route' => '{$this->moduleUrl}',
            'pages' => array(

EOS;

        if (!empty($this->controllers)) {
            foreach ($this->controllers as $controller) {
                $controllerLabel = $this->str('label', $controller->getNameOff());
                $controllerUrl   = $this->str('url', $controller->getNameOff());

                $navigation .= <<<EOS
                array(
                    'label' => '{$controllerLabel}',
                    'route' => '{$this->moduleUrl}/{$controllerUrl}',
                    'pages' => array(

EOS;

                if (!empty($controller->getActions())) {
                    foreach ($controller->getActions() as $action) {
                        $actionName = $this->str('label', $action->getName());
                        $actionUrl  = $this->str('url', $action->getRoute());

                        $navigation .= <<<EOS
                        array(
                            'label' => '{$actionName}',
                            'route' => '{$this->moduleUrl}/{$controllerUrl}/{$actionUrl}'
                        ),

EOS;
                    }
                }


                $navigation .= <<<EOS
                    ),
                ),

EOS;
            }
        }



        $navigation .= <<<EOS
            ),
        ),
    ),
);

EOS;
        return $navigation;
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
