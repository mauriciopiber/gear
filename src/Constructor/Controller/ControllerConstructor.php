<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Controller;

use Gear\Module\ModuleTypesInterface;
use Gear\Schema\Controller\{
    Controller,
    ControllerSchema,
    ControllerSchemaTrait
};
use Gear\Console\ConsoleValidation\ConsoleValidationStatus;
use Gear\Util\String\{
    StringServiceTrait,
    StringService
};
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\ControllerManagerTrait as ControllerManagerTrait;
use Gear\Mvc\View\ViewServiceTrait as ViewMvc;
use Gear\Mvc\LanguageServiceTrait;
use Gear\Mvc\Controller\Web\{
    WebControllerService,
    WebControllerServiceTrait,
    WebControllerTestService,
    WebControllerTestServiceTrait
};
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
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\Config\ControllerManager;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Constructor\AbstractConstructor;
use Gear\Schema\Service\FactoriesInterface;
use Gear\Schema\Controller\Type\ActionInterface;
use Gear\Module\ConstructStatusObject;
use Gear\Module\ConstructStatusObjectTrait;
use Gear\Schema\Controller\Exception\ControllerExist;
use Gear\Mvc\Factory\FactoryService;
use Gear\Mvc\Factory\FactoryServiceTrait;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\Config\RouterManager;
use Gear\Mvc\Config\RouterManagerTrait;

class ControllerConstructor extends AbstractConstructor
{
    const CONTROLLER_SKIP = 'Controller "%s" já existe.';

    const CONTROLLER_VALIDATE = 'Controller "%s" apresentou erros na formatação:';

    const CONTROLLER_CREATED = 'Controller "%s" criado.';

    static public $defaultService = FactoriesInterface::NAME;

    static public $defaultType = ActionInterface::NAME;

    static public $defaultNamespace = '%s\Controller\\';

    use RouterManagerTrait;

    use FactoryServiceTrait;

    use FactoryTestServiceTrait;

    use ControllerSchemaTrait;

    use ConsoleControllerServiceTrait;

    use ConsoleControllerTestServiceTrait;

    use ConfigServiceTrait;

    use WebControllerTestServiceTrait;

    use WebControllerServiceTrait;

    use ApiControllerServiceTrait;

    use ApiControllerTestServiceTrait;

    use ViewMvc;

    use LanguageServiceTrait;

    use ControllerManagerTrait;

    use ConstructStatusObjectTrait;

    /**
     * Constructor
     *
     * @param StringService         $stringService        String Service
     * @param ControllerConstructor     $controllerService    Controller Service
     * @param TableService          $tableService         Table Service
     * @param ModuleStructure  $basicModuleStructure Basic Module Structure
     * @param ControllerConstructor     $controllerService    Controller Service
     * @param ConsoleController     $consoleController    Console Controller
     * @param ConsoleControllerTest $controllerTest       Console Controller Test
     * @param ConfigService         $configService        Config Service
     * @param ViewService           $viewService          View Service
     * @param LanguageService       $languageService      Language Service
     * @param ControllerManager     $controllerManager    Controller Manager
     *
     * @return ControllerConstructor
     */
    public function __construct(
        StringService $stringService,
        ControllerSchema $controllerSchema,
        TableService $tableService,
        ColumnService $columnService,
        ModuleStructure $basicModuleStructure,
        FactoryService $factoryService,
        FactoryTestService $factoryTestService,
        WebControllerService $controllerService,
        WebControllerTestService $controllerTestService,
        ConsoleControllerService $consoleController,
        ConsoleControllerTestService $controllerTest,
        ApiControllerService $apiController,
        ApiControllerTestService $apiControllerTest,
        ConfigService $configService,
        ViewService $viewService,
        LanguageService $languageService,
        ControllerManager $controllerManager,
        ConstructStatusObject $constructStatusObject,
        RouterManager $routerManager
    ) {
        parent::__construct($basicModuleStructure, $stringService, $tableService, $columnService);

        $this->setRouterManager($routerManager);
        //schema
        $this->controllerSchema = $controllerSchema;
        //controller action
        $this->mvcService = $controllerService;
        $this->controllerTestService = $controllerTestService;
        //controller console
        $this->consoleController = $consoleController;
        $this->consoleControllerTest = $controllerTest;

        $this->apiControllerService = $apiController;
        $this->apiControllerTestService = $apiControllerTest;
        //config
        $this->configService = $configService;
        $this->controllerConfig = $controllerManager;
        //view
        $this->viewService = $viewService;
        //language
        $this->languageService = $languageService;

        $this->setFactoryService($factoryService);
        $this->setFactoryTestService($factoryTestService);

        $this->setConstructStatusObject($constructStatusObject);
        return $this;
    }

