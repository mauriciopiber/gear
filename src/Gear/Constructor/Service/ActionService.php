<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Service;

use Gear\Service\AbstractJsonService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\Action\ActionServiceTrait as JsonAction;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\RouterTrait;
use Gear\Mvc\View\ViewServiceTrait as MvcView;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use Gear\Mvc\Controller\ControllerServiceTrait as MvcControllerService;
use Gear\Constructor\Builder\ConsoleControllerAction as ConsoleControllerActionBuilder;
use Gear\Constructor\Builder\ControllerAction as ControllerActionBuilder;

class ActionService extends AbstractJsonService
{
    use RouterTrait;
    use ConfigServiceTrait;
    use JsonAction;
    use ControllerTestServiceTrait;
    use MvcControllerService;
    use MvcView;

    public function __construct()
    {
        parent::__construct();
    }

    public function isValid($data)
    {
        if (empty($data)) {
            return false;
        }
        return true;
    }

    public function createControllerAction($data)
    {
        $module = $this->getModule()->getModuleName();


        $this->action = $this->getActionService()->create($module, $data['controller'***REMOVED***, $data['name'***REMOVED***);
        $this->controller = $this->getActionService()->getSchemaService()->getController($module, $data['controller'***REMOVED***);
        $this->controller = new Controller($this->controller);
        $this->action->setController($this->controller);

        $this->getMvcController()->build($this->controller);
        $this->getControllerTestService()->build($this->controller);
        $this->getRouter()->insertRoutes($this->action);
        $this->getViewService()->build($this->action);

        //criar view
        //criar config



        /*
        (new ControllerActionBuilder\ControllerAction($this->getServiceLocator()))
        ->build($this->controller);
        (new ControllerActionBuilder\ControllerActionTest($this->getServiceLocator()))
        ->build($this->controller);
        (new ControllerActionBuilder\ControllerActionConfig($this->getServiceLocator()))
        ->build($this->action);

        (new ControllerActionBuilder\ControllerActionView($this->getServiceLocator()))
        ->build($this->action);
*/
        return true;

    }

    public function createConsoleControllerAction($data)
    {
        if (!$this->isValid($data)) {
            return false;
        }

        $this->jsonController = $this->getServiceLocator()->get('GearJson\Json\Controller');

        if (($controller = $this->jsonController->findByName($data['controller'***REMOVED***)) === false) {

            $this->getServiceLocator()->get('console')->writeLine(
                 sprintf('O Controller %s não está criado, crie antes de criar uma ação', $data['controller'***REMOVED***)
            );
            return false;
        }

        if ($controller->getType() !== 'console') {
            $this->getServiceLocator()->get('console')->writeLine(
                sprintf('O Controller %s não é do tipo Console, verifique o que está tentando fazer', $data['controller'***REMOVED***)
            );
            return false;
        }


        $action = new \GearJson\Action\Action($data);

        if (!empty($controller->getActions())) {

            foreach ($controller->getActions() as $actions) {
                if ($actions->getDb() instanceof \GearJson\Db\Db) {
                    $action->setDb($actions->getDb());
                }
            }
        }

        $controller->addAction($action);
        $action->setController($controller);
        //$this->controller = new Controller($data);

        $validJson = $this->getGearSchema()->overwrite($controller);

        if (!$validJson) {
            $this->getServiceLocator()->get('console')->writeLine('o Json se tornou inválido, verifique o que aconteceu.');
            return;
        }


        (new ConsoleControllerActionBuilder\ConsoleControllerAction($this->getServiceLocator()))
        ->build($this->controller);
        (new ConsoleControllerActionBuilder\ConsoleControllerActionTest($this->getServiceLocator()))
        ->build($this->controller);
        (new ConsoleControllerActionBuilder\ConsoleControllerActionConfig($this->getServiceLocator()))
        ->build($action);

        return true;


    }

    public function create($data = array())
    {
        if (!$this->isValid($data)) {
            return false;
        }

        $controller = $this->getGearSchema()->getControllerByName($data['controller'***REMOVED***);

        if (!$controller) {
            throw new \InvalidArgumentException;
        }

        $action = new \GearJson\Action\Action($data);

        if (!empty($controller->getActions())) {

            foreach ($controller->getActions() as $actions) {
                if ($actions->getDb() instanceof \GearJson\Db\Db) {
                    $action->setDb($actions->getDb());
                }
            }
        }

        $controller->addAction($action);
        $action->setController($controller);

        $jsonStatus = $this->getGearSchema()->overwrite($controller);

        if (!$jsonStatus) {
            throw new \Exception('Travou no overwrite');
        }

        //var_dump($controller);die();
        $this->action = $action;

        $this->setUpRouter();
        $this->setUpNavigation();

        $this->setUpControllerTest($controller);
        $this->setUpController($controller);


        $this->setUpPage($action);
        $time = $this->setUpView($action);
        $this->setUpAcceptance($action, $time);
        $this->setUpFunctional($action, $time);


        //action deve ser inserida dentro de um controller.

        $this->getEventManager()->trigger('doTest', $this, array('name' => 'actionInsideService'));
        return true;
    }

    public function setUpRouter()
    {
        $config = $this->getConfigService();
        $config->setAction($this->action);
        $config->mergeRouterConfig();
    }

    public function setUpNavigation()
    {
        $config = $this->getConfigService();
        $config->setAction($this->action);
        $config->mergeNavigationConfig();
    }

    public function setUpControllerTest(Controller $controller)
    {
        $controllerService = $this->getControllerTestService();
        $controllerService->implement($controller);
    }

    public function setUpController(Controller $controller)
    {
        $controllerService = $this->getControllerService();
        $controllerService->implement($controller);
    }

    public function setUpPage(Action $action)
    {
        $service = $this->getPageTestService();
        $service->createAction($action);
    }

    public function setUpView(Action $action)
    {
        $service = $this->getViewService();
        $service->createFromPage($action);
        return $service->getTimeTest();
    }

    public function setUpAcceptance(Action $action, $timeToTest)
    {
        $service = $this->getAcceptanceTestService();
        $service->setTimeTest($timeToTest);
        $service->createAction($action);
    }

    public function setUpFunctional(Action $action, $timeToTest)
    {
        $service = $this->getFunctionalTestService();
        $service->setTimeTest($timeToTest);
        $service->createAction($action);
    }

    public function delete($data = array())
    {
        return true;
    }
}
