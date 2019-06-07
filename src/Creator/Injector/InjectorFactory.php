<?php
namespace Gear\Creator\Injector;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Creator\Injector\Injector;

class InjectorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new Injector(
            $container->get('Gear\Util\Vector\ArrayService')
        );
        
        return $factory;
    }
}
