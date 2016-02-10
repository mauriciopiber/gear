<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Action\Action;
use Gear\Creator\File;

class Router extends AbstractJsonService
{
    use \Gear\Mvc\LanguageServiceTrait;


    public function insertRoutes(Action $action)
    {
        $this->action = $action;


        $this->fileName = $this->module->getConfigExtFolder().'/route.config.php';

        $this->router = require $this->fileName;

        if (!is_file($this->fileName)) {
            throw new \Exception(sprintf('Não pode continuar pois não encontrou o arquivo %s', $this->fileName));
        }

        $this->moduleUrl = $this->str('url', $this->module->getModuleName());


        if (!isset($this->router['routes'***REMOVED***[$this->moduleUrl***REMOVED***)) {
            throw new \Exception(sprintf('Não há registro de que o módulo tenha sido criado corretamente, verifique o arquivo %s', $this->fileName));
        }


        $routeName = $this->str('url', $this->action->getController()->getNameOff());


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
        $controllerRoute = $this->str('url', $this->action->getController()->getNameOff());



        $module = $this->module->getModuleName();

        $route = sprintf('/%s', $controllerRoute);
        $controller = sprintf('%s\Controller\%s', $module, $controllerName);

        $actionName = $this->str('url', $this->action->getName());
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


    public function getRouteConfig($controllers)
    {
        $this->createFileFromTemplate(
            'template/config/route.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'controllers' => $controllers
            ),
            'route.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function mergeFromDb(\GearJson\Db\Db $db)
    {
        $this->db = $db;

        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        $routeConfig = require $this->getModule()->getConfigExtFolder().'/route.config.php';

        if (!isset($routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***)) {
            throw new \Exception('Erro ao criar as routes');
        }

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

    public function mergeRouterConfig()
    {
        $routeConfig = require $this->getModule()->getConfigExtFolder().'/route.config.php';

        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());


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


    public function getDbRoute()
    {
        $routeModule = $this->str('url', $this->getModule()->getModuleName());
        $routeController = $this->str('url', $this->db->getTable());

        $module = $this->getModule()->getModuleName();
        $table = $this->db->getTable();

        $route = [
            'type' => 'segment',
            'options' => array(
                'route' => sprintf('/%s[/***REMOVED***', $routeController),
                'defaults' => array(
                    'controller' => sprintf('%s\Controller\%s', $module, $table),
                    'action' => 'list'
                )
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'create' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{create}',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'create'
                        ),
                    )
                ),
                'edit' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'edit'
                        ),
                        'constraints' => array(
                            'id'     => '[0-9***REMOVED****',
                        ),
                    )
                ),
                'list' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{list}[/page/***REMOVED***[:page***REMOVED***[/orderBy***REMOVED***[/:orderBy***REMOVED***[/:order***REMOVED***[/:success***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'list'
                        ),
                        'constraints' => array(
                            'action' => '(?!\bpage\b)(?!\borderBy\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                            'page' => '[0-9***REMOVED***+',
                            'orderBy' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                            'order' => 'ASC|DESC',
                        ),
                    )
                ),
                'delete' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{delete}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'delete'
                        ),
                        'constraints' => array(
                            'id'     => '[0-9***REMOVED****',
                        ),
                    )
                ),
                'view' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{view}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'view'
                        ),
                    )
                ),
            ),
        ***REMOVED***;


      if ($this->verifyUploadImageAssociation($this->str('class', $this->db->getTable()))) {

          $route['child_routes'***REMOVED***['upload-image'***REMOVED*** =  array(
                'type' => 'segment',
                'options' => array(
                    'route' => '{upload-image}[/:id***REMOVED***',
                    'defaults' => array(
                        'controller' => sprintf('%s\Controller\%s', $module, $table),
                        'action' => 'upload-image'
                    ),
                )
            );


      }
      return $route;
    }


}
