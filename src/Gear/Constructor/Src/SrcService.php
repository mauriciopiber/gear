<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Src;

use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Mvc\Config\ServiceManager;
use Gear\Constructor\Src\Exception\SrcTypeNotFoundException;
use GearJson\Src\SrcServiceTrait as JsonSrc;
use GearJson\Src\SrcService as SrcSchema;
use Gear\Mvc\Form\FormServiceTrait;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\TraitTestServiceTrait;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Mvc\Filter\FilterServiceTrait;
use Gear\Mvc\ValueObject\ValueObjectServiceTrait;
use Gear\Mvc\ViewHelper\ViewHelperServiceTrait;
use Gear\Mvc\ControllerPlugin\ControllerPluginServiceTrait;
use Gear\Mvc\Repository\RepositoryServiceTrait;
use Gear\Mvc\Service\ServiceServiceTrait;
use Gear\Mvc\Factory\FactoryServiceTrait;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\Search\SearchServiceTrait;
use Gear\Mvc\Fixture\FixtureServiceTrait;
use Gear\Mvc\InterfaceServiceTrait;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\BasicModuleStructure;
use Gear\Module\ModuleAwareInterface;
use Gear\Table\TableService\TableService;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Column\ColumnServiceTrait;
use Gear\Column\ColumnService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\TraitService;
use Gear\Mvc\TraitTestService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\ValueObject\ValueObjectService;
use Gear\Mvc\ViewHelper\ViewHelperService;
use Gear\Mvc\ControllerPlugin\ControllerPluginService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Factory\FactoryService;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\InterfaceService;
use Gear\Constructor\AbstractConstructor;
use GearJson\Src\SrcTypesInterface;
use GearJson\Src\Src;

class SrcService extends AbstractConstructor
{
    const TYPE_NOT_FOUND = 'Type not allowed';

    use TableServiceTrait;

    use ColumnServiceTrait;

    use ModuleAwareTrait;

    use JsonSrc;

    protected $src;

    use ServiceManagerTrait;

    use TraitServiceTrait;

    use FactoryServiceTrait;

    use TraitTestServiceTrait;

    use FactoryTestServiceTrait;

    use FormServiceTrait;

    use EntityServiceTrait;

    use FilterServiceTrait;

    use SearchServiceTrait;

    use ValueObjectServiceTrait;

    use ViewHelperServiceTrait;

    use ControllerPluginServiceTrait;

    use RepositoryServiceTrait;

    use ServiceServiceTrait;

    use FixtureServiceTrait;

    use InterfaceServiceTrait;

    public function __construct(
        TableService $tableService,
        ColumnService $columnService,
        BasicModuleStructure $module,
        SrcSchema $srcSchema,
        ServiceManager $serviceManager,
        TraitService $traitService,
        TraitTestService $traitTestService,
        FactoryService $factoryService,
        FactoryTestService $factoryTestService,
        FormService $formService,
        FilterService $filterService,
        EntityService $entityService,
        SearchService $searchService,
        ValueObjectService $valueObjectService,
        ViewHelperService $viewHelperService,
        ControllerPluginService $controllerPluginService,
        RepositoryService $repositoryService,
        ServiceService $serviceService,
        FixtureService $fixtureService,
        InterfaceService $interfaceService
    ) {
        parent::__construct($module, null, $tableService, $columnService);
        $this->srcService = $srcSchema;
        $this->serviceManager = $serviceManager;
        $this->traitService = $traitService;
        $this->traitTestService = $traitTestService;
        $this->factoryService = $factoryService;
        $this->factoryTestService = $factoryTestService;
        $this->filterService = $filterService;
        $this->formService = $formService;
        $this->entityService = $entityService;
        $this->searchService = $searchService;
        $this->valueObjectService = $valueObjectService;
        $this->viewHelperService = $viewHelperService;
        $this->controllerPluginService = $controllerPluginService;
        $this->repositoryService = $repositoryService;
        $this->serviceService = $serviceService;
        $this->fixtureService = $fixtureService;
        $this->interfaceService = $interfaceService;
    }

    public function construct(Src $src)
    {
        $this->src = $src;
        if ($this->src->getDb() !== null) {
            $this->setDbOptions($this->src);
        }
        return $this->factory();
    }

    public function create(array $data)
    {
        $module = $this->getModule()->getModuleName();

        $this->src = $this->getSrcService()->create(
            $module,
            $data,
            false
        );

        if ($this->src instanceof ConsoleValidationStatus) {
            return $this->src;
        }

        if ($this->src->getDb() !== null) {
            $this->setDbOptions($this->src);
        }

        return $this->factory();
    }

