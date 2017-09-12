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
use Gear\Table\TableService\TableService;
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
use Gear\Column\ColumnService;
use GearJson\Db\DbService as DbSchema;
use GearJson\Action\ActionService as ActionSchema;
use Gear\Module\BasicModuleStructure;
use Gear\Constructor\AbstractConstructor;
use Gear\Table\UploadImage as UploadImageTable;
use GearJson\Service\FactoriesInterface;

class DbService extends AbstractConstructor
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
        //ControllerTestService $controllerTestService,
        ConfigService $configService,
        LanguageService $languageService,
        ViewService $viewService,
        RepositoryService $repositoryService,
        ServiceService $serviceService,
        BasicModuleStructure $module
    ) {
        parent::__construct($module, null, $tableService, $columnService);
        $this->actionService = $actionSchema;
        $this->dbService = $dbSchema;
        $this->feature = $feature;
        $this->step = $step;
        $this->entityService = $entityService;
        $this->searchService = $searchService;
        $this->fixtureService = $fixtureService;
        $this->filterService = $filterService;
        $this->formService = $formService;
        $this->mvcService = $controllerService;
        //$this->controllerTestService = $controllerTestService;
        $this->configService = $configService;
        $this->languageService = $languageService;
        $this->viewService = $viewService;
        $this->repositoryService = $repositoryService;
        $this->serviceService = $serviceService;
    }

    /**
     * @param array $data
     *
     * @return boolean
     */
    public function create($params)
    {
        $module = $this->getModule()->getModuleName();

        $db = $this->getDbService()->create($module, $params, false);

        if ($db instanceof ConsoleValidationStatus) {
            return $db;
        }

        if ($this->getTableService()->verifyTableAssociation($db->getTable(), UploadImageTable::NAME)) {
            $this->getActionService()->create(
                $module,
                [
                    'controller' => $db->getTable().'Controller',
                    'name' => 'UploadImage'
                ***REMOVED***,
                true
            );
        }

        $db->setTableObject($this->getTableService()->getTableObject($db->getTable()));
        $db->setColumnManager($this->getColumnService()->getColumnManager($db));

        $this->getConfigService()         ->introspectFromTable($db);
        $this->getEntityService()         ->createEntity($db);
        $this->getRepositoryService()     ->createRepository($db);
        $this->getServiceService()        ->createService($db);
        $this->getFilterService()         ->createFilter($db);
        $this->getFormService()           ->createForm($db);
        $this->getSearchService()         ->createSearchForm($db);
        $this->getFixtureService()        ->createFixture($db);
        $this->getLanguageService()       ->introspectFromTable($db);
        $this->getMvcController()         ->introspectFromTable($db);
        $this->getViewService()           ->introspectFromTable($db);
        $this->getFeature()               ->introspectFromTable($db);
        $this->getStep()                  ->createTableStep($db);

        return true;
    }
}
