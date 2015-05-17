<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Gear\ValueObject\Controller;
use Gear\ValueObject\Action;
use Gear\Common\ConfigServiceTrait;
use Gear\Common\PageTestServiceTrait;
use Gear\Common\AcceptanceTestServiceTrait;
use Gear\Common\FunctionalTestServiceTrait;
use Gear\Common\ViewServiceTrait as MvcViewService;
use Gear\Common\ControllerTestServiceTrait;
use Gear\Common\ControllerServiceTrait as MvcControllerService;

class ActionService extends AbstractJsonService
{
    use ConfigServiceTrait;
    use PageTestServiceTrait;
    use AcceptanceTestServiceTrait;
    use FunctionalTestServiceTrait;
    use ControllerTestServiceTrait;
    use MvcControllerService;
    use MvcViewService;

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

    public function create($data = array())
    {
        if (!$this->isValid($data)) {
            return false;
        }

        $controller = $this->getGearSchema()->getControllerByName($data['controller'***REMOVED***);

        if (!$controller) {
            throw new \InvalidArgumentException;
        }

        $action = new \Gear\ValueObject\Action($data);

        $controller->addAction($action);
        $jsonStatus = $this->getGearSchema()->overwrite($controller);


        $action->setController($controller);

        if (!$jsonStatus) {
            throw new \Exception('Travou no overwrite');
        }

        //var_dump($controller);die();

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
        $config->mergeRouterConfig();
    }

    public function setUpNavigation()
    {
        $config = $this->getConfigService();
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
        $service->createFromPage($action);
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
        $service->createFromPage($action);
    }

    public function setUpFunctional(Action $action, $timeToTest)
    {
        $service = $this->getFunctionalTestService();
        $service->setTimeTest($timeToTest);
        $service->createFromPage($action);
    }

    public function delete($data = array())
    {
        return true;
    }
}
