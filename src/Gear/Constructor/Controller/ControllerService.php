<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Controller;

use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\ControllerManagerTrait as ControllerManagerTrait;
use Gear\Mvc\View\ViewServiceTrait as ViewMvc;
use Gear\Mvc\Controller\ControllerServiceTrait as ControllerMvcTrait;
use Gear\Mvc\Controller\ControllerTestServiceTrait as ControllerMvcTestTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use GearJson\Controller\Controller;
use GearJson\Controller\ControllerServiceTrait as ControllerSchemaTrait;
use Gear\Mvc\LanguageServiceTrait;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Table\TableService\TableServiceTrait;
use GearBase\Util\String\StringService;
use GearJson\Controller\ControllerService as ControllerSchema;
use Gear\Table\TableService\TableService;
use Gear\Module\BasicModuleStructure;
use Gear\Mvc\Controller\ControllerService as ControllerMvc;
use Gear\Mvc\Controller\ControllerTestService as ControllerMvcTest;
use Gear\Mvc\ConsoleController\ConsoleController;
use Gear\Mvc\ConsoleController\ConsoleControllerTest;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\Config\ControllerManager;

class ControllerService  implements ModuleAwareInterface
{
    static public $defaultService = 'factories';

    static public $defaultType = 'Action';

    static public $defaultNamespace = '%s\Controller\\';

    use ControllerSchemaTrait;
    use TableServiceTrait;
    use StringServiceTrait;
    use ModuleAwareTrait;
    use ConsoleControllerTrait;
    use ConsoleControllerTestTrait;
    use ConfigServiceTrait;
    use ControllerMvcTestTrait;
    use ControllerMvcTrait;
    use ViewMvc;
    use LanguageServiceTrait;
    use ControllerManagerTrait;


    /**
     * Constructor
     *
     * @param StringService         $stringService        String Service
     * @param ControllerService     $controllerService    Controller Service
     * @param TableService          $tableService         Table Service
     * @param BasicModuleStructure  $basicModuleStructure Basic Module Structure
     * @param ControllerService     $controllerService    Controller Service
     * @param ConsoleController     $consoleController    Console Controller
     * @param ConsoleControllerTest $controllerTest       Console Controller Test
     * @param ConfigService         $configService        Config Service
     * @param ViewService           $viewService          View Service
     * @param LanguageService       $languageService      Language Service
     * @param ControllerManager     $controllerManager    Controller Manager
     *
     * @return ControllerService
     */
    public function __construct(
        StringService $stringService,
        ControllerSchema $controllerSchema,
        TableService $tableService,
        BasicModuleStructure $basicModuleStructure,
        ControllerMvc $controllerService,
        ControllerMvcTest $controllerTestService,
        ConsoleController $consoleController,
        ConsoleControllerTest $controllerTest,
        ConfigService $configService,
        ViewService $viewService,
        LanguageService $languageService,
        ControllerManager $controllerManager
    ) {
        $this->stringService = $stringService;
        $this->controllerService = $controllerSchema;
        $this->tableService = $tableService;
        $this->module = $basicModuleStructure;
        $this->mvcService = $controllerService;
        $this->controllerTestService = $controllerTestService;
        $this->consoleController = $consoleController;
        $this->consoleControllerTest = $controllerTest;
        $this->configService = $configService;
        $this->viewService = $viewService;
        $this->languageService = $languageService;
        $this->controllerConfig = $controllerManager;

        return $this;
    }


    /**
     * Função que cria o Controller para determinado DB
     */
    public function createDb()
    {
        $tableObject = $this->getTableService()->getTableObject($this->controller->getDb()->getTable());
        $this->controller->getDb()->setTableObject($tableObject);

        $this->db = $this->controller->getDb();

        $this->getConfigService()         ->introspectFromTable($this->db);
        $this->getControllerTestService() ->introspectFromTable($this->db);
        $this->getMvcController()         ->introspectFromTable($this->db);
        $this->getViewService()           ->introspectFromTable($this->db);
        $this->getLanguageService()       ->introspectFromTable($this->db);

        return true;
    }

    public function createController($data = array())
    {
        $module = $this->getModule()->getModuleName();

        $this->controller = $this->getControllerService()->create(
            $module,
            $data['name'***REMOVED***,
            (isset($data['service'***REMOVED***) ? $data['service'***REMOVED*** : static::$defaultService),
            (isset($data['type'***REMOVED***) ? $data['type'***REMOVED*** : static::$defaultType),
            (isset($data['namespace'***REMOVED***) ? $data['namespace'***REMOVED*** : null),
            (isset($data['extends'***REMOVED***) ? $data['extends'***REMOVED*** : null),
            (isset($data['db'***REMOVED***) ? $data['db'***REMOVED*** : null),
            (isset($data['columns'***REMOVED***) ? $data['columns'***REMOVED*** : null),
            (isset($data['dependency'***REMOVED***) ? $data['dependency'***REMOVED*** : null),
            (isset($data['implements'***REMOVED***) ? $data['implements'***REMOVED*** : null),
            (isset($data['user'***REMOVED***) ? $data['user'***REMOVED*** : null),
            false
        );


        if ($this->controller instanceof ConsoleValidationStatus) {
            return $this->controller;
        }

        if (!in_array($this->controller->getType(), ['Action', 'Console'***REMOVED***)) {
            return false;
        }

        //se tem DB declarado, cria utilizando as regras de db
        if ($this->controller->getDb() !== null) {
            return $this->createDb();
        }

        if ($this->controller->getType() == 'Action') {
            $this->getMvcController()->buildController($this->controller);
            $this->getControllerTestService()->buildController($this->controller);
            $this->getControllerManager()->create($this->controller);
            return true;
        }

        $this->getConsoleController()->buildController($this->controller);
        $this->getConsoleControllerTest()->buildController($this->controller);
        $this->getControllerManager()->create($this->controller);
        return true;
    }
}
