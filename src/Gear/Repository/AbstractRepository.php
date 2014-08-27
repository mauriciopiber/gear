<?php
namespace Gear\Repository;
/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @author piber
 */
abstract class AbstractRepository implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $adapter;

    public function __construct($adapter)
    {
        $this->setAdapter($adapter);
    }

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

}