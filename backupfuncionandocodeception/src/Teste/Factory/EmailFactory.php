<?php
namespace Teste\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use Teste\Factory\AbstractFactory;

class EmailFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \Teste\Form\EmailForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('Teste/Filter/EmailFilter');

        $idEmail = null;
        $form->setInputFilter($filter->getInputFilter($idEmail));

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'Teste\Entity\Email');

        $form->setHydrator($hydrator);

        return $form;
    }
}
