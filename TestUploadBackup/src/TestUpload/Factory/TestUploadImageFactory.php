<?php
namespace TestUpload\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use TestUpload\Factory\AbstractFactory;

class TestUploadImageFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \TestUpload\Form\TestUploadImageForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('TestUpload/Filter/TestUploadImageFilter');

        $idTestUploadImage = null;
        $form->setInputFilter($filter->getInputFilter($idTestUploadImage));

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'TestUpload\Entity\TestUploadImage');

        $form->setHydrator($hydrator);

        return $form;
    }
}
