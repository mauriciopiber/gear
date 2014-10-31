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

class ActionService extends AbstractJsonService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isValid($data)
    {
        return true;
    }

    public function create($data = array())
    {

        if ($this->isValid($data)) {

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
        }



        $this->getEventManager()->trigger('doTest', $this, array('name' => 'actionInsideService'));
        return true;
    }

    public function setUpRouter()
    {
        $config = $this->getServiceLocator()->get('configService');
        $config->mergeRouterConfig();
    }

    public function setUpNavigation()
    {
        $config = $this->getServiceLocator()->get('configService');
        $config->mergeNavigationConfig();
    }

    public function setUpControllerTest(Controller $controller)
    {

        $controllerService = $this->getServiceLocator()->get('controllerTestService');
        $controllerService->implement($controller);

    }

    public function setUpController(Controller $controller)
    {
        $controllerService = $this->getServiceLocator()->get('controllerService');
        $controllerService->implement($controller);

    }

    public function setUpPage(Action $action)
    {
        $service = $this->getServiceLocator()->get('pageTestService');
        $service->createFromPage($action);
    }

    public function setUpView(Action $action)
    {
        $service = $this->getServiceLocator()->get('viewService');
        $service->createFromPage($action);
        return $service->getTimeTest();
    }

    public function setUpAcceptance(Action $action, $timeToTest)
    {
        $service = $this->getServiceLocator()->get('acceptanceTestService');
        $service->setTimeTest($timeToTest);
        $service->createFromPage($action);
    }

    public function setUpFunctional(Action $action, $timeToTest)
    {
        $service = $this->getServiceLocator()->get('functionalTestService');
        $service->setTimeTest($timeToTest);
        $service->createFromPage($action);
    }

    public function delete($data = array())
    {
        return true;
    }
}
