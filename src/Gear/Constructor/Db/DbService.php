<?php
namespace Gear\Constructor\Db;

use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
//use Gear\Table\TableService\TableService;
use GearJson\Db\DbServiceTrait as DbSchemaTrait;
use GearJson\Action\ActionServiceTrait as ActionSchemaTrait;
use Gear\Mvc\Spec\Feature\FeatureTrait;
use Gear\Mvc\Spec\Step\StepTrait;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Mvc\Search\SearchServiceTrait;
use Gear\Mvc\Fixture\FixtureServiceTrait;
use Gear\Mvc\Filter\FilterServiceTrait;
use Gear\Mvc\Form\FormServiceTrait;
use Gear\Mvc\Controller\ControllerServiceTrait;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use Gear\Mvc\Config\ConfigServiceTrait;
use Gear\Mvc\LanguageServiceTrait;
use Gear\Mvc\View\ViewServiceTrait;
use Gear\Mvc\Repository\RepositoryServiceTrait;
use Gear\Mvc\Service\ServiceServiceTrait;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Column\ColumnServiceTrait;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Controller\ControllerService;
use Gear\Mvc\Controller\ControllerTestService;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Table\TableService\TableService;
use Gear\Column\ColumnService;
use GearJson\Db\DbService as DbSchema;
use GearJson\Action\ActionService as ActionSchema;
use Gear\Module\BasicModuleStructure;

class DbService implements ModuleAwareInterface
{
    protected $metadata;

    use ColumnServiceTrait;

    use TableServiceTrait;

    use ActionSchemaTrait;

    use DbSchemaTrait;

    use FeatureTrait;

    use StepTrait;

    use EntityServiceTrait;

    use SearchServiceTrait;

    use FixtureServiceTrait;

    use FilterServiceTrait;

    use FormServiceTrait;

    use ControllerServiceTrait;

    use ControllerTestServiceTrait;

    use ConfigServiceTrait;

    use LanguageServiceTrait;

    use ViewServiceTrait;

    use RepositoryServiceTrait;

    use ServiceServiceTrait;

    use ModuleAwareTrait;

    public function __construct(
        ColumnService $columnService,
        TableService $tableService,
        ActionSchema $actionSchema,
        DbSchema $dbSchema,
        Feature $feature,
        Step $step,
        EntityService $entityService,
        SearchService $searchService,
        FixtureService $fixtureService,
        FilterService $filterService,
        FormService $formService,
        ControllerService $controllerService,
        ControllerTestService $controllerTestService,
        ConfigService $configService,
        LanguageService $languageService,
        ViewService $viewService,
        RepositoryService $repositoryService,
        ServiceService $serviceService,
        BasicModuleStructure $module
    ) {
        $this->columnService = $columnService;
        $this->tableService = $tableService;
        $this->actionService = $actionSchema;
        $this->dbService = $dbSchema;
        $this->feature = $feature;
        $this->step = $step;
        $this->entityService = $entityService;
        $this->searchService = $searchService;
        $this->fixtureService = $fixtureService;
        $this->filterService = $filterService;
        $this->formService = $formService;
        $this->controllerService = $controllerService;
        $this->controllerTestService = $controllerTestService;
        $this->configService = $configService;
        $this->languageService = $languageService;
        $this->viewService = $viewService;
        $this->repositoryService = $repositoryService;
        $this->serviceService = $serviceService;
        $this->module = $module;
    }

    /**
     * @param array $data
     *
     * @return boolean
     */
    public function create($params)
    {
        if (!isset($params['table'***REMOVED***)) {
            throw new \Exception('Missing table');
        }

        if (!isset($params['columns'***REMOVED***) || empty($params['columns'***REMOVED***)) {
            $params['columns'***REMOVED*** = [***REMOVED***;
        }

        if (!isset($params['user'***REMOVED***) || empty($params['user'***REMOVED***)) {
            $params['user'***REMOVED*** = 'all';
        }

        if (!isset($params['role'***REMOVED***) || empty($params['role'***REMOVED***)) {
            $params['role'***REMOVED*** = 'admin';
        }

        if (!isset($params['namespace'***REMOVED***) || empty($params['namespace'***REMOVED***)) {
            $params['namespace'***REMOVED*** = null;
        }

        if (!isset($params['service'***REMOVED***) || empty($params['service'***REMOVED***)) {
            $params['service'***REMOVED*** = 'factories';
        }

        $table = $params['table'***REMOVED***;
        $columns = $params['columns'***REMOVED***;
        $user = $params['user'***REMOVED***;
        $role = $params['role'***REMOVED***;
        $namespace = $params['namespace'***REMOVED***;
        $service = $params['service'***REMOVED***;

        $module = $this->getModule()->getModuleName();

        $db = $this->getDbService()->create($module, $table, $columns, $user, $role, $service, $namespace, false);

        if ($db instanceof ConsoleValidationStatus) {
            return $db;
        }

        if ($this->getTableService()->verifyTableAssociation($table, 'upload_image')) {
            $this->getActionService()->create($module, $db->getTable().'Controller', 'UploadImage');
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
        $this->getFeature()               ->introspectFromTable($db);
        $this->getStep()                  ->createTableStep($db);

        return true;
    }
}