<?php
namespace Column\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use Column\Factory\AbstractFactory;

class ForeignKeysFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \Column\Form\ForeignKeysForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('Column/Filter/ForeignKeysFilter');

        $idForeignKeys = null;
        $form->setInputFilter($filter->getInputFilter($idForeignKeys));

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'Column\Entity\ForeignKeys');

        $form->setHydrator($hydrator);

        return $form;
    }
}
