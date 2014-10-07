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
            return 'Type not allowed';
        }

        switch ($src->getType()) {
            case 'service':
                $service = $this->getServiceLocator()->get('serviceService');
                $status = $service->create($src);
                break;

            default:
                $status = sprintf('No allowed to create %s', $src->getType());
                break;
        }

        return $status;

    }
}
