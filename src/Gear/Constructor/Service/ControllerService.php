<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Service;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\Controller;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Common\PageTestServiceTrait;
use Gear\Common\AcceptanceTestServiceTrait;
use Gear\Common\FunctionalTestServiceTrait;
use Gear\Common\ViewServiceTrait as MvcViewService;
use Gear\Common\ControllerTestServiceTrait;
use Gear\Common\ControllerServiceTrait as MvcControllerService;
use Gear\Constructor\Builder\Controller as ControllerBuilder;
use Gear\Constructor\Builder\ConsoleController as ConsoleControllerBuilder;
use Gear\Mvc\Controller\ControllerTrait;
use Gear\Mvc\Controller\ControllerTestTrait;
use Gear\Mvc\Config\ControllerTrait as ControllerConfigTrait;


class ControllerService extends AbstractJsonService
{
    use ConfigServiceTrait;
    use PageTestServiceTrait;
    use AcceptanceTestServiceTrait;
    use FunctionalTestServiceTrait;
    use ControllerTestServiceTrait;
    use MvcControllerService;
    use MvcViewService;
    use ControllerTrait;
    use ControllerTestTrait;
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
        $data['type'***REMOVED*** = 'mvc';


        //valida
        if (!$this->isValid($data)) {
            return;
        }

            //cria novo controller
        $this->controller = new Controller($data);


        $this->jsonController = $this->getServiceLocator()->get('GearJson\Json\Controller');
        $this->jsonStatus = $this->jsonController->insert($this->controller);

        //se adicionou ao json com sucesso
        if (!$this->jsonStatus) {
            return;
        }

        //se tem DB declarado, cria utilizando as regras de db
        if ($this->controller->getDb() !== null) {
            return $this->createDb();
        }


        $this->getMvcController()->build($this->controller);
        $this->getMvcControllerTest()->build($this->controller);
        $this->getControllerConfig()->mergeFromController($this->controller);
/*

        (new ControllerBuilder\Controller($this->getServiceLocator()))
          ->build($this->controller);

        (new ControllerBuilder\ControllerTest($this->getServiceLocator()))
          ->build($this->controller);

        (new ControllerBuilder\ControllerConfig($this->getServiceLocator()))
          ->build($this->controller); */

        return true;
    }

}
