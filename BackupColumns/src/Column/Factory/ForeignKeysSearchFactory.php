<?php
namespace Column\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Column\Factory\AbstractFactory;
use Column\Form\Search\ForeignKeysSearchForm;

class ForeignKeysSearchFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new ForeignKeysSearchForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );
        return $form;
    }
}
