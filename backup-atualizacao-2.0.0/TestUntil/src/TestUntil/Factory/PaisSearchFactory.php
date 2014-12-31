<?php
namespace TestUntil\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use TestUntil\Factory\AbstractFactory;
use TestUntil\Form\Search\PaisSearchForm;

class PaisSearchFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new PaisSearchForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );
        return $form;
    }
}
