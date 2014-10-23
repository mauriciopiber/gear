<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;

class SrcService extends AbstractJsonService
{
    protected $srcFactory;

    protected $srcValueObject;

    protected $controllerPluginService;

    protected $filterService;

    protected $formService;

    protected $factoryService;

    protected $repositoryService;

    protected $serviceService;

    protected $valueObjectService;

    protected $entityService;

    public function create()
    {
        $this->saveJsonBySrc($this->getSrcValueObject());
        $this->updateServiceManager();
        return $this->factory($this->getSrcValueObject());
    }

    public function factory($src)
    {

        if ($src->getType() == null) {
            return 'Type not allowed'."\n";
        }

        switch ($src->getType()) {
        	case 'Service':
        	    $service = $this->getServiceLocator()->get('serviceService');
        	    $status = $service->create($src);
        	    break;
        	case 'Entity':
        	    $entity = $this->getServiceLocator()->get('entityService');
        	    $status = $entity->create($src);
        	    break;
        	case 'Repository':
        	    $repository = $this->getServiceLocator()->get('repositoryService');
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
        	default:
        	    $status = sprintf('No allowed to create %s', $src->getType())."\n";
        	    break;
        }

        return $status;

    }

    public function setSrcValueObject($srcValueObject)
    {
        $this->srcValueObject = $srcValueObject;

        return $this;
    }

    public function getSrcValueObject()
    {
        if (isset($this->srcValueObject)) {
            return $this->srcValueObject;
        } else {
            return null;
        }
    }

    public function getSrcFactory()
    {
        if (!isset($this->srcFactory)) {
            $this->srcFactory = $this->getServiceLocator()->get('srcFactory');
        }

        return $this->srcFactory;
    }

}
