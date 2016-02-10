<?php
namespace Gear\Constructor\Service;

use Gear\Service\AbstractJsonService;


class DbService extends AbstractJsonService
{
    protected $metadata;

    use \Gear\Mvc\Entity\EntityServiceTrait;

    use \Gear\Mvc\Search\SearchServiceTrait;

    use \Gear\Mvc\Fixture\FixtureServiceTrait;

    use \Gear\Mvc\Filter\FilterServiceTrait;

    use \Gear\Mvc\Filter\FilterTestServiceTrait;

    use \Gear\Mvc\Form\FormServiceTrait;

    use \Gear\Mvc\Form\FormTestServiceTrait;

    use \Gear\Mvc\Factory\FactoryServiceTrait;

    use \Gear\Mvc\Factory\FactoryTestServiceTrait;

    use \Gear\Mvc\Controller\ControllerServiceTrait;

    use \Gear\Mvc\Controller\ControllerTestServiceTrait;

    use \Gear\Mvc\Config\ConfigServiceTrait;

    use \Gear\Mvc\LanguageServiceTrait;

    use \Gear\Mvc\View\ViewServiceTrait;

    use \Gear\Mvc\Repository\RepositoryServiceTrait;

    use \Gear\Mvc\Service\ServiceServiceTrait;


    /**
     *
     * @param array $data
     * @throws \Gear\Exception\TableNotFoundException
     * @return boolean
     */
    public function create()
    {
        $table   = $this->getRequest()->getParam('table');
        $columns = $this->getRequest()->getParam('columns', array());
        $user    = $this->getRequest()->getParam('user', 'all');

        $data = array('table' => $table, 'columns' => $columns, 'user' => $user);

        if (!$this->isValid($data)) {
            return false;
        }


        $db = new \GearJson\Db\Db($this->prepareData($data));
        if (!$json = $this->getGearSchema()->insertDb($db)) {
            return false;
        }

        $table = $this->getTable($db->getTableUnderscore());

        $db->setTableObject($table);

        $this->getEventManager()->trigger('createInstance', $this, array('instance' => $db));




        $this->getConfigService()->setDb($db);
        $this->getConfigService()         ->introspectFromTable($db);
        $this->getEntityService()         ->introspectFromTable($db);
        $this->getRepositoryService()     ->introspectFromTable($db);
        $this->getServiceService()        ->introspectFromTable($db);
        $this->getFormTestService()       ->introspectFromTable($db);
        $this->getFilterService()         ->introspectFromTable($db);
        $this->getFormService()           ->introspectFromTable($db);
        $this->getFactoryService()        ->introspectFromTable($db);
        $this->getSearchService()         ->introspectFromTable($db);
        $this->getFixtureService()        ->introspectFromTable($db);
        $this->getLanguageService()       ->introspectFromTable();
        $this->getControllerTestService() ->introspectFromTable($db);
        $this->getControllerService()     ->introspectFromTable($db);
        $this->getViewService()           ->introspectFromTable($db);


                //$this->getPageTestService()       ->introspectFromTable($db);
        //$this->getAcceptanceTestService() ->introspectFromTable($db);
        //$this->getFunctionalTestService() ->introspectFromTable($db);

        return true;
    }

    public function delete()
    {


    }

    public function isValid($data)
    {
        return true;
    }

    public function prepareData($data)
    {
        $columns = count($data['columns'***REMOVED***)>0 ? $data['columns'***REMOVED*** : null;

        if ($columns !== null && !is_array($columns)) {
            $data['columns'***REMOVED*** = \Zend\Json\Json::decode($columns, 1);
        }

        return $data;
    }
}
