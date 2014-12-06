<?php
namespace PiberNetwork\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use PiberNetwork\Factory\AbstractFactory;
use PiberNetwork\Form\Search\CustoSearchForm;

class CustoSearchFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new CustoSearchForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );
        return $form;
    }
}
