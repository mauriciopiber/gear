<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StrHelperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $viewManager)
    {
        $str = new \Gear\View\Helper\Str();
        $str->setServiceLocator($viewManager->getServiceLocator());
        return $str;
    }
}
