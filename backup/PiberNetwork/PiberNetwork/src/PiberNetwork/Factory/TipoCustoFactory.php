<?php
namespace PiberNetwork\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use PiberNetwork\Factory\AbstractFactory;

class TipoCustoFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \PiberNetwork\Form\TipoCustoForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('PiberNetwork/Filter/TipoCustoFilter');
        $form->setInputFilter($filter->getInputFilter());

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'PiberNetwork\Entity\TipoCusto');

        $form->setHydrator($hydrator);

        return $form;
    }
}
