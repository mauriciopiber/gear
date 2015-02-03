<?php
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Metadata;

class DbService extends AbstractJsonService
{
    use \Gear\Common\EntityServiceTrait;

    use \Gear\Common\RepositoryServiceTrait;

    use \Gear\Common\ServiceServiceTrait;

    use \Gear\Common\ServiceTestServiceTrait;

    use \Gear\Common\FilterServiceTrait;

    use \Gear\Common\FilterTestServiceTrait;

    use \Gear\Common\FormServiceTrait;

    use \Gear\Common\FormTestServiceTrait;

    use \Gear\Common\FactoryServiceTrait;

    use \Gear\Common\FactoryTestServiceTrait;

    use \Gear\Common\ControllerServiceTrait;

    use \Gear\Common\ControllerTestServiceTrait;

    use \Gear\Common\ConfigServiceTrait;

    use \Gear\Common\LanguageServiceTrait;

    use \Gear\Common\ViewServiceTrait;

    use \Gear\Common\SearchServiceTrait;

    use \Gear\Common\PageTestServiceTrait;

    use \Gear\Common\AcceptanceTestServiceTrait;

    use \Gear\Common\FunctionalTestServiceTrait;

    use \Gear\Common\FixtureServiceTrait;

    public function isValid($data)
    {
        return true;
    }

    public function prepareData($data)
    {
        $columns = count($data['columns'***REMOVED***)>0 ? $data['columns'***REMOVED*** : null;

        if ($columns !== null ) {
            $data['columns'***REMOVED*** = \Zend\Json\Json::decode($columns, 1);
        }

        return $data;
    }

    public function getTable($tableName)
    {
        $metadata = new Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));

        try {
            $table = $metadata->getTable($tableName);
        } catch(\Exception $e) {
            throw new \Gear\Exception\TableNotFoundException();
        }

        return $table;

    }

    public function getDb($data)
    {
        return new \Gear\ValueObject\Db($this->prepareData($data));
    }



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

        $db = $this->getDb($data);
        if (!$json = $this->getGearSchema()->insertDb($db)) {
            return false;
        }

        $table = $this->getTable($db->getTableUnderscore());

        $db->setTableObject($table);

        $this->getEventManager()->trigger('createInstance', $this, array('instance' => $db));

        $this->getEntityService()->introspectFromTable($table);

        $this->getRepositoryService()->introspectFromTable($db);

        $this->getServiceService()->introspectFromTable($db);
        $this->getServiceTestService()->introspectFromTable($db);

        $this->getFormTestService()->introspectFromTable($db);

        $this->getFilterService()->introspectFromTable($db);
        $this->getFormService()->introspectFromTable($db);
        $this->getFactoryService()->introspectFromTable($db);

        $this->getSearchService()->introspectFromTable($db);

        $this->getControllerTestService()->introspectFromTable($db);
        $this->getControllerService()->introspectFromTable($db);

        $this->getConfigService()->introspectFromTable($db);

        $this->getViewService()->introspectFromTable($db);
        $this->getLanguageService()->mergeTranslate();
        $this->getPageTestService()->introspectFromTable($db);


        $this->getFixtureService()->introspectFromTable($db);
        //$this->getAcceptanceTestService()->introspectFromTable($db);
        //$this->getFunctionalTestService()->introspectFromTable($db);

        return true;
    }
}
