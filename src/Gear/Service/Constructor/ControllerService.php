<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\Controller;
use Gear\Common\ConfigServiceTrait;
use Gear\Common\PageTestServiceTrait;
use Gear\Common\AcceptanceTestServiceTrait;
use Gear\Common\FunctionalTestServiceTrait;
use Gear\Common\ViewServiceTrait as MvcViewService;
use Gear\Common\ControllerTestServiceTrait;
use Gear\Common\ControllerServiceTrait as MvcControllerService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

class ControllerService extends AbstractJsonService
{
    use ConfigServiceTrait;
    use PageTestServiceTrait;
    use AcceptanceTestServiceTrait;
    use FunctionalTestServiceTrait;
    use ControllerTestServiceTrait;
    use MvcControllerService;
    use MvcViewService;

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
        $this->getConfigService()         ->introspectFromTable($this->db);
        $this->getControllerTestService() ->introspectFromTable($this->db);
        $this->getControllerService()     ->introspectFromTable($this->db);
        $this->getViewService()           ->introspectFromTable($this->db);
        $this->getPageTestService()       ->introspectFromTable($this->db);
        $this->getAcceptanceTestService() ->introspectFromTable($this->db);
        $this->getFunctionalTestService() ->introspectFromTable($this->db);
    }

    public function create($data = array())
    {
        if ($this->isValid($data)) {
            $this->controller = new Controller($data);

            $jsonStatus = $this->getGearSchema()->addController($this->controller->export());

            if ($jsonStatus) {

                if ($this->controller->getDb() !== null) {

                    $this->controller = $this->getGearSchema()->generateControllerActionsForDb($this->controller);
                    $this->getGearSchema()->overwrite($this->controller);

                    $tableObject = $this->findTableObject($this->controller->getDb()->getTable());
                    $this->controller->getDb()->setTableObject($tableObject);

                    if (is_string($this->controller->getDb()->getColumns())) {
                        $columns = $this->src->getDb()->getColumns();
                        $this->controller->getDb()->setColumns(\Zend\Json\Json::decode($columns));
                    }

                    $this->db = $this->controller->getDb();

                    return $this->createDb();

                }

                $this->setUpControllerTest($controller);
                $this->setUpController($controller);
                $this->updateControllerManager();
                return true;
            }
        }
        return false;
    }

    public function delete($data = array())
    {
        $this->getEventManager()->trigger('doTest', $controller, $data);
        return true;
    }

    public function updateControllerManager()
    {
        $config = $this->getConfigService();
        $config->mergeControllerConfig();
    }

    public function setUpControllerTest(Controller $controller)
    {
        $controllerService = $this->getControllerTestService();
        $controllerService->implement($controller);
    }

    public function setUpController(Controller $data)
    {
        $controllerService = $this->getControllerService();
        $controllerService->implement($data);
    }

}
