<?php
namespace TestUpload\Form;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;

abstract class AbstractForm extends Form implements
    ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    protected $entityManager;

    public function __construct($formName)
    {
        parent::__construct($formName);
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
