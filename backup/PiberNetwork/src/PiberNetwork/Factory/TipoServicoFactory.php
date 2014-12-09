<?php
namespace PiberNetwork\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use PiberNetwork\Factory\AbstractFactory;

class TipoServicoFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \PiberNetwork\Form\TipoServicoForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('PiberNetwork/Filter/TipoServicoFilter');
        $form->setInputFilter($filter->getInputFilter());

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'PiberNetwork\Entity\TipoServico');

        $form->setHydrator($hydrator);

        return $form;
    }
}
