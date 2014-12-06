<?php
namespace PiberNetwork\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use PiberNetwork\Factory\AbstractFactory;

class StatusCustoFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \PiberNetwork\Form\StatusCustoForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('PiberNetwork/Filter/StatusCustoFilter');
        $form->setInputFilter($filter->getInputFilter());

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'PiberNetwork\Entity\StatusCusto');

        $form->setHydrator($hydrator);

        return $form;
    }
}
