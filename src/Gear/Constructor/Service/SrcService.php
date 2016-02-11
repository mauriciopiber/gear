<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Constructor\Service;

use Gear\Service\AbstractJsonService;
use Gear\Mvc\Config\ServiceManagerTrait;
use GearJson\Src\SrcServiceTrait as JsonSrc;


class SrcService extends AbstractJsonService
{

    use JsonSrc;

    protected $src;

    use ServiceManagerTrait;

    use \Gear\Mvc\Form\FormServiceTrait;

    use \Gear\Mvc\Entity\EntityServiceTrait;

    use \Gear\Mvc\Filter\FilterServiceTrait;

    use \Gear\Mvc\Factory\FactoryServiceTrait;

    use \Gear\Mvc\ValueObject\ValueObjectServiceTrait;

    use \Gear\Mvc\ViewHelper\ViewHelperServiceTrait;

    use \Gear\Mvc\Repository\RepositoryServiceTrait;

    use \Gear\Mvc\Service\ServiceServiceTrait;


    public function isValid($data)
    {
        return true;
    }

    public function create(array $data)
    {
        $module = $this->getModule()->getModuleName();

        $this->src = $this->getSrcService()->create($module, $data['name'***REMOVED***, $data['type'***REMOVED***, (isset($data['namespace'***REMOVED***) ? $data['namespace'***REMOVED*** : null));

        if ($this->src->getDb() !== null) {
            $tableObject = $this->findTableObject($this->src->getDb()->getTable());
            $this->src->getDb()->setTableObject($tableObject);

            if (is_string($this->src->getDb()->getColumns())) {
                $columns = $this->src->getDb()->getColumns();
                $this->src->getDb()->setColumns(\Zend\Json\Json::decode($columns));
            }
        }

        if ($this->src->getType() == null) {
            $this->createSrcWithoutType();
            $this->serviceManager();
        }

        return $this->factory();
    }


    public function delete()
    {
        //name
        //namespace

        //die('1');

        //verificar schema, se existe.

        //caso não exista, exibe mensagem e retorna.

        //deleta do schema.
        //deleta no servicemanager.
        //deleta Trait.
        //deleta Src.
        //deleta Test.



    }

    public static function avaliable()
    {
        return array(
            'SearchFactory',
            'Factory',
            'Service',
            'Entity',
            'Repository',
            'Form',
            'Filter',
            'ValueObject',
            'Controller',
            'Controller\Plugin'
        );

    }

    public function factory()
    {
        if ($this->src->getType() == null) {
            return 'Type not allowed'."\n";
        }

        try {
            switch ($this->src->getType()) {
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
                case 'Filter':
                    $filter = $this->getFilterService();
                    $status = $filter->create($this->src);
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
                default:
                    throw new \Gear\Exception\SrcTypeNotFoundException();
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
