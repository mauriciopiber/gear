<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Src;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\SrcServiceTrait as JsonSrc;
use Gear\Mvc\Form\FormServiceTrait;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\Entity\EntityServiceTrait;
use Gear\Mvc\Filter\FilterServiceTrait;
use Gear\Mvc\ValueObject\ValueObjectServiceTrait;
use Gear\Mvc\ViewHelper\ViewHelperServiceTrait;
use Gear\Mvc\ControllerPlugin\ControllerPluginServiceTrait;
use Gear\Mvc\Repository\RepositoryServiceTrait;
use Gear\Mvc\Service\ServiceServiceTrait;
use Gear\Mvc\Factory\FactoryServiceTrait;
use Gear\Mvc\Search\SearchServiceTrait;
use Gear\Mvc\Fixture\FixtureServiceTrait;
use Gear\Mvc\InterfaceServiceTrait;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

class SrcService extends AbstractJsonService
{

    use JsonSrc;

    protected $src;

    use ServiceManagerTrait;

    use TraitServiceTrait;

    use FactoryServiceTrait;

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

    public function create(array $data)
    {

        $module = $this->getModule()->getModuleName();

        $this->src = $this->getSrcService()->create(
            $module,
            $data['name'***REMOVED***,
            $data['type'***REMOVED***,
            (isset($data['namespace'***REMOVED***) ? $data['namespace'***REMOVED*** : null),
            (isset($data['extends'***REMOVED***) ? $data['extends'***REMOVED*** : null),
            (isset($data['dependency'***REMOVED***) ? $data['dependency'***REMOVED*** : null),
            (isset($data['service'***REMOVED***) ? $data['service'***REMOVED*** : null),
            (isset($data['abstract'***REMOVED***) ? $data['abstract'***REMOVED*** : null),
            (isset($data['db'***REMOVED***) ? $data['db'***REMOVED*** : null),
            (isset($data['columns'***REMOVED***) ? $data['columns'***REMOVED*** : null),
            (isset($data['template'***REMOVED***) ? $data['template'***REMOVED*** : null),
            (isset($data['implements'***REMOVED***) ? $data['implements'***REMOVED*** : null),
            (isset($data['user'***REMOVED***) ? $data['user'***REMOVED*** : null),
            false
        );

        if ($this->src instanceof ConsoleValidationStatus) {
            return $this->src;
        }

        if ($this->src->getDb() !== null) {

            $tableObject = $this->getTableService()->getTableObject($this->src->getDb()->getTable());
            $this->src->getDb()->setTableObject($tableObject);
        }

        return $this->factory();
    }

    public function createEntities(array $srcs)
    {
        $this->srcs = [***REMOVED***;

        foreach ($srcs as $src) {
            $this->srcs[***REMOVED*** = $this->getSrcService()->create(
                $this->getModule()->getModuleName(),
                $src['name'***REMOVED***,
                $src['type'***REMOVED***,
                (isset($src['namespace'***REMOVED***) ? $src['namespace'***REMOVED*** : null),
                (isset($src['extends'***REMOVED***) ? $src['extends'***REMOVED*** : null),
                (isset($src['dependency'***REMOVED***) ? $src['dependency'***REMOVED*** : null),
                (isset($src['service'***REMOVED***) ? $src['service'***REMOVED*** : null),
                (isset($src['abstract'***REMOVED***) ? $src['abstract'***REMOVED*** : null),
                (isset($src['db'***REMOVED***) ? $src['db'***REMOVED*** : null),
                (isset($src['columns'***REMOVED***) ? $src['columns'***REMOVED*** : null),
                (isset($src['template'***REMOVED***) ? $src['template'***REMOVED*** : null),
                (isset($src['implements'***REMOVED***) ? $src['implements'***REMOVED*** : null),
                (isset($src['user'***REMOVED***) ? $src['user'***REMOVED*** : null),
                false
            );
        }
        $entity = $this->getEntityService();
        return $entity->createEntities($this->srcs);
    }

    public function factory()
    {
        if ($this->src->getType() == null) {
            return 'Type not allowed'."\n";
        }

        try {
            switch ($this->src->getType()) {
                case 'ControllerPlugin':
                    $service = $this->getControllerPluginService();
                    $status = $service->create($this->src);
                    break;
                case 'ViewHelper':
                    $service = $this->getViewHelperService();
                    $status = $service->create($this->src);
                    break;
                case 'Service':
                    $service = $this->getServiceService();
                    $status = $service->create($this->src);
                    break;
                case 'Entity':
                    $entity = $this->getEntityService();
                    $status = $entity->create($this->src);
                    break;
                case 'Repository':
                    $repository = $this->getRepositoryService();
                    $status = $repository->create($this->src);
                    break;
                case 'Form':
                    $form = $this->getFormService();
                    $status = $form->create($this->src);
                    break;
                case 'SearchForm':
                    $search = $this->getSearchService();
                    $status = $search->create($this->src);
                    break;
                case 'Filter':
                    $filter = $this->getFilterService();
                    $status = $filter->create($this->src);
                    break;
                case 'Trait':
                    $factory = $this->getTraitService();
                    $status = $factory->createTrait($this->src);
                    break;
                case 'Factory':
                    $factory = $this->getFactoryService();
                    $status = $factory->create($this->src);
                    break;

                case 'ValueObject':
                    $valueObject = $this->getValueObjectService();
                    $status = $valueObject->create($this->src);
                    break;
                case 'Fixture':
                    $fixture = $this->getFixtureService();
                    $status = $fixture->create($this->src);
                    break;
                case 'Interface':
                    $interface = $this->getInterfaceService();
                    $status = $interface->create($this->src);
                    break;
                default:
                    throw new \Gear\Constructor\Src\Exception\SrcTypeNotFoundException();
                    break;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
        $this->getServiceManager()->create($this->src);
        return $status;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function setSrc($src)
    {
        $this->src = $src;
        return $this;
    }
}
