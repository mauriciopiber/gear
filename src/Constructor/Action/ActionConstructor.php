<?php
/**
 */
namespace Gear\Constructor\Action;

use Gear\Schema\Controller\Controller;
use Gear\Schema\Action\Action;
use Gear\Schema\Db\Db;
use Gear\Schema\Action\ActionSchemaTrait as ActionSchemaTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\RouterManagerTrait;
use Gear\Mvc\Config\ConsoleRouterManagerTrait;
use Gear\Mvc\Config\NavigationManagerTrait;
use Gear\Mvc\View\ViewServiceTrait;

use Gear\Mvc\Spec\Feature\FeatureTrait;
use Gear\Mvc\Spec\Page\PageTrait;
use Gear\Mvc\Spec\Step\StepTrait;
use Gear\Console\ConsoleValidation\ConsoleValidationStatus;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Util\String\StringServiceTrait;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Schema\Action\ActionSchema as ActionSchema;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\Config\RouterManager;
use Gear\Mvc\Config\ConsoleRouterManager;
use Gear\Mvc\Config\NavigationManager;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Controller\Console\{
    ConsoleControllerService,
    ConsoleControllerServiceTrait,
    ConsoleControllerTestService,
    ConsoleControllerTestServiceTrait
};
use Gear\Mvc\Controller\Api\{
    ApiControllerService,
    ApiControllerServiceTrait,
    ApiControllerTestService,
    ApiControllerTestServiceTrait
};
use Gear\Mvc\Controller\Web\WebControllerServiceTrait;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Mvc\Controller\Web\WebControllerTestServiceTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\Spec\Page\Page;
use Gear\Mvc\Spec\Step\Step;
use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Constructor\AbstractConstructor;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use Gear\Module\ModuleTypesInterface;
use Gear\Module\ConstructStatusObject;
use Gear\Module\ConstructStatusObjectTrait;
use Gear\Schema\Action\Exception\ActionExist;

/**
 * @group m1
 */
class ActionConstructor extends AbstractConstructor
{
    const ACTION_SKIP = 'Action "%s" do Controller "%s" já existe.';

    const ACTION_VALIDATE = 'Action "%s" do Controller "%s" apresentou erros na formatação';

    const ACTION_CREATED = 'Action "%s" do Controller "%s" criado.';

    use ApiControllerServiceTrait;

    use ApiControllerTestServiceTrait;

    use StringServiceTrait;

    use ModuleStructureTrait;

    use PageTrait;

    use StepTrait;

    use FeatureTrait;

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
    use ConsoleControllerTestServiceTrait;
    use ConsoleControllerServiceTrait;

    /* mvc controller */
    use WebControllerTestServiceTrait;
    use WebControllerServiceTrait;

    /* mvc view */
    use ViewServiceTrait;

    use ConstructStatusObjectTrait;

    /**
     * Constructor
     *
     * @param Feature              $feature              Feature
     * @param ActionConstructor    $actionService        Action Service
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
     * @param ModuleStructure $basicModuleStructure Basic Module Structure
     * @param StringService        $stringService        String Service
     *
     * @return ActionConstructor
     */
    public function __construct(
        ActionSchema $actionService,
        RouterManager $routerManager,
        ConsoleRouterManager $consoleRouterManager,
        NavigationManager $navigationManager,
        ViewService $viewService,
        WebControllerService $controllerService,
        WebControllerTestService $controllerServiceTest,
        ConsoleControllerService $consoleController,
        ConsoleControllerTestService $consoleControllerTest,
        ApiControllerService $apiController,
        ApiControllerTestService $apiControllerTest,
        Feature $feature,
        Page $page,
        Step $step,
        ModuleStructure $basicModuleStructure,
        StringService $stringService,
        TableService $tableService,
        ColumnService $columnService,
        ConstructStatusObject $constructStatusObject
    ) {
        parent::__construct($basicModuleStructure, $stringService, $tableService, $columnService);

        $this->actionSchema = $actionService;
        //$this->configService = $configService;
        $this->router = $routerManager;
        $this->consoleRouter = $consoleRouterManager;
        $this->navigation = $navigationManager;
        $this->viewService = $viewService;
        $this->mvcService = $controllerService;
        $this->controllerTestService = $controllerServiceTest;
        $this->consoleController = $consoleController;
        $this->consoleControllerTest = $consoleControllerTest;
        $this->apiControllerService = $apiController;
        $this->apiControllerTestService = $apiControllerTest;
        $this->feature = $feature;
        $this->page = $page;
        $this->step = $step;
        $this->setConstructStatusObject($constructStatusObject);

        return $this;
    }

