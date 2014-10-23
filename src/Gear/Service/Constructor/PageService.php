<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;

class PageService extends AbstractJsonService
{
    protected $viewService;

    protected $pageTestService;

    protected $acceptanceTestService;

    protected $functionalTestService;

    protected $configService;

    protected $controllerTestService;

    protected $controllerService;

    public function create(array $pageParams)
    {
        $page  = $this->pushPageIntoSchema($pageParams);

        $pageName = sprintf(
            '%s\%s\%s',
            $this->getConfig()->getModule(),
            $page->getController()->getName(),
            $page->getAction()
        );

        $this->outputGreen(sprintf(
            'Page %s registered on json schema, let\'s do the job.', $pageName
        ));

        try {

            $pageTest        = $this->getServiceLocator()->get('pageTestService');
            $pageTest->createFromPage($page);

            $view            = $this->getServiceLocator()->get('viewService');
            $view->createFromPage($page);

            $acceptanceTest  = $this->getServiceLocator()->get('acceptanceTestService');
            $acceptanceTest->setTimeTest($view->getTimeTest());
            $acceptanceTest->createFromPage($page);

            $functionalTest  = $this->getServiceLocator()->get('functionalTestService');
            $functionalTest->setTimeTest($view->getTimeTest());
            $functionalTest->createFromPage($page);

            $config          = $this->getServiceLocator()->get('configService');
            $config->mergeControllerConfig($this->getJson());
            $config->mergeRouteConfig($this->getJson());
            $config->mergeNavigationConfig($this->getJson());

            $controllerTest  = $this->getServiceLocator()->get('controllerTestService');
            $controllerTest->merge($page, $this->getJson());

            $controller      = $this->getServiceLocator()->get('controllerService');
            $controller->merge($page, $this->getJson());

        } catch(\Exception $exception) {

            var_dump($exception);
        }

        $this->outputGreen(sprintf(
            'Page %s created successful', $pageName
        ));

        return true;
    }
    /**
     */
    public function pushPageIntoSchema(array $page)
    {

        list($tempController,$tempId) = $this->findControllerArray($page);

        $module = $this->getConfig()->getModule();

        $json = $this->getSchema();

        $pages = &$json->$module->page;

        if ($tempController === null) {
            $controller = new \stdClass();
            $controller->controller =  $page['controller'***REMOVED***;
            $controller->invokable  = $page['invokable'***REMOVED***;

            $action = $this->createStdAction($page);

            $controller->actions = [$action***REMOVED***;

            $pages = &$json->$module->page;
            $pages[***REMOVED*** = $controller;
        } else {
            $controller = $tempController;
            unset($tempController);
            $this->outputYellow(sprintf('Controller %s já fazia parte do módulo %s', $controller->controller, $this->getConfig()->getModule()));


            $tempAction = null;

            foreach ($controller->actions as $action) {
                if ($action->action == $page['action'***REMOVED***) {
                    $tempAction = &$action;
                    break;
                }
                continue;
            }

            if ($tempAction === null) {
                $action = $this->createStdAction($page);

                $actions = $controller->actions;
                $actions[***REMOVED*** = $action;
                $controller->actions = $actions;

                $pages = &$json->$module->page;
                $pages[$tempId***REMOVED*** = $controller;

            } else {
                echo sprintf('Neiter Controller or Action was added becouse are loaded already');
            }
        }

        if ($this->getJsonService()->writeJson(\Zend\Json\Json::encode($json))) {

            $json = $this->getSchema();

            $pages = &$json->$module->page;


            if (!$tempId) {
                $tempId = count($pages)-1;
            }

            $controller = new \Gear\ValueObject\Controller($json->$module->page[$tempId***REMOVED***);

            $page = $controller->getPage($page['controller'***REMOVED***, $page['action'***REMOVED***);

            return $page;

        } else {
            throw new \Exception('Json on page are in danger, come over to PageService:111 to seee whats happenning DANGER');
        }
    }

    public function createStdAction($page)
    {
        $action = new \stdClass();
        $action->route  = $page['route'***REMOVED***;
        $action->role   = $page['role'***REMOVED***;
        $action->action = $page['action'***REMOVED***;

        return $action;
    }
}
