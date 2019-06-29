<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use Gear\Schema\Action\Action;
use Gear\Schema\Controller\Controller;
use Gear\Mvc\Config\AbstractConfigManagerInterface;

class RouterManager extends AbstractConfigManager implements ModuleManagerInterface,
  AbstractConfigManagerInterface
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
        $this->fileName = $this->getModule()->getConfigExtFolder().'/route.config.php';

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
        $this->moduleUrl = $this->str('url', $this->getModule()->getModuleName());


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

        $contRouteName = $this->str('url', $this->action->getController()->getNameOff());

        if (!array_key_exists($contRouteName, $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
            $controllerRoute = $this->getControllerRoute($action);
            $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$contRouteName***REMOVED*** = $controllerRoute;
        }


        $act = $this->str('url', $this->action->getRoute());

        if (!array_key_exists(
            $act,
            $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$contRouteName***REMOVED***['child_routes'***REMOVED***
        ) && ($action->getController()->getType() == 'Action' || !$this->defaultAction($action->getName()))
        ) {
            $actionRoute = $this->getActionRoute($action);
            $router['routes'***REMOVED***[$this->moduleUrl***REMOVED***['child_routes'***REMOVED***[$contRouteName***REMOVED***['child_routes'***REMOVED***[$act***REMOVED*** = $actionRoute;
        }

        $this->getArrayService()->arrayToFile($this->fileName, $router);

        $this->getLanguageService()->mergeLanguageUp();
        return true;
    }

    public function defaultAction($action) {
      $fix = $this->str('class', $action);
      return in_array($fix, [
        'GetList',
        'Get',
        'Create',
        'Update',
        'Delete'
      ***REMOVED***);
    }


    public function factory(Action $action)
    {

        $module = $this->getModule()->getModuleName();

        if ($action->getController()->getDb() === null) {
            $table = $this->str('class', $action->getController()->getName());
        } else {
            $table = $this->str('class', $action->getController()->getNameOff());
        }

        $namespace = ($action->getController()->getNamespace() !== null)
            ? $action->getController()->getNamespace()
            : 'Controller';

        $controllerInvokable = $this->getCode()->getServiceManagerName($action->getController());

        switch ($this->str('url', $action->getName())) {
            case 'create':
                $action = array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{create}',
                        'defaults' => array(
                            'controller' => $controllerInvokable,
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
                            'controller' => $controllerInvokable,
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
                            'controller' => $controllerInvokable,
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
                            'controller' => $controllerInvokable,
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
                            'controller' => $controllerInvokable,
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
                            'controller' => $controllerInvokable,
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
                            'controller' => $controllerInvokable,
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
        $urlName = $this->str('url', $action->getRoute());


        $object = '%s\%s\%s';

        $namespace = ($action->getController()->getNamespace() !== null)
            ? $action->getController()->getNamespace()
            : 'Controller';

        $invokeName = $this->getCode()->getServiceManagerName($action->getController());

        $actionName = $this->str('url', $action->getName());

        if ($action->getController()->getDb() === null) {
            $action = [
                'type' => 'segment',
                'options' => array(
                    'route' => '/'.$urlName,
                    'defaults' => array(
                        'controller' => $invokeName,
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

        if ($action->getController()->getDb() === null) {
            $controllerRoute = $this->str('url', $controller->getNameOff());
            $controllerName = $controller->getName();
        } else {
            $controllerRoute = $this->str('url', $controller->getNameOff());
            $controllerName = $controller->getName();
        }

        $route = sprintf('/%s', $controllerRoute);
        $controller = $this->getCode()->getServiceManagerName($action->getController());

//var_dump($action->getController());
        $router = ($action->getController()->getType() === 'Rest')
            ? $this->factoryControllerRest($route, $controller)
            : $this->factoryControllerWeb($route, $controller);


        return $router;
    }

    public function factoryControllerWeb($route, $controller) {
      //cria o controller router
      return [
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
    }

    public function factoryControllerRest($route, $controller) {
      return [
          'type' => 'segment',
          'options' => array(
            'constraints' => [
                'id'     => '[a-zA-Z0-9***REMOVED***+',
            ***REMOVED***,
            'route' => $route.'[/:id***REMOVED***',
            'defaults' => array(
                'controller' => $controller,
            )
          ),
          'may_terminate' => true,
          'child_routes' => [***REMOVED***
      ***REMOVED***;
    }


    public function module($type = 'web', array $controllers)
    {
        $this->getFileCreator()->createFile(
            sprintf('template/module/config/route.config.%s.phtml', $type),
            [
                'module' => $this->getModule()->getNamespace(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ***REMOVED***,
            'route.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
