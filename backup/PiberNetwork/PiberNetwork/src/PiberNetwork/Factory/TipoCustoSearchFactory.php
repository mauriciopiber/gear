<?php
namespace PiberNetwork\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Security\Hydrator\DateHydrator;
use PiberNetwork\Factory\AbstractFactory;
use PiberNetwork\Form\Search\TipoCustoSearchForm;

class TipoCustoSearchFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new TipoCustoSearchForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );
        return $form;
    }
}
