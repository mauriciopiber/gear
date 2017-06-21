<?php
/**
 */
namespace Gear\Constructor\Action;

use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\Db\Db;
use GearJson\Action\ActionServiceTrait as ActionSchemaTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\RouterManagerTrait;
use Gear\Mvc\Config\ConsoleRouterManagerTrait;
use Gear\Mvc\Config\NavigationManagerTrait;
use Gear\Mvc\View\ViewServiceTrait;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use Gear\Mvc\Controller\ControllerServiceTrait as MvcControllerService;
use Gear\Mvc\ConsoleController\ConsoleControllerTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use Gear\Mvc\View\App\AppControllerServiceTrait;
use Gear\Mvc\View\App\AppControllerSpecServiceTrait;
use Gear\Mvc\View\App\AppControllerService;
use Gear\Mvc\View\App\AppControllerSpecService;
use Gear\Mvc\Spec\Feature\FeatureTrait;
use Gear\Mvc\Spec\Page\PageTrait;
use Gear\Mvc\Spec\Step\StepTrait;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Mvc\Spec\Feature\Feature;
use GearJson\Action\ActionService as ActionSchema;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\Config\RouterManager;
use Gear\Mvc\Config\ConsoleRouterManager;
use Gear\Mvc\Config\NavigationManager;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Controller\ControllerService;
use Gear\Mvc\Controller\ControllerTestService;
use Gear\Mvc\ConsoleController\ConsoleController;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Step\Step;
use Gear\Module\BasicModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Constructor\AbstractConstructor;

/**
 * @group m1
 */
class ActionService extends AbstractConstructor
{
    use StringServiceTrait;

    use ModuleAwareTrait;

    use PageTrait;

    use StepTrait;

    use FeatureTrait;

    use AppControllerServiceTrait;

    use AppControllerSpecServiceTrait;

    /* schema */
    use ActionSchemaTrait;

    /* mvc config */
    use ConfigServiceTrait;

    /* mvc config route */
    use ConsoleRouterManagerTrait;
    use RouterManagerTrait;

    /* mvc config navigation */
    use NavigationManagerTrait;

    /* mvc console controller */
    use ConsoleControllerTestTrait;
    use ConsoleControllerTrait;

    /* mvc controller */
    use ControllerTestServiceTrait;
    use MvcControllerService;

    /* mvc view */
    use ViewServiceTrait;

    /**
     * Constructor
     *
     * @param Feature              $feature              Feature
     * @param ActionService        $actionService        Action Service
     * @param ConfigService        $configService        Config Service
     * @param RouterManager        $routerManager        Router Manager
     * @param ConsoleRouterManager $consoleRouterManager Console Router Manager
     * @param NavigationManager    $navigationManager    Navigation Manager
     * @param ViewService          $viewService          View Service
     * @param ControllerService    $controllerService    Controller Service
     * @param ConsoleController    $consoleController    Console Controller
     * @param AppControllerService $appControllerService App Controller Service
     * @param Feature              $feature              Feature
     * @param Page                 $page                 Page
     * @param Step                 $step                 Step
     * @param BasicModuleStructure $basicModuleStructure Basic Module Structure
     * @param StringService        $stringService        String Service
     *
     * @return ActionService
     */
    public function __construct(
        ActionSchema $actionService,
        RouterManager $routerManager,
        ConsoleRouterManager $consoleRouterManager,
        NavigationManager $navigationManager,
        ViewService $viewService,
        ControllerService $controllerService,
        ControllerTestService $controllerServiceTest,
        ConsoleController $consoleController,
        ConsoleControllerTest $consoleControllerTest,
        AppControllerService $appControllerService,
        AppControllerSpecService $appControllerTestService,
        Feature $feature,
        Page $page,
        Step $step,
        BasicModuleStructure $basicModuleStructure,
        StringService $stringService
    ) {
        parent::__construct($basicModuleStructure, $stringService, null, null);

        $this->actionService = $actionService;
        //$this->configService = $configService;
        $this->router = $routerManager;
        $this->consoleRouter = $consoleRouterManager;
        $this->navigation = $navigationManager;
        $this->viewService = $viewService;
        $this->mvcService = $controllerService;
        $this->controllerTestService = $controllerServiceTest;
        $this->consoleController = $consoleController;
        $this->consoleControllerTest = $consoleControllerTest;
        $this->appControllerService = $appControllerService;
        $this->appControllerSpecService = $appControllerTestService;
        $this->feature = $feature;
        $this->page = $page;
        $this->step = $step;

        return $this;
    }


    public function createControllerAction($data)
    {
        $module = $this->getModule()->getModuleName();

        $this->action = $this->getActionService()->create(
            $module,
            $data['controller'***REMOVED***,
            $data['name'***REMOVED***,
            isset($data['route'***REMOVED***) ? $data['route'***REMOVED*** : null,
            isset($data['role'***REMOVED***) ? $data['role'***REMOVED*** : null,
            isset($data['dependency'***REMOVED***) ? $data['dependency'***REMOVED*** : null,
            isset($data['db'***REMOVED***) ? $data['db'***REMOVED*** : null,
            isset($data['columns'***REMOVED***) ? $data['columns'***REMOVED*** : null
        );

        if ($this->action instanceof ConsoleValidationStatus) {
            return $this->action;
        }

        $this->controller = $this->getActionService()->getSchemaService()->getController($module, $data['controller'***REMOVED***);
        $this->controller = new Controller($this->controller);

        if (isset($data['db'***REMOVED***)) {
            $db = new Db([
                'table' => $data['db'***REMOVED***,
                'columns' => (isset($data['columns'***REMOVED***)) ? $data['columns'***REMOVED*** : null
            ***REMOVED***);
            $this->controller->setDb($db);

            $this->setDbOptions($this->controller);
        //$this->controller->setDb
        }

        $this->action->setController($this->controller);


        if ($this->str('class', $this->controller->getType()) == 'Action') {
            $this->getMvcController()->buildAction($this->controller);
            $this->getControllerTestService()->buildAction($this->controller);
            $this->getNavigationManager()->create($this->action);
            $this->getRouterManager()->create($this->action);
            $this->getViewService()->build($this->action);
            $this->getAppControllerService()->build($this->action);
            $this->getAppControllerSpecService()->build($this->action);
            $this->getFeature()->build($this->action);
            if ($this->action->getController()->getDb() !== null) {
                $this->getStep()->createTableStep($this->action->getController()->getDb());
            }

            //$this->getPage()->build($this->action);
            return true;
        }


        $this->getConsoleController()->buildAction($this->controller);
        $this->getConsoleControllerTest()->buildAction($this->controller);
        $this->getConsoleRouterManager()->create($this->action);
        return true;
    }
}
