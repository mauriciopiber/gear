<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Controller;

use GearJson\Controller\{
    Controller,
    ControllerService as ControllerSchema,
    ControllerServiceTrait as ControllerSchemaTrait
};
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use GearBase\Util\String\{
    StringServiceTrait,
    StringService
};
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\ControllerManagerTrait as ControllerManagerTrait;
use Gear\Mvc\View\ViewServiceTrait as ViewMvc;
use Gear\Mvc\LanguageServiceTrait;
use Gear\Mvc\Controller\{
    ControllerServiceTrait as ControllerMvcTrait,
    ControllerTestServiceTrait as ControllerMvcTestTrait,
    ControllerService as ControllerMvc,
    ControllerTestService as ControllerMvcTest
};
use Gear\Mvc\ConsoleController\{
    ConsoleController,
    ConsoleControllerTest,
    ConsoleControllerTrait,
    ConsoleControllerTestTrait
};
use Gear\Mvc\Controller\Api\{
    ApiController,
    ApiControllerTest,
    ApiControllerTrait,
    ApiControllerTestTrait
};
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\Config\ControllerManager;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use Gear\Module\BasicModuleStructure;
use Gear\Constructor\AbstractConstructor;
use GearJson\Service\FactoriesInterface;
use GearJson\Controller\Type\ActionInterface;

class ControllerService extends AbstractConstructor
{
    static public $defaultService = FactoriesInterface::NAME;

    static public $defaultType = ActionInterface::NAME;

    static public $defaultNamespace = '%s\Controller\\';

    use ControllerSchemaTrait;

    use ConsoleControllerTrait;

    use ConsoleControllerTestTrait;

    use ConfigServiceTrait;

    use ControllerMvcTestTrait;

    use ControllerMvcTrait;

    //use ApiControllerTrait;

    //use ApiControllerTestTrait;

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
        ColumnService $columnService,
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
        parent::__construct($basicModuleStructure, $stringService, $tableService, $columnService);

        //schema
        $this->controllerService = $controllerSchema;
        //controller action
        $this->mvcService = $controllerService;
        $this->controllerTestService = $controllerTestService;
        //controller console
        $this->consoleController = $consoleController;
        $this->consoleControllerTest = $controllerTest;
        //config
        $this->configService = $configService;
        $this->controllerConfig = $controllerManager;
        //view
        $this->viewService = $viewService;
        //language
        $this->languageService = $languageService;


        return $this;
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

        return true;
    }

    public function createController($data = array())
    {
        $module = $this->getModule()->getModuleName();

        $this->controller = $this->getControllerService()->create(
            $module,
            $data,
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

        $this->getControllerManager()->create($this->controller);

        if ($this->controller->getType() == 'Action') {
            $this->getMvcController()->buildController($this->controller);
            $this->getControllerTestService()->buildController($this->controller);
            return true;
        }

        $this->getConsoleController()->buildController($this->controller);
        $this->getConsoleControllerTest()->buildController($this->controller);
        return true;
    }
}
