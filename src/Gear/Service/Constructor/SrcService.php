<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\Stdlib\Hydrator\ClassMethods;

class SrcService extends AbstractJsonService
{

    use \Gear\Common\RepositoryServiceTrait;
    use \Gear\Common\ServiceServiceTrait;

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('configService');
        }
        return $this->configService;
    }

    public function isValid($data)
    {
        return true;
    }

    public function create()
    {
        //params
        $data = array(
            'name' => $this->getRequest()->getParam('name'),
            'type' => $this->getRequest()->getParam('type'),
            'dependency' => $this->getRequest()->getParam('dependency'),
            'db' => $this->getRequest()->getParam('db'),
            'columns' => $this->getRequest()->getParam('columns'),
            'abstract' => $this->getRequest()->getParam('abstract'),
        );

        if (!$this->isValid($data)) {
            return false;
        }


        $src = new \Gear\ValueObject\Src($data);

        $schema = $this->getSchema();

        $jsonStatus = $this->getGearSchema()->insertSrc($src->export());


        if (!$jsonStatus) {
            return false;
        }


        $this->getEventManager()->trigger('createInstance', $this, array('instance' => $src));

        $configService = $this->getConfigService();
        $configService->mergeServiceManagerConfig();
        $this->factory($src);

        return true;
    }

    public static function avaliable()
    {
        return array(
        	'Service',
            'Entity',
            'Repository',
            'Form',
            'Filter',
            'Factory',
            'ValueObject',
            'Controller',
            'Controller\Plugin'
        );

    }

    public function factory($src)
    {

        if ($src->getType() == null) {
            return 'Type not allowed'."\n";
        }

        try {
            switch ($src->getType()) {
                case 'Service':
                    $service = $this->getServiceService();
                    $status = $service->create($src);
                    break;
                case 'Entity':
                    $entity = $this->getServiceLocator()->get('entityService');
                    $status = $entity->create($src);
                    break;
                case 'Repository':
                    $repository = $this->getRepositoryService();
                    $status = $repository->create($src);
                    break;
                case 'Form':
                    $form = $this->getServiceLocator()->get('formService');
                    $status = $form->create($src);
                    break;
                case 'Filter':
                    $filter = $this->getServiceLocator()->get('filterService');
                    $status = $filter->create($src);
                    break;
                case 'Factory':
                    $factory = $this->getServiceLocator()->get('factoryService');
                    $status = $factory->create($src);
                    break;
                case 'ValueObject':
                    $valueObject = $this->getServiceLocator()->get('valueObjectService');
                    $status = $valueObject->create($src);
                    break;
                case 'Controller':
                    $controller = $this->getServiceLocator()->get('controllerService');
                    $status = $controller->create($src);
                    break;
                case 'Controller\Plugin':
                    $controllerPlugin = $this->getServiceLocator()->get('controllerPluginService');
                    $status = $controllerPlugin->create($src);
                    break;
                case 'Fixture':
                    $fixture = $this->getServiceLocator()->get('Gear\Service\Mvc\FixtureService');
                    $status = $fixture->create($src);
                    break;
                default:
                    throw new \Gear\Exception\SrcTypeNotFoundException();
                    break;
            }
        } catch (\Exception $exception) {
            throw $exception;
        }

        return true;

    }
}
