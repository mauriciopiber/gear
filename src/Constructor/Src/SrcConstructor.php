<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Src;

//use Gear\Mvc\Search\SearchService;
use Gear\Column\ColumnService;
use Gear\Column\ColumnServiceTrait;
use Gear\Console\ConsoleValidation\ConsoleValidationStatus;
use Gear\Constructor\AbstractConstructor;
use Gear\Constructor\Src\Exception\SrcTypeNotFoundException;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Mvc\Config\ServiceManager;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Mvc\ControllerPlugin\ControllerPluginService;
use Gear\Mvc\ControllerPlugin\ControllerPluginServiceTrait;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Mvc\Factory\FactoryService;
use Gear\Mvc\Factory\FactoryServiceTrait;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Mvc\Factory\FactoryTestServiceTrait;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Filter\FilterServiceTrait;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Fixture\FixtureServiceTrait;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Form\FormServiceTrait;
use Gear\Mvc\InterfaceService;
use Gear\Mvc\InterfaceServiceTrait;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Repository\RepositoryServiceTrait;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Service\ServiceServiceTrait;
use Gear\Mvc\Service\ServiceTestService;
use Gear\Mvc\Service\ServiceTestServiceTrait;
use Gear\Mvc\TraitService;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\TraitTestService;
use Gear\Mvc\TraitTestServiceTrait;
use Gear\Mvc\ValueObject\ValueObjectService;
use Gear\Mvc\ValueObject\ValueObjectServiceTrait;
use Gear\Mvc\ViewHelper\ViewHelperService;
use Gear\Mvc\ViewHelper\ViewHelperServiceTrait;
use Gear\Schema\Src\Src;
use Gear\Schema\Src\SrcSchema as SrcSchema;
use Gear\Schema\Src\SrcSchemaTrait as JsonSrc;
use Gear\Schema\Src\SrcTypesInterface;
use Gear\Table\TableService\TableService;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Module\ConstructStatusObject;
use Gear\Module\ConstructStatusObjectTrait;

class SrcConstructor extends AbstractConstructor
{

    const SRC_SKIP = 'Src nome "%s" do tipo "%s" já existe.';

    const SRC_VALIDATE = 'Src %s retornou erros durante validação';

    const SRC_CREATED = 'Src nome "%s" do tipo "%s" criado.';

    const TYPE_NOT_FOUND = 'Type not allowed';

    use ConstructStatusObjectTrait;

    use TableServiceTrait;

    use ColumnServiceTrait;

    use ModuleStructureTrait;

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

    //use SearchServiceTrait;

    use ValueObjectServiceTrait;

    use ViewHelperServiceTrait;

    use ControllerPluginServiceTrait;

    use RepositoryServiceTrait;

    use ServiceServiceTrait;

    use ServiceTestServiceTrait;

    use FixtureServiceTrait;

    use InterfaceServiceTrait;

    public function __construct(
        TableService $tableService,
        ColumnService $columnService,
        ModuleStructure $module,
        SrcSchema $srcSchema,
        ServiceManager $serviceManager,
        TraitService $traitService,
        TraitTestService $traitTestService,
        FactoryService $factoryService,
        FactoryTestService $factoryTestService,
        FormService $formService,
        FilterService $filterService,
        EntityService $entityService,
        //SearchService $searchService,
        ValueObjectService $valueObjectService,
        ViewHelperService $viewHelperService,
        ControllerPluginService $controllerPluginService,
        RepositoryService $repositoryService,
        ServiceService $serviceService,
        ServiceTestService $serviceTestService,
        FixtureService $fixtureService,
        InterfaceService $interfaceService,
        ConstructStatusObject $status
    ) {
        parent::__construct($module, null, $tableService, $columnService);
        $this->setConstructStatusObject($status);
        $this->srcSchema = $srcSchema;
        $this->serviceManager = $serviceManager;
        $this->traitService = $traitService;
        $this->traitTestService = $traitTestService;
        $this->factoryService = $factoryService;
        $this->factoryTestService = $factoryTestService;
        $this->filterService = $filterService;
        $this->formService = $formService;
        $this->entityService = $entityService;
        //$this->searchService = $searchService;
        $this->valueObjectService = $valueObjectService;
        $this->viewHelperService = $viewHelperService;
        $this->controllerPluginService = $controllerPluginService;
        $this->repositoryService = $repositoryService;
        $this->serviceService = $serviceService;
        $this->setServiceTestService($serviceTestService);
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
        $status = $this->getConstructStatusObject();

        $module = $this->getModule()->getModuleName();
        //var_dump($module);die();

        $this->src = $this->getSrcSchema()->create(
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

        $factory = $this->factory();

        if ($factory) {
            $status->addCreated(
                sprintf(
                    self::SRC_CREATED,
                    $this->src->getName(),
                    $this->src->getType()
                )
            );
            return $status;
        }

        throw new Exception('Error while creating src, must check code');
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
     * @return array[***REMOVED***|\Gear\Console\ConsoleValidation\ConsoleValidationStatus
     */
    public function createAdditional(array $srcs)
    {
        $validations = ['created' => [***REMOVED***, 'validated' => [***REMOVED******REMOVED***;

        foreach ($srcs as $src) {
            $srcObject = $this->getSrcSchema()->factory(
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
            $srcItem = $this->getSrcSchema()->create(
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
        if ($this->src->isAbstract() === false) {
            $this->createTrait($this->src);
        }

        if ($this->src->isFactory() && $this->src->isAbstract() === false) {
            $this->createFactory($this->src);
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
                    $this->getServiceService()->createService($this->src);
                    $this->getServiceTestService()->createServiceTest($this->src);
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

        $notAService = [
            SrcTypesInterface::FIXTURE,
            SrcTypesInterface::INTERFACE,
            SrcTypesInterface::VALUE_OBJECT
        ***REMOVED***;

        if (false === in_array($this->src->getType(), $notAService)) {
            $this->getServiceManager()->create($this->src);
        }
        return true;
    }
}
