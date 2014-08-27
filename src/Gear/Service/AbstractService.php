<?php
namespace Gear\Service;
/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @author piber
 */
abstract class AbstractService
    implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $adapter;

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

	public function getAdapter()
	{
		return $this->adapter;
	}

	public function setAdapter($adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getRepository($repositoryName)
	{
	    if($repositoryName) {

	        $serviceName = sprintf('%sRepository',$repositoryName);

	        $repository = $this->getServiceLocator()->get($serviceName);
	        if($repository) {
	            return $repository;
	        }
	    }
	    return false;
	}

}