<?php
namespace Gear\Mvc\Spec\Page;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Mvc\Spec\Page\Page;

class PageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Page(
        );
        unset($serviceLocator);
        return $factory;
    }
}
