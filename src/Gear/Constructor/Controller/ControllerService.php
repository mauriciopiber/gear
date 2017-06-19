<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Controller;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\Config\ControllerManagerTrait as ControllerManagerTrait;
use Gear\Mvc\View\ViewServiceTrait as ViewMvc;
use Gear\Mvc\Controller\ControllerServiceTrait as ControllerMvc;
use Gear\Mvc\Controller\ControllerTestServiceTrait as ControllerMvcTest;
use Gear\Mvc\ConsoleController\ConsoleControllerTrait;
use Gear\Mvc\ConsoleController\ConsoleControllerTestTrait;
use GearJson\Controller\Controller;
use GearJson\Controller\ControllerServiceTrait as JsonController;
use Gear\Mvc\LanguageServiceTrait;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

class ControllerService extends AbstractJsonService
{
    static public $defaultService = 'factories';

    static public $defaultType = 'Action';

    static public $defaultNamespace = '%s\Controller\\';

    use ConsoleControllerTrait;
    use ConsoleControllerTestTrait;
    use JsonController;
    use ConfigServiceTrait;
    use ControllerMvcTest;
    use ControllerMvc;
    use ViewMvc;
    use LanguageServiceTrait;
    use ControllerManagerTrait;

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
        //$this->getPageTestService()       ->introspectFromTable($this->db);
        //$this->getAcceptanceTestService() ->introspectFromTable($this->db);
        //$this->getFunctionalTestService() ->introspectFromTable($this->db);

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
