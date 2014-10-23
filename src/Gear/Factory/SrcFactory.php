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


}
