<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\AbstractMvc;
use GearJson\Action\Action;
use GearJson\Controller\Controller;
use Gear\Creator\File;

class RouterManager extends AbstractMvc implements ModuleManagerInterface, ActionManagerInterface
{
    use \Gear\Mvc\LanguageServiceTrait;


    public function delete(Action $controller)
    {
        throw new \Exception('Implementar');
    }

    public function get(Action $controller)
    {
        throw new \Exception('Implementar');
    }

    public function getRouter()
    {
        //arquivo onde será adicionado
        $this->fileName = $this->module->getConfigExtFolder().'/route.config.php';

        if (!is_file($this->fileName)) {
            throw new \Exception(sprintf('Não pode continuar pois não encontrou o arquivo %s', $this->fileName));
        }
        //carrega arquivo
        $router = require $this->fileName;

        return $router;
    }

    public function create(Action $action)
    {
        //ação que será adicionada.
        $this->action = $action;
        $this->moduleUrl = $this->str('url', $this->module->getModuleName());


        $router = $this->getRouter();


        //se não existe o modo cadastrado, deve retornar exceção.
        if (!isset($router['routes'***REMOVED***[$this->moduleUrl***REMOVED***)) {
            throw new \Exception(
                sprintf(
                    'Não há registro de que o módulo tenha sido criado corretamente, verifique o arquivo %s',
                    $this->fileName
                )
            );
        }

        //se não tem nenhuma rota filha, é pq não tem nenhum controller cadastrado.
        if (!isset($router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
            $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED*** = [***REMOVED***;
        }


        if ($action->getDb() === null) {
            $contRouteName = $this->str('url', $this->action->getController()->getName());
        } else {
            $contRouteName = $this->str('url', $this->action->getController()->getNameOff());
        }


        if (!array_key_exists($contRouteName, $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***)) {


            $controllerRoute = $this->getControllerRoute($action);
            $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$contRouteName***REMOVED*** = $controllerRoute;
        }


        $act = $this->str('url', $this->action->getRoute());

        if (
            !array_key_exists(
                $act,
                $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$contRouteName***REMOVED***['child_routes'***REMOVED***
            )
        ) {
            $actionRoute = $this->getActionRoute($action);
            $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$contRouteName***REMOVED***['child_routes'***REMOVED***[$act***REMOVED*** = $actionRoute;
        }

        $this->getArrayService()->arrayToFile($this->fileName, $router);

        $this->getLanguageService()->mergeLanguageUp();
    }


    public function factory(Action $action)
    {

        $module = $this->getModule()->getModuleName();

        if ($action->getDb() === null) {
            $table = $this->str('class', $action->getController()->getName());
        } else {
            $table = $this->str('class', $action->getController()->getNameOff());
        }

        switch ($this->str('url', $action->getName())) {

            case 'create':

                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{create}',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'create'
                        ),
                    )
                );

                break;

            case 'edit':

                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{edit}[/:id***REMOVED***[/:success***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'edit'
                        ),
                        'constraints' => array(
                            'id'     => '[0-9***REMOVED****',
                        ),
                    )
                );

                break;
            case 'list':

                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{list}[/page/***REMOVED***[:page***REMOVED***[/orderBy***REMOVED***[/:orderBy***REMOVED***[/:order***REMOVED***[/:success***REMOVED***',
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
                );

                break;

            case 'view':

                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{view}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'view'
                        ),
                    )
                );

                break;
            case 'delete':

                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{delete}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'delete'
                        ),
                        'constraints' => array(
                            'id'     => '[0-9***REMOVED****',
                        ),
                    )
                );


                break;

            case 'upload-image':

                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{upload-image}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'upload-image'
                        ),
                    )
                );

                break;

            default:

                $urlName = $this->str('url', $action->getRoute());
                $actionName = $this->str('url', $action->getName());

                $action = [
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/'.$urlName,
                        'defaults' => array(
                            'controller' => $this->getCode()->getClassName($action->getController()),
                            'action' => $actionName
                        )
                    ),
                ***REMOVED***;

                break;
        }

        return $action;

    }

    public function getActionRoute(Action $action)
    {
        $module = $this->getModule()->getModuleName();

        $urlName = $this->str('url', $action->getRoute());

        if ($action->getDb() === null) {
            $controllerName = $action->getController()->getName();
        } else {
            $controllerName = $action->getController()->getNameOff();
        }

        $controller = $this->getCode()->getClassName($action->getController());

        $actionName = $this->str('url', $action->getName());

        if ($action->getDb() === null) {
            $action = [
                'type' => 'segment',
                'options' => array(
                    'route' => '/'.$urlName,
                    'defaults' => array(
                        'controller' => $controller,
                        'action' => $actionName
                    )
                ),
            ***REMOVED***;

            return $action;
        }


        return $this->factory($action);
    }

    public function getControllerRoute(Action $action)
    {
        $controller = $action->getController();

        if ($action->getDb() === null) {
            $controllerRoute = $this->str('url', $controller->getName());
            $controllerName = $controller->getName();
        } else {
            $controllerRoute = $this->str('url', $controller->getNameOff());
            $controllerName = $controller->getNameOff();
        }

        $module = $this->module->getModuleName();

        $route = sprintf('/%s', $controllerRoute);
        $controller = $this->getCode()->getClassName($action);

        //cria o controller router
        $router = [
            'type' => 'segment',
            'options' => array(
                'route' => $route,
                'defaults' => array(
                    'controller' => $controller,
                    'action' => 'list'
                )
            ),
            'may_terminate' => true,
            'child_routes' => [***REMOVED***
        ***REMOVED***;

        return $router;

    }


    public function module(array $controllers)
    {
        $this->getFileCreator()->createFile(
            'template/module/config/route.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'route.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
