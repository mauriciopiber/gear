<?php
namespace Gear\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ArrayToYmlHelperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $viewManager)
    {
        $str = new \Gear\View\Helper\ArrayToYml();
        return $str;
    }
}
