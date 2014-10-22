<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class SrcFactory implements FactoryInterface, ServiceLocatorAwareInterface
{
    protected $serviceService;

    protected $serviceLocator;

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getServiceService()
    {
        return $this->serviceService;
    }

    public function setServiceService($serviceService)
    {
        $this->serviceService = $serviceService;

        return $this;
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this;

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
            case 'ControllerPlugin':
                $controllerPlugin = $this->getServiceLocator()->get('controllerPluginService');
                $status = $controllerPlugin->create($src);
                break;
            default:
                $status = sprintf('No allowed to create %s', $src->getType())."\n";
                break;
        }

        return $status;

    }
}
