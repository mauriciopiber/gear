<?php
namespace PiberNetwork\Repository;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator as DoctrineHydrator;

abstract class AbstractRepository implements
    ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    protected $entityManager;

    //abstract public function getMapReferences();

    public function getOrderByMap($order)
    {
        if (array_key_exists($order, $this->getMapReferences())) {
            return $this->getMapReferences()[$order***REMOVED***;
        } else {
            throw new \Exception('Order by not configured right way');
        }
    }

    public function persist($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function hydrate($data, $entity)
    {
        $hydrator = new DoctrineHydrator($this->getEntityManager());
        $hydrator->hydrate($data, $entity);
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        if (!isset($this->entityManager)) {
            $this->entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }
}
