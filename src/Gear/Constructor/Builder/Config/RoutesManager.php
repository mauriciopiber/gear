<?php
namespace Gear\Constructor\Builder\Config;

use Zend\ServiceManager\ServiceManager;
use GearJson\Action\Action;
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