    public function getModuleActionName($type)
    {
        switch ($type) {
            case ModuleTypesInterface::API:
                return 'GetList';
            default:
                return 'Index';
        }
    }

    public function createModule($type)
    {
        $actionName = $this->getModuleActionName($type);

        $this->getActionSchema()->create(
            $this->getModule()->getModuleName(),
            [
                'controller' => 'IndexController',
                'name' => $actionName
            ***REMOVED***,
            false
        );

        if (in_array($type, [
            ModuleTypesInterface::WEB
        ***REMOVED***)) {
            $this->viewService->createIndexView();
            //$this->appControllerSpecService->createTestIndexAction();
            //$this->appControllerService->createIndexController();
            $this->feature->createIndexFeature();
            $this->page->createIndexPage();
            $this->step->createIndexStep();
            return true;
            //$this->actionConstructor->createModule($this->type);
        }


    }

    public function createControllerAction($data)
    {
        $status = $this->getConstructStatusObject();

        $module = $this->getModule()->getModuleName();

        try {
            $this->action = $this->getActionSchema()->create(
                $module,
                $data,
                false
            );
        } catch (ActionExist $e) {
            $status->addSkipped(
                sprintf(self::ACTION_SKIPPED, $data['controller'***REMOVED***, $data['name'***REMOVED***)
            );
            return $status;
        }

        if (isset($data['type'***REMOVED***)) {
            $this->action->getController()->setType($data['type'***REMOVED***);
        }

        if ($this->action instanceof ConsoleValidationStatus) {
            $status->addValidated(
                sprintf(
                    self::ACTION_VALIDATE,
                    (isset($data['controller'***REMOVED***) ? $data['controller'***REMOVED*** : ''),
                    (isset($data['name'***REMOVED***) ? $data['name'***REMOVED*** : '')
                )
            );

            $status->addValidated($this->action->getErrors());
            return $status;
        }

        $this->controller = $this->action->getController();

        if (null !== $this->controller->getDb()) {
            $this->setDbOptions($this->controller);
        }

        if ($this->controller->isType('Action')) {
            $this->getMvcController()->buildAction($this->controller);
            $this->getControllerTestService()->buildAction($this->controller);
            $this->getNavigationManager()->create($this->action);
            $this->getRouterManager()->create($this->action);
            $this->getViewService()->build($this->action);
            //$this->getAppControllerService()->build($this->action);
            //$this->getAppControllerSpecService()->build($this->action);
            $this->getFeature()->build($this->action);
            if ($this->action->getController()->getDb() !== null) {
                $this->getStep()->createTableStep($this->action->getController()->getDb());
            }
            return $this->successful($status);
        }

        if ($this->controller->isType('Console')) {
            $this->getConsoleController()->buildAction($this->controller);
            $this->getConsoleControllerTest()->buildAction($this->controller);
            $this->getConsoleRouterManager()->create($this->action);
            return $this->successful($status);
        }

        $this->getApiControllerService()->buildAction($this->controller);
        $this->getApiControllerTestService()->buildAction($this->controller);
        $this->getRouterManager()->create($this->action);




        return $this->successful($status);
    }

    public function successful($status)
    {
        $status->addCreated(
            sprintf(
                self::ACTION_CREATED,
                $this->action->getController()->getName(),
                $this->action->getName()
            )
        );
        return $status;

    }
}