    public function getModuleControllerType($type)
    {
        switch ($type) {
            case 'web':
                return 'Action';
            case 'cli':
                return 'Console';
            case 'api':
                return 'Rest';
            default:
                throw new \Exception('Missing mapping between module and controller');
        }
    }

    public function createModule($type)
    {
        $this->getControllerSchema()->create(
            $this->getModule()->getModuleName(),
            [
                'name' => 'IndexController',
                'services' => 'factories',
                'type' => $this->getModuleControllerType($type)
            ***REMOVED***
        );

        switch ($type) {
            case ModuleTypesInterface::WEB:
                return $this->createModuleWeb();
            case ModuleTypesInterface::CLI:
                return $this->createModuleCli();
            case ModuleTypesInterface::API:
                return $this->createModuleApi();
            default:
                throw new \Exception(sprintf('Don\'t be able to create a controller to %s', $type));
        }
    }

    public function createModuleWeb()
    {
        $this->mvcService->module();
        $this->mvcService->moduleFactory();
        $this->controllerTestService->module();
        $this->controllerTestService->moduleFactory();
        return true;

    }

    public function createModuleCli()
    {
        $this->consoleController->module();
        $this->consoleController->moduleFactory();
        $this->consoleControllerTest->module();
        $this->consoleControllerTest->moduleFactory();
        return true;
    }

    public function createModuleApi()
    {
        $this->apiControllerService->module();
        $this->apiControllerService->moduleFactory();
        $this->apiControllerTestService->module();
        $this->apiControllerTestService->moduleFactory();
        return true;
    }


    /**
     * Função que cria o Controller para determinado DB
     */
    public function createDb()
    {
        $this->setDbOptions($this->controller);

        $this->db = $this->controller->getDb();

        $this->getConfigService()         ->introspectFromTable($this->db);
        $this->getControllerTestService() ->introspectFromTable($this->db);
        $this->getMvcController()         ->introspectFromTable($this->db);
        $this->getViewService()           ->introspectFromTable($this->db);
        $this->getLanguageService()       ->introspectFromTable($this->db);

        $status = $this->getConstructStatusObject();
        return $status;
    }

    public function createController($data = array())
    {
        $status = $this->getConstructStatusObject();

        $module = $this->getModule()->getModuleName();


        try {
            $this->controller = $this->getControllerSchema()->create(
                $module,
                $data,
                false
            );
        } catch (ControllerExist $e) {
            $status->addSkipped(
                sprintf(self::CONTROLLER_SKIP, $data['name'***REMOVED***, $data['type'***REMOVED***)
            );
            return $status;
        }

        if ($this->controller instanceof ConsoleValidationStatus) {
            $status->addValidated(
                sprintf(
                    self::CONTROLLER_VALIDATE,
                    (isset($data['name'***REMOVED***) ? $data['name'***REMOVED*** : ''),
                    (isset($data['type'***REMOVED***) ? $data['type'***REMOVED*** : '')
                )
            );

            $status->addValidated($this->controller->getErrors());
            return $status;
        }

        if (!in_array($this->controller->getType(), ['Action', 'Console', 'Rest'***REMOVED***)) {
            return false;
        }

        //se tem DB declarado, cria utilizando as regras de db
        if ($this->controller->getDb() !== null) {
            return $this->createDb();
        }

        $this->getControllerManager()->create($this->controller);

        if ($this->controller->getType() == 'Action') {
            $this->getMvcController()->buildController($this->controller);
            $this->getControllerTestService()->buildController($this->controller);
            return $this->successful($status);
        }

        if ($this->controller->getType() == 'Rest') {
            $this->getApiControllerService()->buildController($this->controller);
            $this->getApiControllerTestService()->buildController($this->controller);
            $this->getRouterManager()->createController($this->controller);
            return $this->successful($status);
        }


        $this->getConsoleController()->buildController($this->controller);
        $this->getConsoleControllerTest()->buildController($this->controller);
        return $this->successful($status);
    }

    public function successful($status)
    {

        if ($this->controller->isFactory()) {
            $this->getFactoryService()->createFactory($this->controller);
            $this->getFactoryTestService()->createControllerFactoryTest($this->controller);
        }

        $status->addCreated(
            sprintf(
                self::CONTROLLER_CREATED,
                $this->controller->getName(),
                $this->controller->getType()
            )
        );
        return $status;
    }
}
