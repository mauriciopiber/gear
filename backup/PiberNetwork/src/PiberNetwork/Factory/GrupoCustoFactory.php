<?php
namespace PiberNetwork\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use PiberNetwork\Factory\AbstractFactory;

class GrupoCustoFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \PiberNetwork\Form\GrupoCustoForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('PiberNetwork/Filter/GrupoCustoFilter');
        $form->setInputFilter($filter->getInputFilter());

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'PiberNetwork\Entity\GrupoCusto');

        $form->setHydrator($hydrator);

        return $form;
    }
}