    /**
     * Create a single Factory and show snippet
     *
     * @param Src $srcObject
     */
    private function createFactory(Src $srcObject)
    {
        $this->getFactoryService()->createFactory($srcObject);
        $this->getFactoryService()->createConstructorSnippet($srcObject);
        $this->getFactoryTestService()->createFactoryTest($srcObject);
        $this->getFactoryTestService()->createConstructorSnippet($srcObject);
    }

    /**
     * Create a single Trait
     *
     * @param Src $srcObject
     */
    private function createTrait(Src $srcObject)
    {
        $this->getTraitService()->createTrait($srcObject);
        $this->getTraitTestService()->createTraitTest($srcObject);
    }

    /**
     * Prepare and create Traits and Factories.
     *
     * @param array $srcs
     *
     * @return array[***REMOVED***|\GearBase\Util\ConsoleValidation\ConsoleValidationStatus
     */
    public function createAdditional(array $srcs)
    {
        $validations = ['created' => [***REMOVED***, 'validated' => [***REMOVED******REMOVED***;

        foreach ($srcs as $src) {
            $srcObject = $this->getSrcService()->factory(
                $this->getModule()->getModuleName(),
                $src,
                false
            );

            if ($srcObject instanceof ConsoleValidationStatus) {
                $validations['validated'***REMOVED***[***REMOVED*** = $srcObject;
                continue;
            }

            switch ($srcObject->getType()) {
                case SrcTypesInterface::TRAIT:
                    $this->createTrait($srcObject);
                    break;
                case SrcTypesInterface::FACTORY:
                    $this->createFactory($srcObject);
                    break;
            }


            $validations['created'***REMOVED***[***REMOVED*** = $srcObject;

        }

        return $validations;
    }

    public function createEntities(array $srcs)
    {
        $validations = ['created' => [***REMOVED***, 'validated' => [***REMOVED******REMOVED***;

        foreach ($srcs as $src) {
            $srcItem = $this->getSrcService()->create(
                $this->getModule()->getModuleName(),
                $src,
                false
            );

            if ($srcItem instanceof ConsoleValidationStatus) {
                $validations['validated'***REMOVED***[***REMOVED*** = $srcItem;
                continue;
            }

            $this->setDbOptions($srcItem);
            $this->srcs[***REMOVED*** = $srcItem;
        }

        $entity = $this->getEntityService();
        $entity->createEntities($this->srcs);

        $validations['created'***REMOVED*** = $this->srcs;

        return $validations;
    }

    private function factory()
    {
        if ($this->src->getType() == null) {
            return self::TYPE_NOT_FOUND;
        }

        try {
            switch ($this->src->getType()) {
                case SrcTypesInterface::CONTROLLER_PLUGIN:
                    $service = $this->getControllerPluginService();
                    $status = $service->createControllerPlugin($this->src);
                    break;
                case SrcTypesInterface::VIEW_HELPER:
                    $service = $this->getViewHelperService();
                    $status = $service->createViewHelper($this->src);
                    break;
                case SrcTypesInterface::SERVICE:
                    $service = $this->getServiceService();
                    $status = $service->createService($this->src);
                    break;
                case SrcTypesInterface::ENTITY:
                    $entity = $this->getEntityService();
                    $status = $entity->createEntity($this->src);
                    break;
                case SrcTypesInterface::REPOSITORY:
                    $repository = $this->getRepositoryService();
                    $status = $repository->createRepository($this->src);
                    break;
                case SrcTypesInterface::FORM:
                    $form = $this->getFormService();
                    $status = $form->createForm($this->src);
                    break;
                case SrcTypesInterface::SEARCH_FORM:
                    $search = $this->getSearchService();
                    $status = $search->createSearchForm($this->src);
                    break;
                case SrcTypesInterface::FILTER:
                    $filter = $this->getFilterService();
                    $status = $filter->createFilter($this->src);
                    break;
                case SrcTypesInterface::VALUE_OBJECT:
                    $valueObject = $this->getValueObjectService();
                    $status = $valueObject->createValueObject($this->src);
                    break;
                case SrcTypesInterface::FIXTURE:
                    $fixture = $this->getFixtureService();
                    $status = $fixture->createFixture($this->src);
                    break;
                case SrcTypesInterface::INTERFACE:
                    $interface = $this->getInterfaceService();
                    $status = $interface->create($this->src);
                    break;
                default:
                    throw new SrcTypeNotFoundException();
                    break;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
        if (false === in_array($this->src->getType(), [SrcTypesInterface::FIXTURE, SrcTypesInterface::INTERFACE, SrcTypesInterface::VALUE_OBJECT***REMOVED***)) {
            $this->getServiceManager()->create($this->src);
        }
        return $status;
    }

}
