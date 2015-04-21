<?php
namespace TestUpload\Factory;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use TestUpload\Factory\AbstractFactory;
use TestUpload\Form\Search\TestUploadImageSearchForm;

class TestUploadImageSearchFactory extends AbstractFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new TestUploadImageSearchForm(
            $serviceLocator->get('doctrine.entitymanager.orm_default')
        );
        return $form;
    }
}
