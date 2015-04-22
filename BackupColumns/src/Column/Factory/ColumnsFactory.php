<?php
namespace Column\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use Column\Factory\AbstractFactory;

class ColumnsFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new \Column\Form\ColumnsForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );

        $filter = $serviceLocator->get('Column/Filter/ColumnsFilter');

        $idColumns = null;
        $form->setInputFilter($filter->getInputFilter($idColumns));

        $entityManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $hydrator = new DateHydrator($entityManager, 'Column\Entity\Columns');

        $form->setHydrator($hydrator);

        return $form;
    }
}
