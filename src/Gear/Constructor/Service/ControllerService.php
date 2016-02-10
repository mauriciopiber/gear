<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Service;

use Gear\Service\AbstractJsonService;
use GearJson\Controller\Controller;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\View\ViewServiceTrait as ViewMvc;
use Gear\Mvc\Controller\ControllerServiceTrait as ControllerMvc;
use Gear\Mvc\Controller\ControllerTestServiceTrait as ControllerMvcTest;
use Gear\Mvc\Config\ControllerTrait as ControllerConfigTrait;
use GearJson\Controller\ControllerServiceTrait as JsonController;

class ControllerService extends AbstractJsonService
{
    use JsonController;
    use ConfigServiceTrait;
    use ControllerMvcTest;
    use ControllerMvc;
    use ViewMvc;
    use ControllerConfigTrait;

    public function __construct()
    {
        parent::__construct();
    }

    public function isValid($data)
    {
        return true;
    }

    public function createDb()
    {
        //cria a lista de ações padrão para controller.
        $this->controller = $this->getGearSchema()->generateControllerActionsForDb($this->controller);

        //salva json com lista de ações.
        $this->getGearSchema()->overwrite($this->controller);

        //pesquisa pela tabela utilizada pela db
        $tableObject = $this->findTableObject($this->controller->getDb()->getTable());

        //adiciona tabela à instancia do controller
        $this->controller->getDb()->setTableObject($tableObject);

        //se tem COLUMNS declarado
        if (is_string($this->controller->getDb()->getColumns())) {

            //Adiciona columns ao DB.
            $columns = $this->src->getDb()->getColumns();
            $this->controller->getDb()->setColumns(\Zend\Json\Json::decode($columns));
        }

        //Referência para DB, será usada posteriormente para introspecção;
        $this->db = $this->controller->getDb();

        $this->getConfigService()         ->introspectFromTable($this->db);
        $this->getControllerTestService() ->introspectFromTable($this->db);
        $this->getControllerService()     ->introspectFromTable($this->db);
        $this->getViewService()           ->introspectFromTable($this->db);
        $this->getPageTestService()       ->introspectFromTable($this->db);
        $this->getAcceptanceTestService() ->introspectFromTable($this->db);
        $this->getFunctionalTestService() ->introspectFromTable($this->db);
    }

    public function createConsoleController($data)
    {
        $data['type'***REMOVED*** = 'console';

        if (!$this->isValid($data)) {
            return;
        }

        $this->controller = new Controller($data);

        $this->jsonController = $this->getServiceLocator()->get('GearJson\Json\Controller');
        $this->jsonStatus = $this->jsonController->insert($this->controller);

        //se adicionou ao json com sucesso
        if (!$this->jsonStatus) {
            return;
        }

        (new ConsoleControllerBuilder\ConsoleController($this->getServiceLocator()))
          ->build($this->controller);
        (new ConsoleControllerBuilder\ConsoleControllerTest($this->getServiceLocator()))
          ->build($this->controller);
        (new ConsoleControllerBuilder\ConsoleControllerConfig($this->getServiceLocator()))
          ->build($this->controller);

        return true;
    }

    public function createController($data = array())
    {
        $module = $this->getModule()->getModuleName();

        $this->controller = $this->getControllerService()->create($module, $data['name'***REMOVED***, $data['object'***REMOVED***);
        //se tem DB declarado, cria utilizando as regras de db
        if ($this->controller->getDb() !== null) {
            return $this->createDb();
        }


        $this->getMvcController()->build($this->controller);
        $this->getControllerTestService()->build($this->controller);
        $this->getControllerConfig()->mergeFromController($this->controller);


        return true;
    }

}
