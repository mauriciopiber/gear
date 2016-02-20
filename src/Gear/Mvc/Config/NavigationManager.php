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
        $this->getFileCreator()->createFile(
            'template/config/navigation.config.phtml',
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
        $this->navController = sprintf(
            '%s/%s',
            $this->str('url', $this->module->getModuleName()),
            $this->str('url', $this->action->getController()->getNameOff())
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

        $this->getArrayService()->arrayToFile(
            $this->module->getConfigExtFolder().'/navigation.config.php',
            $this->navigation
        );
    }



    public function addActionToNavigation()
    {
        $moduleUrl = $this->str('url', $this->module->getModuleName());
        $controllerUrl   = $this->str('url', $this->action->getController()->getNameOff());

        $page = [
            'label' => $this->str('label', $this->action->getRoute()),
            'route' => sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $this->str('url', $this->action->getRoute()))
        ***REMOVED***;

        foreach ($this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED*** as $i => $navigation) {

            if ($navigation['route'***REMOVED*** == sprintf('%s/%s', $moduleUrl, $controllerUrl)) {

                $this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED***[$i***REMOVED***['pages'***REMOVED***[***REMOVED*** = $page;

            }

        }
    }

    public function addControllerToNavigation()
    {
        $moduleUrl = $this->str('url', $this->module->getModuleName());
        $moduleLabel = $this->str('label', $this->module->getModuleName());
        $controllerLabel = $this->str('label', $this->action->getController()->getNameOff());
        $controllerUrl   = $this->str('url', $this->action->getController()->getNameOff());

        $new = [
            'label' => $controllerLabel,
            'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl)
        ***REMOVED***;

        $this->navigation['default'***REMOVED***[$this->hasModule***REMOVED***['pages'***REMOVED***[***REMOVED*** = $new;
    }


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

    public function addControllerToNavigation2()
    {
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        $moduleLabel = $this->str('label', $this->getModule()->getModuleName());
        $controllerLabel = $this->str('label', $this->action->getController()->getNameOff());
        $controllerUrl   = $this->str('url', $this->action->getController()->getNameOff());


        $page = [
            'label' => $this->str('label', $this->action->getRoute()),
            'route' => sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $this->str('url', $this->action->getRoute()))
        ***REMOVED***;


        $new = [
            'label' => $controllerLabel,
            'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl),
            'pages' => [$page***REMOVED***
        ***REMOVED***;

        $this->navigation['default'***REMOVED***[***REMOVED*** = $new;


        $this->getArrayService()->arrayToFile(
            $this->getModule()->getConfigExtFolder().'/navigation.config.php',
            $this->navigation
        );


       /*  foreach ($controller->getActions() as $action) {

            $new['pages'***REMOVED***[***REMOVED*** = ;
        } */
    }
}
