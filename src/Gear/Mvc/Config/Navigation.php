<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class Navigation extends AbstractJsonService
{
    public function getNavigationConfig($controllers)
    {
        $this->createFileFromTemplate(
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

    public function mergeFromDb(\Gear\ValueObject\Db $db)
    {
        $this->db = $db;
        $this->mergeNavigationConfig();
    }

    public function mergeNavigationConfig()
    {

        $navigation = require $this->getModule()->getConfigExtFolder().'/navigation.config.php';
        $this->navigation = $navigation;


        if ($this->action !== null) {

            if (isset($navigation['default'***REMOVED***)) {

                foreach ($navigation['default'***REMOVED*** as $i => $controller) {


                    if ($controller['route'***REMOVED*** ==
                        sprintf(
                            '%s-%s',
                            $this->str('url', $this->getModule()->getModuleName()),
                            $this->str('url', $this->action->getController()->getNameOff())
                       )
                    ) {

                        $this->addPageToNavigation();
                    }
                }

                $this->addControllerToNavigation();
            }

            return;
        }


        $this->controller = $this->getGearSchema()->getControllerByDb($this->db);

        if (isset($navigation['default'***REMOVED***)) {

            $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
            $moduleLabel = $this->str('label', $this->getModule()->getModuleName());
            $controllerLabel = $this->str('label', $this->db->getTable());
            $controllerUrl   = $this->str('url', $this->db->getTable());

            foreach ($navigation['default'***REMOVED*** as $module) {

                if (isset($module['pages'***REMOVED***)) {

                    foreach ($module['pages'***REMOVED***  as $controller) {

                        if ($controller['route'***REMOVED*** == sprintf('%s/%s', $moduleUrl, $controllerUrl)) {
                            return;
                        }
                    }
                }



            }



            $new = [
                'label' => $this->str('label', $this->db->getTable(0)),
                'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl),
                'pages' => [
                  /*    [
                         'label' => $action->getRoute(),
                         'route' => sprintf('%s/%s/%s', $module, $controller, $action->getRoute())
                     ***REMOVED*** */

                ***REMOVED***
            ***REMOVED***;

            foreach ($this->controller->getActions() as $action) {

                $new['pages'***REMOVED***[***REMOVED*** = [
                     'label' => $action->getRoute(),
                     'route' => sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $action->getRoute())
                 ***REMOVED***;
            }

            foreach($navigation['default'***REMOVED*** as $i => $roles) {
                if ($roles['route'***REMOVED*** = $moduleUrl) {
                    $navigation['default'***REMOVED***[$i***REMOVED***['pages'***REMOVED***[***REMOVED*** = $new;
                    break;
                }
            }

            $this->arrayToFile($this->getModule()->getConfigExtFolder().'/navigation.config.php', $navigation);

        }
    }



    public function addControllerToNavigation()
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


        $this->arrayToFile($this->getModule()->getConfigExtFolder().'/navigation.config.php',  $this->navigation);


       /*  foreach ($controller->getActions() as $action) {

            $new['pages'***REMOVED***[***REMOVED*** = ;
        } */
    }
}
