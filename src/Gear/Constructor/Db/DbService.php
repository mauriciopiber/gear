<?php
namespace Gear\Constructor\Db;

use Gear\Service\AbstractJsonService;
use GearJson\Db\DbServiceTrait as JsonDb;
use GearJson\Action\ActionServiceTrait as JsonAction;

class DbService extends AbstractJsonService
{
    protected $metadata;

    use JsonAction;
    use JsonDb;

    use \Gear\Mvc\Entity\EntityServiceTrait;

    use \Gear\Mvc\Search\SearchServiceTrait;

    use \Gear\Mvc\Fixture\FixtureServiceTrait;

    use \Gear\Mvc\Filter\FilterServiceTrait;

    use \Gear\Mvc\Form\FormServiceTrait;

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
    public function create($params)
    {
        list($table, $columns, $user, $role) = $params;

        $module = $this->getModule()->getModuleName();

        $db = $this->getDbService()->create($module, $table, $columns, $user, $role);

        if ($this->getTableService()->verifyTableAssociation($table)) {
            $this->getActionService()->create($module, $db->getTable().'Controller', 'upload-image');
        }

        $db->setTableObject($this->getTableService()->getTableObject($db->getTable()));

        $this->getConfigService()         ->introspectFromTable($db);
        $this->getEntityService()         ->introspectFromTable($db);
        $this->getRepositoryService()     ->introspectFromTable($db);
        $this->getServiceService()        ->introspectFromTable($db);
        $this->getFilterService()         ->introspectFromTable($db);
        $this->getFormService()           ->introspectFromTable($db);
        $this->getSearchService()         ->introspectFromTable($db);
        $this->getFixtureService()        ->introspectFromTable($db);
        $this->getLanguageService()       ->introspectFromTable($db);
        $this->getMvcController()         ->introspectFromTable($db);
        $this->getViewService()           ->introspectFromTable($db);

        //$this->getPageTestService()       ->introspectFromTable($db);
        //$this->getAcceptanceTestService() ->introspectFromTable($db);
        //$this->getFunctionalTestService() ->introspectFromTable($db);

        return true;
    }

    public function delete()
    {
        return true;
    }
}
